<?php

namespace App\Repository;

use App\Entity\Studentcls;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Studentcls>
 *
 * @method Studentcls|null find($id, $lockMode = null, $lockVersion = null)
 * @method Studentcls|null findOneBy(array $criteria, array $orderBy = null)
 * @method Studentcls[]    findAll()
 * @method Studentcls[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentclsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Studentcls::class);
    }

    public function add(Studentcls $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Studentcls $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Studentcls[] Returns an array of Studentcls objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Studentcls
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function fetchStudentByClass($klass){
 $em=$this->getEntityManager();
 $req=$em->createQuery("select s.ref,c.name from App\Entity\Student s join s.classroom c where c.name=:t");
 $req->setParameter('t',$klass);
 $resultt=$req->getResult();
 return $resultt;

}
    
}
