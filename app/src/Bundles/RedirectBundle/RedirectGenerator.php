<?php

namespace App\Bundles\RedirectBundle;

use Sculpin\Core\Sculpin;
use Sculpin\Core\Event\SourceSetEvent;
use Sculpin\Core\Source\SourceInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Redirect Generator.
 *
 * @author Marco Vito Moscaritolo <marco@mavimo.org>
 * @author Beau Simensen <beau@dflydev.com>
 */
class RedirectGenerator implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            Sculpin::EVENT_BEFORE_RUN => 'beforeRun',
        );
    }

    public function beforeRun(SourceSetEvent $sourceSetEvent)
    {
        $sourceSet = $sourceSetEvent->sourceSet();

        foreach ($sourceSet->updatedSources() as $source) {
            if ($source->isGenerated()) {
                // Skip generated sources.
                continue;
            }

            if (!$source->data()->get('redirect')) {
                // Skip source that do not have redirect.
                continue;
            }

            foreach ($source->data()->get('redirect') as $key => $redirect) {
                // Clone current search with new sourceId.
                $generatedSource = $source->duplicate($source->sourceId() . ':' . $redirect);

                // Set destination is original source.
                $generatedSource->data()->set('destination', $source);

                // Overwrite permalink.
                $generatedSource->data()->set('permalink', $redirect);

                // Add redirect.
                $generatedSource->data()->set('layout', 'redirect');

                // Make sure Sculpin knows this source is generated.
                $generatedSource->setIsGenerated();

                // Add the generated source to the source set.
                $sourceSet->mergeSource($generatedSource);
            }
        }
    }
}
