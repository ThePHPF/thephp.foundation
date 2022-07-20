<?php

namespace App\Sitemap;

class Entry
{
    public string $title;

    public string $link;

    public string $author;

    public string $authorURL;

    public string $description;
    
    public \DateTimeImmutable $published_at;
}
