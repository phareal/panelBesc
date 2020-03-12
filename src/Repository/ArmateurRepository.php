<?php

namespace App\Repository;

use App\Entity\Armateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Armateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Armateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Armateur[]    findAll()
 * @method Armateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArmateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Armateur::class);
    }

    // /**
    //  * @return Armateur[] Returns an array of Armateur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Armateur
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
