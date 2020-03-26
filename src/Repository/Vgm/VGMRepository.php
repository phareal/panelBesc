<?php

namespace App\Repository\Vgm;

use App\Entity\Vgm\VGM;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method VGM|null find($id, $lockMode = null, $lockVersion = null)
 * @method VGM|null findOneBy(array $criteria, array $orderBy = null)
 * @method VGM[]    findAll()
 * @method VGM[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VGMRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VGM::class);
    }

    // /**
    //  * @return VGM[] Returns an array of VGM objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VGM
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getAllVGM(){
        return $this->createQueryBuilder('vgm')
            ->select('draft.identificationNumber','vgm.state','vgm.id')
            ->innerJoin('vgm.container','container')
            ->innerJoin('container.draft','draft')
            ->getQuery()
            ->getResult();
    }


    public function getSingleDetails($id){

        return $this->createQueryBuilder('vgm')
            ->select('vgm.id as id','vgm.state',
                'draft.identificationNumber',
                'pay_vgm.id as vgm_id',
                'container.tvfDate','container.agreementNumber','container.driver','container.booking',
                'container.companyId','container.consignee','container.netWeight','container.requestTime','certifyingOfficer.username')
            ->innerJoin('vgm.container','container')
            ->innerJoin('container.draft','draft')
            ->innerJoin('container.certifyingOfficer','certifyingOfficer')
            ->leftJoin('vgm.payVgm','pay_vgm')
            ->leftJoin('pay_vgm.client','client')
            ->where('vgm.id = :id')
            ->setParameter('id',$id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
