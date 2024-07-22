<?php

namespace App\Bundles\RedirectBundle;

use Sculpin\Core\Sculpin;
use Sculpin\Core\Event\SourceSetEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Redirect Generator.
 *
 * @author Marco Vito Moscaritolo <marco@mavimo.org>
 * @author Beau Simensen <beau@dflydev.com>
 */
class RedirectGenerator implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            Sculpin::EVENT_BEFORE_RUN => 'beforeRun',
        ];
    }

    public function beforeRun(SourceSetEvent $sourceSetEvent)
    {
        $sourceSet = $sourceSetEvent->sourceSet();

        foreach ($sourceSet->updatedSources() as $source) {
            if ($source->isGenerated()) {
                continue;
            }

            if (!$source->data()->get('redirect')) {
                continue;
            }

            foreach ($source->data()->get('redirect') as $key => $redirect) {
                $generatedSource = $source->duplicate($source->sourceId() . ':' . $redirect);
                $generatedSource->data()->set('destination', $source);
                $generatedSource->data()->set('permalink', $redirect);
                $generatedSource->data()->set('layout', 'redirect');
                $generatedSource->setIsGenerated();
                $sourceSet->mergeSource($generatedSource);
            }
        }
    }
}
