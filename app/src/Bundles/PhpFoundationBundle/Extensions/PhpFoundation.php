<?php

namespace App\Bundles\PhpFoundationBundle\Extensions;

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

    public function fetchSponsors(): array
    {
        return [
            'Silver' => [
                [
                    'name' => 'Private Packagist',
                    'website' => 'https://packagist.com/',
                    'image' => '/assets/sponsors/private-packagist.png',
                ],
                [
                    'name' => 'Craft CMS',
                    'website' => 'https://craftcms.com/',
                    'image' => '/assets/sponsors/craftcms.png',
                ],
                [
                    'name' => 'Zend by Perforce',
                    'website' => 'https://www.zend.com/',
                    'image' => '/assets/sponsors/zend-by-perforce.png',
                ],
                [
                    'name' => 'Tideways',
                    'website' => 'https://tideways.com/',
                    'image' => '/assets/sponsors/tideways.jpg',
                ],
                [
                    'name' => 'Symfony Corp',
                    'website' => 'https://symfony.com/',
                    'image' => '/assets/sponsors/symfony-corp.png',
                ],
                [
                    'name' => 'Mercari Inc.',
                    'website' => 'https://about.mercari.com/',
                    'image' => '/assets/sponsors/mercari.png',
                ],
                [
                    'name' => 'Les-Tilleuls.coop',
                    'website' => 'https://les-tilleuls.coop/',
                    'image' => '/assets/sponsors/les-tilleuls.png',
                ],
                [
                    'name' => 'pixiv Inc.',
                    'website' => 'https://www.pixiv.co.jp/',
                    'image' => '/assets/sponsors/pixiv-inc.jpg',
                ],
                [
                    'name' => 'Aternos GmbH',
                    'website' => 'https://aternos.gmbh/',
                    'image' => '/assets/sponsors/aternos-gmbh.png',
                ],
                [
                    'name' => 'Sentry Team',
                    'website' => 'https://sentry.io/',
                    'image' => '/assets/sponsors/sentry.png',
                ],
                [
                    'name' => 'Cybozu',
                    'website' => 'https://cybozu.co.jp/',
                    'image' => '/assets/sponsors/cybozu.jpg',
                ],
                [
                    'name' => 'Manychat',
                    'website' => 'https://careers.manychat.com/?utm_source=phpfnd&utm_medium=phpfnd_site&utm_campaign=sponsorship',
                    'image' => '/assets/sponsors/manychat.svg',
                ],
                [
                    'name' => 'Passbolt',
                    'website' => 'https://passbolt.com/',
                    'image' => '/assets/sponsors/passbolt.png',
                ],
                [
                    'name' => 'CH Studio',
                    'website' => 'https://chstudio.fr/',
                    'image' => '/assets/sponsors/chstudio.png',
                ],
            ],
            'Gold' => [
                [
                    'name' => 'Laravel',
                    'website' => 'https://laravel.com/',
                    'image' => '/assets/sponsors/laravel-logo.svg',
                ],
                [
                    'name' => 'GoDaddy.com',
                    'website' => 'https://www.godaddy.com/',
                    'image' => '/assets/sponsors/godaddy.png',
                ],
                [
                    'name' => 'team.blue',
                    'website' => 'https://team.blue/',
                    'image' => '/assets/sponsors/team-blue.jpg',
                ],
            ],
            'Platinum' => [
                [
                    'name' => 'JetBrains',
                    'website' => 'https://www.jetbrains.com/',
                    'image' => '/assets/sponsors/jetbrains.png',
                ],
                [
                    'name' => 'Automattic',
                    'website' => 'https://automattic.com/',
                    'image' => '/assets/sponsors/automattic.png',
                ],
                [
                    'name' => 'Sovereign Tech Agency',
                    'website' => 'https://www.sovereign.tech/',
                    'image' => '/assets/sponsors/STA-Logo-Default-Black-RGB.svg',
                ],
            ],
            'Past' => [
                [
                    'name' => 'Livesport s.r.o.',
                    'website' => 'https://www.livesport.eu/',
                ],
                [
                    'name' => 'Acquia',
                    'website' => 'https://www.acquia.com/',
                ],
                [
                    'name' => 'shopware AG',
                    'website' => 'https://www.shopware.com/en/',
                ],
                [
                    'name' => 'OP.GG',
                    'website' => 'https://op.gg/',
                ],
                [
                    'name' => 'EC-CUBE',
                    'website' => 'https://www.ec-cube.net/',
                ],
                [
                    'name' => 'Spryker',
                    'website' => 'https://spryker.com/',
                ],
                [
                    'name' => 'Polcode',
                    'website' => 'https://polcode.com/',
                ],
                [
                    'name' => 'BASE, Inc.',
                    'website' => 'https://binc.jp/',
                ],
                [
                    'name' => 'Digital Scholar',
                    'website' => 'http://digitalscholar.org/',
                ],
                [
                    'name' => 'RAKUS',
                    'website' => 'https://www.rakus.co.jp/',
                ],
                [
                    'name' => 'Cambium Learning, Inc.',
                    'website' => 'https://www.cambiumlearning.com/',
                ],
                [
                    'name' => 'Paycom',
                    'website' => 'https://www.paycom.com/',
                ],
                [
                    'name' => 'PrestaShop',
                    'website' => 'https://www.prestashop.com/',
                ],
                [
                    'name' => 'Ardennes-étape',
                    'website' => 'https://en.ardennes-etape.be/',
                ],
            ],
        ];
    }
}
