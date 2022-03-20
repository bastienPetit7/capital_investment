<?php

namespace App\Repository;

use App\Entity\InterestEarn;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InterestEarn|null find($id, $lockMode = null, $lockVersion = null)
 * @method InterestEarn|null findOneBy(array $criteria, array $orderBy = null)
 * @method InterestEarn[]    findAll()
 * @method InterestEarn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InterestEarnRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InterestEarn::class);
    }

    // /**
    //  * @return InterestEarn[] Returns an array of InterestEarn objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InterestEarn
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
