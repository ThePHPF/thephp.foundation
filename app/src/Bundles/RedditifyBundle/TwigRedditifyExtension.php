<?php

namespace App\Bundles\RedditifyBundle;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Twig\Markup;

class TwigRedditifyExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('redditify', [$this, 'renderRedditifyWidget'], ['is_safe' => ['html']]),
        ];
    }

    public function renderRedditifyWidget(string $url, array $options = []): Markup
    {
        $maxDepth = $options['max_depth'] ?? 10;
        $showContent = $options['show_content'] ?? false;
        $showControls = $options['show_controls'] ?? true;
        $cssClass = $options['class'] ?? 'thread-container';
        
        $showContentStr = $showContent ? 'true' : 'false';
        $showControlsStr = $showControls ? 'true' : 'false';
        
        $html = sprintf(
            '<div class="%s" data-reddit-thread="%s" data-reddit-max-depth="%d" data-reddit-show-content="%s" data-reddit-show-controls="%s"></div>',
            htmlspecialchars($cssClass, ENT_QUOTES),
            htmlspecialchars($url, ENT_QUOTES),
            $maxDepth,
            $showContentStr,
            $showControlsStr
        );
        
        $html .= '<script src="/assets/js/redditify.min.js"></script>';
        $html .= '<link rel="stylesheet" href="/assets/css/redditify.css">';
        
        return new Markup($html, 'UTF-8');
    }
}
