<?php

namespace App\Bundles\AtomFeedGeneratorBundle;

use App\Sitemap\Author;
use App\Sitemap\Entry;
use App\Sitemap\SitemapGenerator;
use Dflydev\DotAccessConfiguration\Configuration;
use Sculpin\Core\Event\SourceSetEvent;
use Sculpin\Core\Sculpin;
use Sculpin\Core\Source\FileSource;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;

class AtomFeedGenerator implements EventSubscriberInterface
{
    protected Configuration $configuration;

    public static function getSubscribedEvents(): array
    {
        return [
            Sculpin::EVENT_AFTER_RUN => 'afterRun',
        ];
    }

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function afterRun(SourceSetEvent $sourceSetEvent): void
    {
        $sourceSet = $sourceSetEvent->sourceSet();

        $env = $this->configuration->get('env') ?? 'dev';

        $filesystem = new Filesystem();
        if (!$filesystem->exists("output_$env/rss/")) {
            $filesystem->mkdir("output_$env/rss/");
        }

        $entries = [];

        /** @var FileSource $source */
        foreach ($sourceSet->allSources() as $source) {
            if ($source->isGenerated()) {
                continue;
            }

            $data = $source->data();

            if ($source->file()->getExtension() !== 'md') {
                continue;
            }

            if (!$data->get('author')) {
                continue;
            }

            $authors = [];
            if ($name = $data->get('author.name')) {
                $authors[] = new Author($name, $data->get('author.url'));
            } else {
                foreach ($data->get('author') as $author) {
                    $authors[] = new Author($author['name'], $author['url']);
                }
            }

            foreach ($authors as $author) {
                $slug = $this->slug($author->name);
                $entries["output_$env/rss/$slug.xml"][] = $this->fetchEntry($data, $authors);
            }
        }

        $this->generateFeed($entries);
    }

    protected function fetchEntry(Configuration $data, array $authors): Entry
    {
        $baseUrl = $this->configuration->get('url') ?? 'http://localhost';

        $post = new Entry();

        $post->title = $data->get('title');
        $post->link = $baseUrl . $data->get('url');
        $post->authors = $authors;
        $post->description = $data->get('blocks.content');
        $post->published_at = new \DateTimeImmutable($data->get('published_at'));

        return $post;
    }

    protected function slug($author): string
    {
        return mb_strtolower(preg_replace('/\W/', '_', $author));
    }

    protected function generateFeed(array $entries = []): void
    {
        foreach ($entries as $filePath => $posts) {
            $rss = new SitemapGenerator();
            if ($title = $this->configuration->get('title')) {
                $rss->title = $title;
            }
            if ($subtitle = $this->configuration->get('subtitle')) {
                $rss->description = $subtitle;
            }

            foreach ($posts as $post) {
                $rss->addEntry($post);
            }

            $rss->saveFeed($filePath);
        }
    }
}
