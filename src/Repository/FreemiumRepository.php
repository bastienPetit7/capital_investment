<?php

namespace App\Repository;

use App\Entity\Freemium;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Freemium|null find($id, $lockMode = null, $lockVersion = null)
 * @method Freemium|null findOneBy(array $criteria, array $orderBy = null)
 * @method Freemium[]    findAll()
 * @method Freemium[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FreemiumRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Freemium::class);
    }

    // /**
    //  * @return Freemium[] Returns an array of Freemium objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Freemium
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
