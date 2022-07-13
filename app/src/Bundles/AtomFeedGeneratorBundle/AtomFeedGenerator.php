<?php

namespace App\Bundles\AtomFeedGeneratorBundle;

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

    public static function getSubscribedEvents()
    {
        return [
            Sculpin::EVENT_AFTER_RUN => 'afterRun',
        ];
    }

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function afterRun(SourceSetEvent $sourceSetEvent)
    {
        $sourceSet = $sourceSetEvent->sourceSet();

        $env = $this->configuration->get('env') ?? 'dev';

        $baseUrl = $this->configuration->get('url') ?? 'http://localhost';

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

            if ($source->file()->getExtension() !== 'md') {
                continue;
            }

            if (!$source->data()->get('author')) {
                continue;
            }

            if ($data = $source->data()) {
                $slug = mb_strtolower(preg_replace('/\W/', '_', $data->get('author.name')));

                $post = new Entry();

                $post->title = $data->get('title');
                $post->link = $baseUrl.$data->get('url');
                $post->author = $data->get('author.name');
                $post->authorURL = $data->get('author.url');
                $post->description = $data->get('blocks.content');

                $entries["output_$env/rss/$slug.xml"][] = $post;
            }
        }

        $this->generateFeed($entries);
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