<?php

namespace App\Repository;

use App\Entity\AppUsers;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method AppUsers|null find($id, $lockMode = null, $lockVersion = null)
 * @method AppUsers|null findOneBy(array $criteria, array $orderBy = null)
 * @method AppUsers[]    findAll()
 * @method AppUsers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppUsersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AppUsers::class);
    }

    //  /**
    //   * @return AppUsers[] Returns an array of AppUsers objects
    //   */

    // public function findByExampleField($value)
    // {
    //     return $this->createQueryBuilder('a')
    //         ->andWhere('a.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->orderBy('a.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }
    
     
    // public function findOneBySomeField($value): ?AppUsers
    // {
    //     return $this->createQueryBuilder('a')
    //         ->andWhere('a.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->getQuery()
    //         ->getOneOrNullResult()
    //     ;
    // }   
    
}

// class UserRepository extends EntityRepository implements UserLoaderInterface
// {
//     public function loadUserByUsername($username)
//     {
//         return $this->createQueryBuilder('u')
//             ->where('u.username = :username OR u.mail = :mail')
//             ->setParameter('username', $username)
//             ->setParameter('mail', $username)
//             ->getQuery()
//             ->getOneOrNullResult();
//     }
// }
