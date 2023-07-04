<?php

namespace App\Sitemap;

class Author
{
    public function __construct($name, $url)
    {
        $this->name = $name;
        $this->url = $url;
    }

    public string $name;

    public string $url;
}
