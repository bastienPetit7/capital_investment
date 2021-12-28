<?php

namespace App\Repository;

use App\Entity\ThemeVideo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ThemeVideo|null find($id, $lockMode = null, $lockVersion = null)
 * @method ThemeVideo|null findOneBy(array $criteria, array $orderBy = null)
 * @method ThemeVideo[]    findAll()
 * @method ThemeVideo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThemeVideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ThemeVideo::class);
    }

    // /**
    //  * @return ThemeVideo[] Returns an array of ThemeVideo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ThemeVideo
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
