<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Product $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Product $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    public function findOneByIdAndLocaleIso(int $productId, string $localeIso)
    {
        return $this
            ->findByLocaleIsoQueryBuilder($localeIso)
            ->andWhere('vat.product = :product_id')
            ->setParameter('product_id', $productId)
            ->getQuery()
            ->getOneOrNullResult();
    }
    
    public function findByLocaleIso(string $localeIso)
    {
        return $this
            ->findByLocaleIsoQueryBuilder($localeIso)
            ->getQuery()
            ->execute();
    }

    private function findByLocaleIsoQueryBuilder(string $localeIso):  \Doctrine\ORM\QueryBuilder
    {
        return $this->createQueryBuilder('product')
            ->select(
                'product.id',
                'product.name',
                'product.description', 
                'product.price*(1 + vat.value/100) as price'
            )
            ->innerJoin('App\Entity\Vat', 'vat', 'WITH', 'vat.product = product')
            ->innerJoin('App\Entity\Locale', 'locale', 'WITH', 'vat.country = locale.country')
            ->where('locale.iso = :locale_iso')
            ->setParameter('locale_iso', $localeIso);
    }
}
