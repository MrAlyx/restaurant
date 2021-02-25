<?php

namespace App\Repository;

use App\Entity\Reservering;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reservering|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservering|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservering[]    findAll()
 * @method Reservering[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReserveringRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservering::class);
    }

    // /**
    //  * @return Reservering[] Returns an array of Reservering objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Reservering
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
