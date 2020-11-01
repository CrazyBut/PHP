<?php

namespace App\Repository;

use App\Entity\Zakazi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Zakazi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Zakazi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Zakazi[]    findAll()
 * @method Zakazi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZakaziRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Zakazi::class);
    }

    /**
     * @return Zakazi[] Returns an array of Zakazi objects
     */

    public function findtoBy($value)
    {
        $zakazi = $this->findBy(['Zakazchik' => $value]);
        for ($i = 0; $i < count($zakazi); $i++) {
            for ($j = $i + 1; $j < count($zakazi); $j++) {
                if ($zakazi[$i]->getTovar() == $zakazi[$j]->getTovar()) {
                    $zakazi[$i]->setAmount($zakazi[$i]->getAmount() + $zakazi[$j]->getAmount());
                    unset($zakazi[$j]);
                }
            }
        }
        return $zakazi;
    }

    /*
    public function findOneBySomeField($value): ?Zakazi
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
