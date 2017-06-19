<?php

namespace AppBundle\Menu;

use AppBundle\Entity\Category;
use Doctrine\ORM\EntityManager;
use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MenuBuilder
{
    private $factory;
    private $container;
    private $em;

    public function __construct(FactoryInterface $factory, ContainerInterface $container, EntityManager $em)
    {
        $this->factory = $factory;
        $this->container = $container;
        $this->em = $em;
    }

    public function createMainMenu(array $options)
    {
        $menuItems = array (
//            '/' => 'Главная',
            'products' => 'Каталог',
//            'about' => 'О нас',
        );
        $menu = $this->factory->createItem('main');
        $menu->setChildrenAttribute('class', 'nav navbar-nav mainMenu col-md-12 hidden-xs hidden-sm');
        foreach ($menuItems as $ref => $value) {
            $menu->addChild($value, array(
                'route' => $ref,
            ));
        }
        if ($options['user'] != 'ROLE_USER') {
            $menu->addChild('Управление категориями', array(
                'route' => 'categories',
            ));
        }
        if ($options['user'] == 'ROLE_ADMIN') {
            $menu->addChild('Управление пользователями', array(
                'route' => 'users',
            ));
        }
        return $menu;
    }
}