<?php
/**
 * Created by PhpStorm.
 * User: Dawid Pierzak
 * Date: 10.01.2019
 * Time: 15:28
 */

namespace App\Repository;


use App\Entity\Load;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class LoadsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Load::class);
    }
    public function getLoads($user){
        $qb = $this->createQueryBuilder('l')
            ->Join('l.user','u')
            ->where('u.username = :user')
            ->setParameter('user',$user)->getQuery();
        $return = $qb->execute();
        return $return;
    }

    public function countLoads($user){
        $qb = $this->createQueryBuilder('l');
        $qb->select('count(l.id)')
        ->join('l.user','u')
        ->where('u.username = :user')
        ->setParameter('user',$user);
        $count = $qb->getQuery()->getSingleScalarResult();
        return $count;
    }

}