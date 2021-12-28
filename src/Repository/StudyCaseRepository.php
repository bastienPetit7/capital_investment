<?php

namespace App\Repository;

use App\Entity\StudyCase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StudyCase|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudyCase|null findOneBy(array $criteria, array $orderBy = null)
 * @method StudyCase[]    findAll()
 * @method StudyCase[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudyCaseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StudyCase::class);
    }

    // /**
    //  * @return StudyCase[] Returns an array of StudyCase objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StudyCase
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
