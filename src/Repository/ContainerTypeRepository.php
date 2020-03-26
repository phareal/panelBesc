<?php

namespace App\Repository;

use App\Entity\ContainerType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ContainerType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContainerType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContainerType[]    findAll()
 * @method ContainerType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContainerTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContainerType::class);
    }

    // /**
    //  * @return ContainerType[] Returns an array of ContainerType objects
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
    public function findOneBySomeField($value): ?ContainerType
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
