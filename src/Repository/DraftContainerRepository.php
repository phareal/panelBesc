<?php

namespace App\Repository;

use App\Entity\DraftContainer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Query;

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

    public function customFindAll(){
        return $this->createQueryBuilder('draftContainer')
            ->select('draftContainer.id','containerType.label','draftContainer.proprietaireCode','draftContainer.identificationNumber')
            ->innerJoin('draftContainer.armateur','armateur')
            ->innerJoin('draftContainer.container','containerType')
            ->getQuery()
            ->getResult();
    }


    public function searchContainer($query){
        return $this->createQueryBuilder('container')
            ->select('container.identificationNumber')
            ->where('container.identificationNumber LIKE :query')
            ->setParameter('query','%'.$query.'%')
            ->getQuery()
            ->getScalarResult();
    }


    public function findByIdNum($idNum){

        try {
            return $this->createQueryBuilder('draftContainer')
                ->select('armateur.id as armateur_id',
                    'client.label',
                    'draftContainer.tareWeight',
                    'draftContainer.proprietaireCode',
                    'draftContainer.goodCode',
                    'draftContainer.id as id',
                    'draftContainer.containerSize',
                    'draftContainer.registerNumber')
                ->where('draftContainer.identificationNumber = :params')
                ->innerJoin('draftContainer.armateur', 'armateur')
                ->innerJoin('armateur.client', 'client')
                ->setParameter('params', $idNum)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }



}
