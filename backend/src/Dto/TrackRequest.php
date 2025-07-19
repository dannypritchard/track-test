<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class TrackRequest
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(max: 255)]
        public readonly string $title,

        #[Assert\NotBlank]
        #[Assert\Length(max: 255)]
        public readonly string $artist,

        #[Assert\NotBlank]
        #[Assert\Range(min: 1)]
        public readonly int $duration,

        #[Assert\Regex(pattern: '/^[A-Z]{2}-[A-Z0-9]{3}-\d{2}-\d{5}$/', message: 'Invalid ISRC format.')]
        public readonly ?string $isrc = null
    ) {}
}
