<?php

namespace App\Repository;

use App\Entity\Bestelling;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bestelling|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bestelling|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bestelling[]    findAll()
 * @method Bestelling[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BestellingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bestelling::class);
    }

    // /**
    //  * @return Bestelling[] Returns an array of Bestelling objects
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
    public function findOneBySomeField($value): ?Bestelling
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
