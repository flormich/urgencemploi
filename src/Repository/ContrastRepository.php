<?php

namespace App\Repository;

use App\Entity\Contrast;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Contrast|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contrast|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contrast[]    findAll()
 * @method Contrast[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContrastRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Contrast::class);
    }

    // /**
    //  * @return Contrast[] Returns an array of Contrast objects
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
    public function findOneBySomeField($value): ?Contrast
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
