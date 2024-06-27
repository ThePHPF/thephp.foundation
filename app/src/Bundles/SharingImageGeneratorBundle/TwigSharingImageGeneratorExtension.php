<?php

namespace App\Bundles\SharingImageGeneratorBundle;

use Dflydev\DotAccessConfiguration\Configuration;
use Symfony\Component\Filesystem\Filesystem;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigSharingImageGeneratorExtension extends AbstractExtension
{
    private Configuration $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getName(): string
    {
        return 'sharing_image_generator';
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('sharing_image', [$this, 'getSharingImage']),
        ];
    }

    public function getSharingImage(string $filename): string
    {
        $filesystem = new Filesystem();

        $env = $this->configuration->get('env') ?? 'dev';
        $filename = str_replace('.md', '.png', $filename);
        if ($filesystem->exists("output_$env/assets/share/$filename")) {
            return "/assets/share/$filename";
        }

        return '/assets/icons/share.png';
    }
}