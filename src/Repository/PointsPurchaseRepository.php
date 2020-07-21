<?php

namespace App\Repository;

use App\Entity\PointsPurchase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PointsPurchase|null find($id, $lockMode = null, $lockVersion = null)
 * @method PointsPurchase|null findOneBy(array $criteria, array $orderBy = null)
 * @method PointsPurchase[]    findAll()
 * @method PointsPurchase[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PointsPurchaseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PointsPurchase::class);
    }

    // /**
    //  * @return PointsPurchase[] Returns an array of PointsPurchase objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PointsPurchase
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getAllMyPurchasesPoint($id){
        return $this->createQueryBuilder('points_purchase')
            ->select('points_purchase.id','points_purchase.buyAt','points_purchase.buyPoint','seller.username')
            ->innerJoin('points_purchase.client','client')
            ->innerJoin('points_purchase.seller','seller')
            ->where('client.id = :client_id')
            ->setParameter('client_id',$id)
            ->getQuery()
            ->getResult();
    }
}
