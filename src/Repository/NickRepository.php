<?php

namespace App\Repository;

use App\Entity\Nick;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Nick>
 *
 * @method Nick|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nick|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nick[]    findAll()
 * @method Nick[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NickRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nick::class);
    }

//    /**
//     * @return Nick[] Returns an array of Nick objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Nick
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
