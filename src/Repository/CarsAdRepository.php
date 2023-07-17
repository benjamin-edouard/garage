<?php

namespace App\Repository;

use App\Entity\CarsAd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarsAd>
 *
 * @method CarsAd|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarsAd|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarsAd[]    findAll()
 * @method CarsAd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarsAdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarsAd::class);
    }

//    /**
//     * @return CarsAd[] Returns an array of CarsAd objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CarsAd
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
