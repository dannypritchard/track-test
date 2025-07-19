<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use App\Repository\TrackRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TrackRepository::class)]
final class Track
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    #[Groups(['track:read', 'track:write'])]
    private int $id;

    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Groups(['track:read', 'track:write'])]
    private string $title;

    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Groups(['track:read', 'track:write'])]
    private string $artist;

    #[ORM\Column(type: Types::INTEGER)]
    #[Groups(['track:read', 'track:write'])]
    private int $duration;

    #[ORM\Column(type: Types::STRING, length: 20, nullable: true)]
    #[Groups(['track:read', 'track:write'])]
    #[Assert\Regex(pattern: '/^[A-Z]{2}-[A-Z0-9]{3}-\d{2}-\d{5}$/')]
    private ?string $isrc = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getArtist(): string
    {
        return $this->artist;
    }

    public function setArtist(string $artist): self
    {
        $this->artist = $artist;
        return $this;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;
        return $this;
    }


    public function getIsrc(): ?string
    {
        return $this->isrc;
    }

    public function setIsrc(?string $isrc): self
    {
        $this->isrc = $isrc;
        return $this;
    }
}
