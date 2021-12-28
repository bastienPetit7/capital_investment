<?php

namespace App\Repository;

use App\Entity\ContentListDocument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContentListDocument|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContentListDocument|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContentListDocument[]    findAll()
 * @method ContentListDocument[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContentListDocumentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContentListDocument::class);
    }

    // /**
    //  * @return ContentListDocument[] Returns an array of ContentListDocument objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ContentListDocument
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
