<?php

namespace App\Bundles\PhpFoundationBundle\Extensions;

use Dflydev\DotAccessConfiguration\Configuration;
use SculpinKernel;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class PhpFoundation extends AbstractExtension
{

    public function __construct(private SculpinKernel $kernel)
    {
    }

    public function getName(): string
    {
        return 'include_php';
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('fetch_sponsors', [$this, 'fetchSponsors']),
        ];
    }
    
    public function fetchSponsors()
    {
        $url = 'https://opencollective.com/phpfoundation/members/organizations.json';

        $response = file_get_contents($url);
        $json = json_decode($response, associative: false, flags: JSON_THROW_ON_ERROR);

        $unique = array_reduce($json, function ($carry, $item) {
            $carry[$item->name] = $item;
            return $carry;
        }, []);

        uasort($unique, function ($a, $b) {
            return $b->totalAmountDonated - $a->totalAmountDonated;
        });

        //$sponsors = array_slice($unique, 0, 24);
        $sponsors = $unique;
        
        $sponsors_map = [
            'Platinum' => ['JetBrains', 'Automattic'],
            'Gold' => [
                'Private Packagist', 'Craft CMS', 'Tideways', 'Cybozu', 'Zend by Perforce',
                'Aternos GmbH', 'Mercari Inc.', 'Livesport s.r.o.', 'Acquia', 'Symfony Corp',
                'pixiv Inc.', 'Les-Tilleuls.coop', 'shopware AG', 'Ardennes-étape'
            ],
            'Silver' => []
        ];

        array_walk_recursive($sponsors_map, function(&$value) use ($sponsors) {
            $value = $sponsors[$value] ?? null;
        });

        return $sponsors_map;
    }
}
