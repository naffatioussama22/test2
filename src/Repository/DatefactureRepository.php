<?php

namespace App\Repository;

use App\Entity\Datefacture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Datefacture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Datefacture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Datefacture[]    findAll()
 * @method Datefacture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DatefactureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Datefacture::class);
    }

    // /**
    //  * @return Datefacture[] Returns an array of Datefacture objects
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
    public function findOneBySomeField($value): ?Datefacture
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
