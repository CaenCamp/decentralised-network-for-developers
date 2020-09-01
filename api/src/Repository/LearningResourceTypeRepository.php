<?php

namespace App\Repository;

use App\Entity\LearningResourceType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LearningResourceType|null find($id, $lockMode = null, $lockVersion = null)
 * @method LearningResourceType|null findOneBy(array $criteria, array $orderBy = null)
 * @method LearningResourceType[]    findAll()
 * @method LearningResourceType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LearningResourceTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LearningResourceType::class);
    }

    // /**
    //  * @return LearningResourceType[] Returns an array of LearningResourceType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LearningResourceType
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
