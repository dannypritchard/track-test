<?php

namespace App\Controller;

use App\Dto\TrackRequest;
use App\Entity\Track;
use App\Repository\TrackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpFoundation\Response;

class TrackController extends AbstractController
{
    public function __construct(private TrackRepository $trackRepository)
    {
    }

    #[Route('/api/tracks', methods: ['GET'], format: 'json')]
    public function getAll(): JsonResponse
    {
        $tracks = $this->trackRepository->findAll();

        return $this->json(
            $tracks,
            Response::HTTP_OK,
            context: ['groups' => 'track:read']
        );
    }

    #[Route('/api/tracks', methods: ['POST'], format: 'json')]
    public function create(
        #[MapRequestPayload] TrackRequest $request
    ): JsonResponse {
        $track = (new Track())
            ->setTitle($request->title)
            ->setArtist($request->artist)
            ->setDuration($request->duration)
            ->setIsrc($request->isrc);

        $this->trackRepository->save($track);

        return $this->json(
            $track,
            Response::HTTP_CREATED,
            context: ['groups' => 'track:write']
        );
    }

    #[Route('/api/tracks/{id}', methods: ['PUT'], format: 'json')]
    public function update(
        Track $track,
        #[MapRequestPayload] TrackRequest $request,
    ): JsonResponse {
        $track
            ->setTitle($request->title)
            ->setArtist($request->artist)
            ->setDuration($request->duration)
            ->setIsrc($request->isrc);

        $this->trackRepository->save($track);

        return $this->json(
            $track,
            Response::HTTP_OK,
            context: ['groups' => 'track:write']
        );
    }
}
