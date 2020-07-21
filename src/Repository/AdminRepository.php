<?php

namespace App\Repository;

use App\Entity\Admin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Admin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Admin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Admin[]    findAll()
 * @method Admin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdminRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Admin::class);
    }

    public function getLocalAdministrator(){
        return $this->createQueryBuilder('admin')
            ->where('admin.role = 3')
            ->orWhere('admin.role = 6')
            ->orWhere('admin.role = 7')
            ->getQuery()
            ->getResult();
    }


    public function getAffiliatedModule($id){
        return $this->createQueryBuilder('admin')
            ->innerJoin('admin.modules','modules')
            ->getQuery()
            ->getResult();
    }

    public function getAllCaissier(){
        return $this->createQueryBuilder('caissier')
            ->select('caissier.id','caissier.username')
            ->innerJoin('caissier.role','role')
            ->where('role.id = 11')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Admin[] Returns an array of Admin objects
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
    public function findOneBySomeField($value): ?Admin
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function getClientData($username)
    {
        return $this->createQueryBuilder('admin')
            ->select('admin.username','admin.id','admin.password','role.label')
            ->innerJoin("admin.role",'role')
            ->where('admin.username = :username')
            ->setParameter('username',$username)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
