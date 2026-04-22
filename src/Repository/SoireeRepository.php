<?php

namespace App\Repository;

use App\Entity\Soiree;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Soiree>
 */
class SoireeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Soiree::class);
    }

    /**
     * Récupère les 3 prochaines soirées à venir
     */
    public function findNextThree(): array
    {
        return $this->createQueryBuilder('s')
            ->where('s.date >= :now')
            ->setParameter('now', new \DateTimeImmutable())
            ->orderBy('s.date', 'ASC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }
}