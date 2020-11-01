<?php

namespace App\Repository;

use App\Entity\Tovari;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tovari|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tovari|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tovari[]    findAll()
 * @method Tovari[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TovariRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tovari::class);
    }

    // /**
    //  * @return Tovari[] Returns an array of Tovari objects
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
    public function findOneBySomeField($value): ?Tovari
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
