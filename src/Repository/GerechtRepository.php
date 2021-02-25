<?php

namespace App\Repository;

use App\Entity\Gerecht;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gerecht|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gerecht|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gerecht[]    findAll()
 * @method Gerecht[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GerechtRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gerecht::class);
    }

    // /**
    //  * @return Gerecht[] Returns an array of Gerecht objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gerecht
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
