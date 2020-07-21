<?php

namespace App\Repository\Vgm;

use App\Entity\VgModule\DraftAttachment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DraftAttachment|null find($id, $lockMode = null, $lockVersion = null)
 * @method DraftAttachment|null findOneBy(array $criteria, array $orderBy = null)
 * @method DraftAttachment[]    findAll()
 * @method DraftAttachment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DraftAttachmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DraftAttachment::class);
    }

    // /**
    //  * @return DraftAttachment[] Returns an array of DraftAttachment objects
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
    public function findOneBySomeField($value): ?DraftAttachment
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getVGMAttachments($id){
        return $this->createQueryBuilder('draftAttachment')
            ->innerJoin('draftAttachment.vgm','vgm')
            ->select('vgm.id as vgm_id','draftAttachment.url','draftAttachment.name')
            ->where('vgm.id = :id')
            ->setParameter('id',$id)
            ->getQuery()
            ->getResult();
    }
}
