<?php

namespace App\Repository;

use App\Entity\Bon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bon[]    findAll()
 * @method Bon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bon::class);
    }

    // /**
    //  * @return Bon[] Returns an array of Bon objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bon
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
