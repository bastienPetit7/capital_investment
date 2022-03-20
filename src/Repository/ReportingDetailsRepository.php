<?php

namespace App\Repository;

use App\Entity\ReportingDetails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReportingDetails|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReportingDetails|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReportingDetails[]    findAll()
 * @method ReportingDetails[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReportingDetailsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReportingDetails::class);
    }

    // /**
    //  * @return ReportingDetails[] Returns an array of ReportingDetails objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReportingDetails
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
