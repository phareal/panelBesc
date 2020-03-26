<?php

namespace App\Repository;

use App\Entity\OtherAdmin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OtherAdmin|null find($id, $lockMode = null, $lockVersion = null)
 * @method OtherAdmin|null findOneBy(array $criteria, array $orderBy = null)
 * @method OtherAdmin[]    findAll()
 * @method OtherAdmin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OtherAdminRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OtherAdmin::class);
    }

    // /**
    //  * @return OtherAdmin[] Returns an array of OtherAdmin objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OtherAdmin
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getAllVgmManager(){
        return $this->createQueryBuilder('manager')
            ->select('admin.username','manager.id as id','admin.id as admin_id','role.id as role_id')
            ->join('manager.admin','admin')
            ->join('admin.role','role')
            ->join('admin.module','module')
            ->where('module.id = 1')
            ->getQuery()
            ->getResult();
    }

    public function getAllManager(){
        return $this->createQueryBuilder('manager')
            ->select('admin.password','admin.username','manager.id as id','admin.id as admin_id','role.id as role_id','role.label')
            ->join('manager.admin','admin')
            ->join('admin.role','role')
            ->join('admin.module','module')
            ->getQuery()
            ->getResult();
    }
}
