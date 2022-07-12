<?php

namespace App\Bundles\SharingImageGeneratorBundle;

use Symfony\Component\Filesystem\Filesystem;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigSharingImageGeneratorExtension extends AbstractExtension
{
    protected $configuration;

    public function __construct($configuration)
    {
        $this->configuration = $configuration;
    }

    public function getName()
    {
        return 'sharing_image_generator';
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('sharing_image', [$this, 'getSharingImage']),
        ];
    }

    public function getSharingImage($filename)
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