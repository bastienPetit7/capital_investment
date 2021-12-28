<?php

namespace App\Repository;

use App\Entity\ThemeStudyCase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ThemeStudyCase|null find($id, $lockMode = null, $lockVersion = null)
 * @method ThemeStudyCase|null findOneBy(array $criteria, array $orderBy = null)
 * @method ThemeStudyCase[]    findAll()
 * @method ThemeStudyCase[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThemeStudyCaseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ThemeStudyCase::class);
    }

    // /**
    //  * @return ThemeStudyCase[] Returns an array of ThemeStudyCase objects
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
    public function findOneBySomeField($value): ?ThemeStudyCase
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
