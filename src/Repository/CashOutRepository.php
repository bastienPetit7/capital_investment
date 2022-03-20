<?php

namespace App\Repository;

use App\Entity\CashOut;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CashOut|null find($id, $lockMode = null, $lockVersion = null)
 * @method CashOut|null findOneBy(array $criteria, array $orderBy = null)
 * @method CashOut[]    findAll()
 * @method CashOut[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CashOutRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CashOut::class);
    }

    // /**
    //  * @return CashOut[] Returns an array of CashOut objects
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
    public function findOneBySomeField($value): ?CashOut
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
