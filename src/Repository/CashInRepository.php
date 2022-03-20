<?php

namespace App\Repository;

use App\Entity\CashIn;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CashIn|null find($id, $lockMode = null, $lockVersion = null)
 * @method CashIn|null findOneBy(array $criteria, array $orderBy = null)
 * @method CashIn[]    findAll()
 * @method CashIn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CashInRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CashIn::class);
    }

    // /**
    //  * @return CashIn[] Returns an array of CashIn objects
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
    public function findOneBySomeField($value): ?CashIn
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
