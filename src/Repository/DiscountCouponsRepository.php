<?php

namespace App\Repository;

use App\Entity\DiscountCoupons;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DiscountCoupons|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiscountCoupons|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiscountCoupons[]    findAll()
 * @method DiscountCoupons[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiscountCouponsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DiscountCoupons::class);
    }

    // /**
    //  * @return DiscountCoupons[] Returns an array of DiscountCoupons objects
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
    public function findOneBySomeField($value): ?DiscountCoupons
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
