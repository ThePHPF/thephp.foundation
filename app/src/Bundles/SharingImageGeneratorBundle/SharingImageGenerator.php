<?php

namespace App\Bundles\SharingImageGeneratorBundle;

use App\PhpFoundation\Team;
use Dflydev\DotAccessConfiguration\Configuration;
use Sculpin\Core\Event\SourceSetEvent;
use Sculpin\Core\Sculpin;
use Sculpin\Core\Source\FileSource;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;

class SharingImageGenerator implements EventSubscriberInterface
{
    private Configuration $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            Sculpin::EVENT_BEFORE_RUN => 'beforeRun',
        ];
    }

    public function beforeRun(SourceSetEvent $sourceSetEvent): void
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

            $data = $source->data();

            if (!$data->get('title')) {
                continue;
            }

            $filename = str_replace('.md', '.png', $source->file()->getFilename());

            $image = new \App\Seo\SharingImageGenerator();
            if ($title = $data->get('title')) {
                $image->setTitle($title);
            }

            $authors = [];
            foreach ((array)$data->get('author') as $author) {
                if ($item = Team::getMemberByCode($author)) {
                    $authors[] = $item['name'];
                }
            }

            $image->setAuthor('by ' . implode(', ', $authors));

            $image->save("output_$env/assets/share/$filename");
        }
    }
}