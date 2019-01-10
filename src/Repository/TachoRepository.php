<?php
/**
 * Created by PhpStorm.
 * User: Dawid Pierzak
 * Date: 10.01.2019
 * Time: 16:06
 */

namespace App\Repository;

use App\Entity\Tachograph;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class TachoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tachograph::class);
    }

    public function countKm($user){
        $qb = $this->createQueryBuilder('t')
            ->Join('t.user','u')
            ->where('u.username = :user')
            ->setParameter('user',$user)->getQuery();
        $return = $qb->execute();
        $count = 0;
        /** @var Tachograph $tacho */
        foreach($return as $tacho){
            $sum = 0;
            $sum = $tacho->getEndKm()-$tacho->getStartKm();
            $count += $sum;
        }
        return $count;
    }

}