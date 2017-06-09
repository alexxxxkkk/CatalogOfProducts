<?php

namespace AppBundle\Repository;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends \Doctrine\ORM\EntityRepository
{
    public function isExist(array $options, $id): bool
    {
        $em = $this->getEntityManager();
        $productByName = $em->getRepository('AppBundle:Product')->findOneBy($options);

        if ($productByName->getId() != $id) {
            return false;
        }

        return true;
    }
}
