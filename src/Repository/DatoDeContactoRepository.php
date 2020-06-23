<?php

namespace App\Repository;

use App\Entity\DatoDeContacto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DatoDeContacto|null find($id, $lockMode = null, $lockVersion = null)
 * @method DatoDeContacto|null findOneBy(array $criteria, array $orderBy = null)
 * @method DatoDeContacto[]    findAll()
 * @method DatoDeContacto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DatoDeContactoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DatoDeContacto::class);
    }

    // /**
    //  * @return DatoDeContacto[] Returns an array of DatoDeContacto objects
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
    public function findOneBySomeField($value): ?DatoDeContacto
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
