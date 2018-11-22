<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class CompanyRepository extends EntityRepository
{
    public function getCompanyPaged($page, $size)
    {

        /** @var  $offset : decllage a partir duquel récupérer les Utilisateurs */
        $offset = ($page - 1) * $size;
        $qb = $this->createQueryBuilder('c');
        if (!empty($offset)) {
            $qb->setFirstResult($offset);
        }

        if (!empty($size)) {
            $qb->setMaxResults($size);
        }

        return $qb->getQuery()->getResult();
    }

}