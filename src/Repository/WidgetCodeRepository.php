<?php

namespace App\Repository;

use App\Entity\WidgetCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WidgetCode|null find($id, $lockMode = null, $lockVersion = null)
 * @method WidgetCode|null findOneBy(array $criteria, array $orderBy = null)
 * @method WidgetCode[]    findAll()
 * @method WidgetCode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WidgetCodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WidgetCode::class);
    }

    // /**
    //  * @return WidgetCode[] Returns an array of WidgetCode objects
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
    public function findOneBySomeField($value): ?WidgetCode
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
