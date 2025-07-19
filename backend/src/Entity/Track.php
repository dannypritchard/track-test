<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use App\Repository\TrackRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TrackRepository::class)]
final class Track implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $title;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $artist;

    #[ORM\Column(type: Types::INTEGER)]
    private int $duration;

    /**
     * NOTE: ISRC is a string here, in the datamodel
     * We use a regex to validate its format in the input DTO to avoid domain logic in the entity.
     * @see \App\Dto\TrackRequest
     */
    #[ORM\Column(type: Types::STRING, length: 20, nullable: true)]
    private ?string $isrc = null;

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function setArtist(string $artist): self
    {
        $this->artist = $artist;
        return $this;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;
        return $this;
    }

    public function setIsrc(?string $isrc): self
    {
        $this->isrc = $isrc;
        return $this;
    }

    /**
     * @return array{ id: int, title: string, artist: string, duration: int, isrc: ?string }
     */
    public function jsonSerialize(): array
    {
        return [
            'id'       => $this->id,
            'title'    => $this->title,
            'artist'   => $this->artist,
            'duration' => $this->duration,
            'isrc'     => $this->isrc,
        ];
    }
}
