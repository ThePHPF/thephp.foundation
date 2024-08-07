<?php

use App\Bundles\AtomFeedGeneratorBundle\SculpinAtomFeedGeneratorBundle;
use App\Bundles\MermaidBundle\SculpinMermaidBundle;
use App\Bundles\PhpFoundationBundle\PhpFoundationBundle;
use App\Bundles\SharingImageGeneratorBundle\SculpinSharingImageGeneratorBundle;
use Sculpin\Bundle\SculpinBundle\HttpKernel\AbstractKernel;

class SculpinKernel extends AbstractKernel
{
    protected function getAdditionalSculpinBundles(): array
    {
        return [
            SculpinAtomFeedGeneratorBundle::class,
            SculpinSharingImageGeneratorBundle::class,
            SculpinMermaidBundle::class,
            PhpFoundationBundle::class,
            App\Bundles\RedirectBundle\SculpinRedirectBundle::class,
        ];
    }
}
