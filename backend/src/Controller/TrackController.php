<?php

namespace App\Controller;

use App\Entity\Track;
use App\Repository\TrackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TrackController extends AbstractController
{
    public function __construct(private TrackRepository $trackRepository)
    {
    }

    #[Route('/api/tracks', methods: ['GET'])]
    public function getAll(): JsonResponse
    {
        $tracks = $this->trackRepository->findAll();
        return $this->json($tracks);
    }

    #[Route('/api/tracks/{id}', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        $track = $this->trackRepository->find($id);
        if (!$track) {
            return $this->json(['error' => 'Track not found'], 404);
        }
        return $this->json($track);
    }

    #[Route('/api/tracks', methods: ['POST'])]
    public function create(int $id): JsonResponse
    {
        $this->trackRepository->save($track);
        return $this->json($track, 201);
    }

    #[Route('/api/tracks/{id}', methods: ['PUT'])]
    public function update(int $id): JsonResponse
    {
        $existingTrack = $this->trackRepository->find($id);
        if (!$existingTrack) {
            return $this->json(['error' => 'Track not found'], 404);
        }
        $existingTrack->setName($track->getName());
        $this->trackRepository->save($existingTrack);
        return $this->json($existingTrack);
    }
}