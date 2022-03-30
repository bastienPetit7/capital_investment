<?php

namespace App\Repository;

use App\Entity\WidgetLine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WidgetLine|null find($id, $lockMode = null, $lockVersion = null)
 * @method WidgetLine|null findOneBy(array $criteria, array $orderBy = null)
 * @method WidgetLine[]    findAll()
 * @method WidgetLine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WidgetLineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WidgetLine::class);
    }

    // /**
    //  * @return WidgetLine[] Returns an array of WidgetLine objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WidgetLine
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
