<?php

namespace App\Controller;

use App\Dto\TrackRequest;
use App\Entity\Track;
use App\Repository\TrackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

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

    #[Route('/api/tracks', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] TrackRequest $trackCreateRequest
    ): JsonResponse
    {
        $track = (new Track())
            ->setTitle($trackCreateRequest->title)
            ->setArtist($trackCreateRequest->artist)
            ->setDuration($trackCreateRequest->duration)
            ->setIsrc($trackCreateRequest->isrc);

        $this->trackRepository->save($track);
        return $this->json($track, 201);
    }

    #[Route('/api/tracks/{id}', methods: ['PUT'])]
    public function update(
        Track $existingTrack,
        #[MapRequestPayload] TrackRequest $trackRequest,
    ): JsonResponse
    {
        $existingTrack
            ->setTitle($trackRequest->title)
            ->setArtist($trackRequest->artist)
            ->setDuration($trackRequest->duration)
            ->setIsrc($trackRequest->isrc);

        $this->trackRepository->save($existingTrack);
        return $this->json($existingTrack);
    }
}
