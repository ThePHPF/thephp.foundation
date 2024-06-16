<?php

namespace App\Bundles\HighlightBundle;

use Dflydev\DotAccessConfiguration\Configuration;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\MarkdownConverter;
use Sculpin\Core\Event\ConvertEvent;
use Sculpin\Core\Sculpin;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Tempest\Highlight\CommonMark\HighlightExtension;
use Tempest\Highlight\Highlighter;

readonly class CodeHighlighting implements EventSubscriberInterface
{
    # Pattern to match both fenced code blocks and inline code blocks
    private const string CODE_PATTERN = '/(`{3,}[^`]*`{3,}|`[^`\n]+`|```[^`]*```)/m';
    # Pattern to match inline code blocks (`code`)
    private const string INLINE_CODE_PATTERN = '/`([^`\n]+)`/m';

    private MarkdownConverter $markdownConverter;

    public function __construct(private Configuration $configuration, private Highlighter $highlighter)
    {
        $environment = new Environment();
        $environment
            ->addExtension(new CommonMarkCoreExtension())
            ->addExtension(new HighlightExtension($highlighter))
        ;

        $this->markdownConverter = new MarkdownConverter($environment);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            Sculpin::EVENT_BEFORE_CONVERT => 'beforeConvert',
        ];
    }

    public function beforeConvert(ConvertEvent $event): void
    {
        $source  = $event->source();
        $content = $source->content();

        if ($content !== null && $source->file()->getExtension() === 'md') {
            $htmlContent = preg_replace_callback(self::CODE_PATTERN, function ($matches) {
                [$codeBlock] = $matches;

                if ($this->isInlineCodeBlock($codeBlock)) {
                    $codeBlock = sprintf('`{php} %s`', trim($codeBlock, '`'));
                }

                $convertedContent = $this->markdownConverter->convert($codeBlock)->getContent();

                $convertedContent = preg_replace('/^<p>(.*)<\/p>$/s', '$1', $convertedContent);

                return $convertedContent;
            }, $content);

            $source->setContent($htmlContent);
        }
    }

    private function isInlineCodeBlock(string $codeBlock): bool
    {
        return preg_match(self::INLINE_CODE_PATTERN, $codeBlock) && !preg_match('/{php}/', $codeBlock);
    }
}
