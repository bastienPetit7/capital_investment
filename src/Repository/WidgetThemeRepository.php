<?php

namespace App\Repository;

use App\Entity\WidgetTheme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WidgetTheme|null find($id, $lockMode = null, $lockVersion = null)
 * @method WidgetTheme|null findOneBy(array $criteria, array $orderBy = null)
 * @method WidgetTheme[]    findAll()
 * @method WidgetTheme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WidgetThemeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WidgetTheme::class);
    }

    // /**
    //  * @return WidgetTheme[] Returns an array of WidgetTheme objects
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
    public function findOneBySomeField($value): ?WidgetTheme
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
