<?php

namespace App\Bundles\RedditifyBundle;

use Dflydev\DotAccessConfiguration\Configuration;
use Sculpin\Core\Sculpin;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class RedditifyAssetCopier implements EventSubscriberInterface
{
    private Configuration $configuration;
    private Filesystem $filesystem;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
        $this->filesystem = new Filesystem();
    }

    public static function getSubscribedEvents(): array
    {
        return [
            Sculpin::EVENT_BEFORE_RUN => 'copyRedditifyAssets',
        ];
    }

    public function copyRedditifyAssets(): void
    {
        $env = $this->configuration->get('env') ?? 'dev';
        $outputDir = "output_{$env}";
        
        $jsTargetDir = "{$outputDir}/assets/js";
        $cssTargetDir = "{$outputDir}/assets/css";
        
        $this->filesystem->mkdir([$jsTargetDir, $cssTargetDir]);
        
        $nodePath = 'node_modules/redditify/dist/';
        
        if (file_exists($nodePath . 'redditify.min.js')) {
            $this->filesystem->copy(
                $nodePath . 'redditify.min.js',
                $jsTargetDir . '/redditify.min.js'
            );
        }
        
        if (file_exists($nodePath . 'redditify.css')) {
            $this->filesystem->copy(
                $nodePath . 'redditify.css',
                $cssTargetDir . '/redditify.css'
            );
        }
    }
}
