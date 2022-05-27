<?php declare(strict_types=1);

namespace App\Repository;

use App\Contracts\UrlRepositoryContract;
use App\Entity\Url;
use App\Exception\NotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UrlRepository extends ServiceEntityRepository implements UrlRepositoryContract
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Url::class);
    }

    public function persist(Url $entity): void
    {
        $this->_em->persist($entity);
    }

    public function existByMinimizingUrl(string $minimizingUrl): bool
    {
        $query = $this->createQueryBuilder('url')
            ->select('count(url.id)')
            ->andWhere('url.minimizingUrl = :minimizingUrl')
            ->setParameter('minimizingUrl', $minimizingUrl);

        return $query->getQuery()->getSingleScalarResult() > 0;
    }

    public function getByMinimizingUrl(string $minimizingUrl): Url
    {
        $query = $this->createQueryBuilder('url')
            ->andWhere('url.minimizingUrl = :minimizingUrl')
            ->setParameter('minimizingUrl', $minimizingUrl);

        /** @var Url $url */
        $url = $query->getQuery()
            ->getOneOrNullResult();

        if (is_null($url)) {
            throw new NotFoundException('Url is not found');
        }

        return $url;
    }
}
