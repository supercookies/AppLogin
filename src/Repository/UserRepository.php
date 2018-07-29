<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @return User[] Returns an array of User objects
     */
    public function list(int $nbParPages, int $page)
    {   
        $query = $this->createQueryBuilder('u')
            ->orderBy('u.dateInscription', 'DESC')
            ->getQuery()
        ;

        $query
          ->setFirstResult(($page-1) * $nbParPages)
          ->setMaxResults($nbParPages)
        ;

        return new Paginator($query, true);
    }
}
