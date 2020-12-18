<?php

namespace App\Repository;

use App\Entity\CategoryJob;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CategoryJob|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryJob|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryJob[]    findAll()
 * @method CategoryJob[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryJobRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CategoryJob::class);
    }

    // /**
    //  * @return CategoryJob[] Returns an array of CategoryJob objects
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
    public function findOneBySomeField($value): ?CategoryJob
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
