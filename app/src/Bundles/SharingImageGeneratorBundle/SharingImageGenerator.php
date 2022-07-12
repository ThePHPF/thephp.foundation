<?php

namespace App\Bundles\SharingImageGeneratorBundle;

use Dflydev\DotAccessConfiguration\Configuration;
use Sculpin\Core\Event\SourceSetEvent;
use Sculpin\Core\Sculpin;
use Sculpin\Core\Source\FileSource;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;

class SharingImageGenerator implements EventSubscriberInterface
{
    protected $configuration;

    public static function getSubscribedEvents()
    {
        return [
            Sculpin::EVENT_BEFORE_RUN => 'beforeRun',
        ];
    }

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function beforeRun(SourceSetEvent $sourceSetEvent)
    {
        $sourceSet = $sourceSetEvent->sourceSet();

        $env = $this->configuration->get('env') ?? 'dev';

        $filesystem = new Filesystem();
        if (!$filesystem->exists("output_$env/assets/share/")) {
            $filesystem->mkdir("output_$env/assets/share/");
        }

        /** @var FileSource $source */
        foreach ($sourceSet->allSources() as $source) {
            if ($source->isGenerated()) {
                continue;
            }

            if ($source->file()->getExtension() !== 'md') {
                continue;
            }

            if (!$source->data()->get('title')) {
                continue;
            }

            $filename = str_replace('.md', '.png', $source->file()->getFilename());

            $image = new \App\Seo\SharingImageGenerator();
            if ($title = $source->data()->get('title')) {
                $image->setTitle($title);
            }

            if ($author = $source->data()->get('author.name')) {
                $image->setAuthor("by $author");
            }

            $image->save("output_$env/assets/share/$filename");
        }
    }
}