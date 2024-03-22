<?php

namespace App\Bundles\MermaidBundle;

use Dflydev\DotAccessConfiguration\Configuration;
use Sculpin\Core\Event\ConvertEvent;
use Sculpin\Core\Sculpin;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Process\Process;

class MermaidConverter implements EventSubscriberInterface
{
    private Configuration $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            Sculpin::EVENT_BEFORE_CONVERT => 'beforeConvert',
        ];
    }

    public function beforeConvert(ConvertEvent $event): void
    {
        $env = $this->configuration->get('env') ?? 'dev';
        
        $source = $event->source();
        $original_file = file_get_contents($source->file()->getRealPath());
        $original_content = $source->content();
        if (is_null($original_content) || !str_contains($original_content, '```mermaid')) {
            return;
        }
        
        $year = date('Y', $source->data()->get('date'));
        $slug = basename($source->data()->get('url'));
        $filesystem = new Filesystem();
        $assets_path = "/assets/post-images/{$year}/{$slug}/";
        $image_path = "output_$env{$assets_path}";
        if (!$filesystem->exists($image_path)) {
            $filesystem->mkdir($image_path);
        }

        $process = new Process([
            'npx', '-p', '@mermaid-js/mermaid-cli', 
            'mmdc', '-i', $source->file()->getRealPath(),
//            '-o', $source->file()->getRealPath(),
        ]);
        echo "\n";
        $process->run(function($type, $buffer) { echo($buffer); });

        $finder = new Finder();
        $finder->files()->in(dirname($source->file()->getRealPath()))->name('*.svg')->sortByName(true);

        $mermaid_block_regex = '/```mermaid([^\S\n]*\r?\n([\s\S]*?))```/';
        
        $diagrams = [];
        foreach ($finder as $file) {
            $filesystem->copy($file->getRealPath(), $image_path . $file->getFilename());
            $diagrams[] = $assets_path . $file->getFilename();
            $filesystem->remove($file->getRealPath());
        }

        $new_content = $original_content;
        $i = 0;
        $new_content = preg_replace_callback(
            $mermaid_block_regex,
            function ($matches) use ($diagrams, &$i) {
                return sprintf("![Diagram %d](%s)", $i, $diagrams[$i++]);
            },
            $new_content
        );

        $source->setContent($new_content);
    }
}
