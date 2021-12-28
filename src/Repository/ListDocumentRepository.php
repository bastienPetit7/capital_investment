<?php

namespace App\Repository;

use App\Entity\ListDocument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ListDocument|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListDocument|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListDocument[]    findAll()
 * @method ListDocument[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListDocumentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListDocument::class);
    }

    // /**
    //  * @return ListDocument[] Returns an array of ListDocument objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ListDocument
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
