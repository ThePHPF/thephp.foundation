<?php

declare(strict_types=1);

namespace App\Bundles\HighlightBundle;

use Tempest\Highlight\Highlighter;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TwigHighlightExtension extends AbstractExtension
{
    # Regular expression pattern to extract content between <code> tags, with optional class attribute.
    private const string CODE_CONTENT_PATTERN = '/<code(?: class="([^"]*)")?>(.*?)<\/code>/s';

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

    public function highlight(?string $content, string $defaultLanguage = 'php'): string
    {
        if ($content === null) {
            return '';
        }

        return preg_replace_callback(
            self::CODE_CONTENT_PATTERN,
            function ($matches) use ($defaultLanguage) {
                [, $code_language, $code] = $matches;
                $language = $code_language ?: $defaultLanguage;
                $code = htmlspecialchars_decode($code);

                return sprintf('<code>%s</code>', $this->highlighter->parse($code, $language));
            },
            $content
        );
    }
}