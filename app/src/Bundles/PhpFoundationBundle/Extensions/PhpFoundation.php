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

        $sponsors = $unique;
        
        $sponsors_map = array (
            'Silver' =>
                array (
                    'packagist' => 'Private Packagist',
                    'craftcms' => 'Craft CMS',
                    'zend' => 'Zend by Perforce',
                    'tideways' => 'Tideways',
                    'symfony-sas' => 'Symfony Corp',
                    'mercari' => 'Mercari Inc.',
                    'cooptilleuls' => 'Les-Tilleuls.coop',
                    'user-ecfec7e5' => 'pixiv Inc.',
                    'aternos' => 'Aternos GmbH',
                    'sentry-team' => 'Sentry Team',
                    'ardennes-etape' => 'Ardennes-étape',
                    'cybozu' => 'Cybozu',
                ),
            'Gold' =>
                array (
                    'laravel' => 'Laravel',
                ),
            'Platinum' =>
                array (
                    'jetbrains' => 'JetBrains',
                    'automattic' => 'Automattic',
                    '11004-sovereign-tech-fund-2532c0cc' => 'Sovereign Tech Fund',
                ),
            'Past' =>
                array (
                    'livesport-s-r-o' => 'Livesport s.r.o.',
                    'acquia' => 'Acquia',
                    'stefan-hamann' => 'shopware AG',
                    'opgg' => 'OP.GG',
                    'ec-cube' => 'EC-CUBE',
                    'spryker' => 'Spryker',
                    'polcode' => 'Polcode',
                    'binc' => 'BASE, Inc.',
                    'digital-scholar' => 'Digital Scholar',
                    'rakus' => 'RAKUS',
                    'rakusu' => 'ラクス 中村崇則',
                    'cambium-learning-inc' => 'Cambium Learning, Inc.',
                    'paycom' => 'Paycom',
                    'prestashop' => 'PrestaShop',
                ),
        );

        // FIXME Empty data in OpenCollective
        unset($sponsors_map['Past']['rakusu']);

        // STF is currently a Vendor and does not appear in the orgs list of sponsors
        $sponsors['Sentry Team'] = (object)[
            'name' => 'Sentry',
            'website' => 'https://sentry.io/',
            'image' => 'https://images.opencollective.com/sentry/9620d33/logo/256.png'
        ];

        $sponsors['Laravel']->image = '/assets/sponsors/laravel-logo.svg';

        $sponsors['Sovereign Tech Fund'] = (object)[
            'name' => 'Sovereign Tech Fund',
            'website' => 'https://www.sovereigntechfund.de/',
            'image' => '/assets/sponsors/STF-Logo-Std-Black-RGB.svg'
        ];

        $sponsors_map['Advisory Board'] = [
            'zend' => 'Zend by Perforce',
            'packagist' => 'Private Packagist',
            'tideways' => 'Tideways',
            'symfony-sas' => 'Symfony',
            'prestashop' => 'PrestaShop',
            'laravel' => 'Laravel',
            'stefan-hamann' => 'shopware AG',
            'craftcms' => 'Craft CMS',
            'automattic' => 'Automattic',
            'jetbrains' => 'JetBrains',
        ];

        array_walk_recursive($sponsors_map, function(&$value) use ($sponsors) {
            $value = $sponsors[$value] ?? null;
        });

        return $sponsors_map;
    }
}
