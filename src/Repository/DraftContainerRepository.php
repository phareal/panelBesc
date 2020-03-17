<?php

namespace App\Repository;

use App\Entity\DraftContainer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DraftContainer|null find($id, $lockMode = null, $lockVersion = null)
 * @method DraftContainer|null findOneBy(array $criteria, array $orderBy = null)
 * @method DraftContainer[]    findAll()
 * @method DraftContainer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DraftContainerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DraftContainer::class);
    }

    // /**
    //  * @return DraftContainer[] Returns an array of DraftContainer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DraftContainer
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
