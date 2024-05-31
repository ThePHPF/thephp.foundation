<?php

declare(strict_types=1);

namespace App\Bundles\HighlightBundle;

use Tempest\Highlight\Highlighter;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TwigHighlightExtension extends AbstractExtension
{
    public function __construct(
        private readonly Highlighter $highlighter
    ) {
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('highlight', [$this, 'highlight'], ['is_safe' => ['html']]),
        ];
    }

    public function highlight($content, $language = 'php'): array|string|null
    {
        return preg_replace_callback(
            '/<code>(.*?)<\/code>/s',
            function ($matches) use ($language) {
                return '<code>' . $this->highlighter->parse(htmlspecialchars_decode($matches[1]), $language) . '</code>';
            },
            $content ?? ''
        );
    }
}