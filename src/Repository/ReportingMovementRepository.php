<?php

namespace App\Repository;

use App\Dictionary\Movement;
use App\Entity\Reporting;
use App\Entity\ReportingMovement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReportingMovement|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReportingMovement|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReportingMovement[]    findAll()
 * @method ReportingMovement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReportingMovementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReportingMovement::class);
    }

    public function findByReportingAndAsc(Reporting $reporting)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.reporting = :val')
            ->setParameter('val', $reporting)
            ->orderBy('r.createdAt', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findLastMovements(Reporting $reporting)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.reporting = :val')
            ->setParameter('val', $reporting)
            ->orderBy('r.createdAt', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findMovementPerMonthAndYearAndReporting(Reporting $reporting,$month,$year)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.reporting = :val')
            ->setParameter('val', $reporting)
            ->andWhere('r.name = :valName')
            ->setParameter('valName', Movement::EARNING)
            ->andWhere('r.month = :valMonth')
            ->setParameter('valMonth', $month)
            ->andWhere('r.year = :valYear')
            ->setParameter('valYear', $year)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    // /**
    //  * @return ReportingMovement[] Returns an array of ReportingMovement objects
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
    public function findOneBySomeField($value): ?ReportingMovement
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
