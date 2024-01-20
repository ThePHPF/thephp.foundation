<?php

namespace App\Sitemap;

readonly class Entry
{
    /**
     * @param Author[] $authors
     */
    public function __construct(
        public string             $title,
        public string             $link,
        public array              $authors,
        public string             $description,
        public \DateTimeImmutable $published_at,
    )
    {
    }
}
