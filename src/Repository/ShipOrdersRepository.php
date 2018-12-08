<?php

namespace App\Repository;

use App\Entity\ShipOrders;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ShipOrders|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShipOrders|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShipOrders[]    findAll()
 * @method ShipOrders[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShipOrdersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ShipOrders::class);
    }

    // /**
    //  * @return ShipOrders[] Returns an array of ShipOrders objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ShipOrders
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
