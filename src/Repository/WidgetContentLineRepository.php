<?php

namespace App\Repository;

use App\Entity\WidgetContentLine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WidgetContentLine|null find($id, $lockMode = null, $lockVersion = null)
 * @method WidgetContentLine|null findOneBy(array $criteria, array $orderBy = null)
 * @method WidgetContentLine[]    findAll()
 * @method WidgetContentLine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WidgetContentLineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WidgetContentLine::class);
    }

    // /**
    //  * @return WidgetContentLine[] Returns an array of WidgetContentLine objects
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
    public function findOneBySomeField($value): ?WidgetContentLine
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
