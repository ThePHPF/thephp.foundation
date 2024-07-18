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
        
        $sponsors_map = array (
            'Silver' =>
                array (
                    'packagist' => 'Private Packagist',
                    'zend' => 'Zend by Perforce',
                    'tideways' => 'Tideways',
                    'symfony-sas' => 'Symfony Corp',
                    'cooptilleuls' => 'Les-Tilleuls.coop',
                    'ardennes-etape' => 'Ardennes-étape',
                    'sentry-team' => 'Sentry Team',
                    'aternos' => 'Aternos GmbH',
                    'cybozu' => 'Cybozu',
                    'mercari' => 'Mercari Inc.',
                    'user-ecfec7e5' => 'pixiv Inc.',
                    'oro' => 'Oro',
                    'aligent-consulting' => 'Aligent Consulting',
                ),
            'Gold' =>
                array (
                    '11004-sovereign-tech-fund-2532c0cc' => 'Sovereign Tech Fund',
                    'craftcms' => 'Craft CMS',
                ),
            'Platinum' =>
                array (
                    'jetbrains' => 'JetBrains',
                    'automattic' => 'Automattic',
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
                    'laravel' => 'Laravel',
                    'binc' => 'BASE, Inc.',
                    'digital-scholar' => 'Digital Scholar',
                    'rakus' => 'RAKUS',
                    'rakusu' => 'ラクス 中村崇則',
                    'cambium-learning-inc' => 'Cambium Learning, Inc.',
                    'paycom' => 'Paycom',
                    'prestashop' => 'PrestaShop',
                    'spy' => 'SPY',
                ),
        );

        // FIXME Empty data in OpenCollective
        unset($sponsors_map['Silver']['sentry-team']);
        unset($sponsors_map['Gold']['11004-sovereign-tech-fund-2532c0cc']);
        unset($sponsors_map['Past']['rakusu']);

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
