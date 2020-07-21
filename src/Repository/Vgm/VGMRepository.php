<?php

namespace App\Repository\Vgm;

use App\Entity\VgModule\Vgm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Vgm|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vgm|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vgm[]    findAll()
 * @method Vgm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VGMRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vgm::class);
    }

    // /**
    //  * @return VgModule[] Returns an array of VgModule objects
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
    public function findOneBySomeField($value): ?VgModule
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getAllVGM($id){
        return $this->createQueryBuilder('vgm')
            ->select('draft.identificationNumber','vgm.state','vgm.id')
            ->innerJoin('vgm.container','container')
            ->innerJoin('container.draft','draft')
            ->innerJoin('vgm.admin','admin')
            ->where('admin.id =:id')
            ->setParameter('id',$id)
            ->getQuery()
            ->getResult();
    }

    public function getAllInQueueVGM(){
        return $this->createQueryBuilder('vgm')
            ->select('vgm.vgmNumber','vgm.state','vgm.id')
            ->innerJoin('vgm.container','container')
            ->innerJoin('container.draft','draft')
            ->innerJoin('vgm.admin','admin')
            ->where('vgm.state = 0')
            ->getQuery()
            ->getResult();
    }

    public function getAllCustomVGM(){
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
                'container.id as container_id',
                'draft.tareWeight',
                'client.id as exportator_id',
                'draft.goodCode',
                'container.agreementNumber',
                'container.tvfDate','vgm.vgmNumber','container.driver','container.booking','container.truckNumber',
                'container.companyId','client.label','container.netWeight','container.requestTime',
                'certifyingOfficer.username as _certifyingOfficer')
            ->innerJoin('vgm.container','container')
            ->innerJoin('container.draft','draft')
            ->innerJoin('container.certifyingOfficer','certifyingOfficer')
            ->innerJoin('vgm.exportator','client')
            ->where('vgm.id = :id')
            ->setParameter('id',$id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getAllMyVgm($id)
    {
        return $this->createQueryBuilder('vgm')
            ->select('vgm.id as id','vgm.state','vgm.vgmNumber')
            ->innerJoin('vgm.exportator','exportator')
            ->where('exportator.id = :id')
            ->setParameter('id',$id)
            ->getQuery()
            ->getResult();
    }

    public function getContainerByVgm($iden){
        return $this->createQueryBuilder('vgm')
            ->select('draft.identificationNumber','vgm.state','vgm.id')
            ->innerJoin('vgm.container','container')
            ->innerJoin('container.draft','draft')
            ->innerJoin('vgm.payVgm','payVgm')
            ->where('vgm.state = 2')
            ->where('draft.identificationNumber = :iden')
            ->setParameter('iden',$iden)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function getAllContainerByVgm(){
        return $this->createQueryBuilder('vgm')
            ->select('draft.identificationNumber','vgm.state','vgm.id')
            ->innerJoin('vgm.container','container')
            ->innerJoin('container.draft','draft')
            ->innerJoin('vgm.payVgm','payVgm')
            ->where('vgm.state = 2')
            ->orWhere('vgm.state = 3')
            ->getQuery()
            ->getResult();
    }
}
