<?php

namespace App\Repository;

use App\Entity\CargoType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CargoType|null find($id, $lockMode = null, $lockVersion = null)
 * @method CargoType|null findOneBy(array $criteria, array $orderBy = null)
 * @method CargoType[]    findAll()
 * @method CargoType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CargoTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CargoType::class);
    }

    // /**
    //  * @return CargoType[] Returns an array of CargoType objects
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
    public function findOneBySomeField($value): ?CargoType
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
