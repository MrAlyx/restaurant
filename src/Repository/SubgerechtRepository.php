<?php

namespace App\Repository;

use App\Entity\Subgerecht;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Subgerecht|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subgerecht|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subgerecht[]    findAll()
 * @method Subgerecht[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubgerechtRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subgerecht::class);
    }

    // /**
    //  * @return Subgerecht[] Returns an array of Subgerecht objects
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
    public function findOneBySomeField($value): ?Subgerecht
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
