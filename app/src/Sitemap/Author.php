<?php

namespace App\Sitemap;

readonly class Author
{
    public function __construct(
        public string $name,
        public string $url
    )
    {
    }
}
