<?php

namespace App\Repository;

use App\Entity\Consignataire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Consignataire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Consignataire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Consignataire[]    findAll()
 * @method Consignataire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsignataireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Consignataire::class);
    }

    // /**
    //  * @return Consignataire[] Returns an array of Consignataire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Consignataire
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
