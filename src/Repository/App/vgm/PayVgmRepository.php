<?php

namespace App\Repository\App\vgm;

use App\Entity\App\vgm\PayVgm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PayVgm|null find($id, $lockMode = null, $lockVersion = null)
 * @method PayVgm|null findOneBy(array $criteria, array $orderBy = null)
 * @method PayVgm[]    findAll()
 * @method PayVgm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PayVgmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PayVgm::class);
    }

    // /**
    //  * @return PayVgm[] Returns an array of PayVgm objects
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
    public function findOneBySomeField($value): ?PayVgm
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
