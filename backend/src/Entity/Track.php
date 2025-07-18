<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: App\Repository\TrackRepository::class)]
class Track
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Assert\NotBlank]
    private string $title;

    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Assert\NotBlank]
    private string $artist;

    #[ORM\Column(type: Types::INTEGER)]
    #[Assert\NotBlank]
    private int $duration;

    #[ORM\Column(type: Types::STRING, length: 20, nullable: true)]
    #[Assert\Regex(pattern: '/^[A-Z]{2}-[A-Z0-9]{3}-\d{2}-\d{5}$/', message: 'Invalid ISRC format.')]
    private ?string $isrc = null;
}