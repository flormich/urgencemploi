<?php

namespace App\Repository;

use App\Entity\AppRoles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AppRoles|null find($id, $lockMode = null, $lockVersion = null)
 * @method AppRoles|null findOneBy(array $criteria, array $orderBy = null)
 * @method AppRoles[]    findAll()
 * @method AppRoles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppRolesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AppRoles::class);
    }

    // /**
    //  * @return AppRoles[] Returns an array of AppRoles objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AppRoles
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
