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
        if (empty($zakazi)) {
            return $zakazi;
        }
        foreach ($zakazi as &$item1) {
            foreach ($zakazi as &$item2) {
                if (!($item1 == $item2)) {
                    if ($item1->getTovar() == $item2->getTovar()) {
                        $item1->setamount($item1->getAmount() + $item2->getAmount());
                        unset($item2);
                    }
                }
            }
            unset($item2);
        }
        unset($item1);
        foreach ($zakazi as $item) {
            $resultt = array_shift($zakazi);
            if (empty($zakazi)) {
                break;
            }
            while ($zakazi[0]->getTovar() == $resultt->gettovar()) {
                array_shift($zakazi);
                if (empty($zakazi)) {
                    break;
                }
            }
            $result[] = $resultt;
        }
        return $result;

    }
}
