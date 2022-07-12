<?php

use App\Bundles\SharingImageGeneratorBundle\SculpinSharingImageGeneratorBundle;
use Sculpin\Bundle\SculpinBundle\HttpKernel\AbstractKernel;

class SculpinKernel extends AbstractKernel
{
    protected function getAdditionalSculpinBundles(): array
    {
        return [
            SculpinSharingImageGeneratorBundle::class
        ];
    }
}