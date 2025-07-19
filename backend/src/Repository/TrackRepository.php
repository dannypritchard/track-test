<?php

namespace App\Repository;

use App\Entity\Track;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Track>
 */
class TrackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Track::class);
    }

    /**
     * @return Track[]
     */
    public function findAll(): array
    {
        return $this->findBy([], ['id' => 'ASC']);
    }

    public function save(Track $track): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($track);
        $entityManager->flush();
    }
}