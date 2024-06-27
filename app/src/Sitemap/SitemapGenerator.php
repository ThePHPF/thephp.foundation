<?php

namespace App\Sitemap;

use DOMDocument;

final class SitemapGenerator
{
    private string $title;

    private string $description;

    /** @var Entry[] */
    private array $entries = [];

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function addEntry(Entry $entry): void
    {
        $this->entries[] = $entry;
    }

    public function saveFeed(string $path): void
    {
        $dom = new DOMDocument('1.0', 'utf-8');
        $feed = $dom->createElement('feed');
        $feed->setAttribute('xmlns', 'http://www.w3.org/2005/Atom');

        $title = $dom->createElement('title');
        $title->appendChild($dom->createCDATASection($this->title));

        $description = $dom->createElement('description');
        $description->appendChild($dom->createCDATASection($this->description));
        $feed->append($title, $description);

        $feed->append($dom->createElement('updated', date('c')));

        foreach ($this->entries as $entry) {
            $element = $dom->createElement('entry');

            $title = $dom->createElement('title');
            $title->setAttribute('type', 'html');
            $title->appendChild($dom->createCDATASection($entry->title));

            $content = $dom->createElement('content');
            $content->setAttribute('type', 'html');
            $content->appendChild($dom->createCDATASection($entry->description));

            $link = $dom->createElement('link');
            $link->setAttribute('href', $entry->link);

            $id = $dom->createElement('id', $entry->link);

            foreach ($entry->authors as $authorEntity) {
                $author = $dom->createElement('author');
                $author->appendChild($dom->createElement('name', $authorEntity->name));
                $author->appendChild($dom->createElement('uri', $authorEntity->url));

                $element->append($author);
            }

            $updated = $dom->createElement('updated', $entry->published_at->format(DATE_RSS));

            $element->append($title, $content, $link, $id, $updated);

            $feed->append($element);
        }

        $dom->append($feed);

        file_put_contents($path, $dom->saveXML());
    }
}
