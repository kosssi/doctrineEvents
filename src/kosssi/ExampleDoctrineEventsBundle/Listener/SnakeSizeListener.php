<?php

namespace kosssi\ExampleDoctrineEventsBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use kosssi\ExampleDoctrineEventsBundle\Entity\Snake;
use kosssi\ExampleDoctrineEventsBundle\Manager\SnakeSizeManager;

class SnakeSizeListener
{
    /**
     * @var SnakeSizeManager
     */
    private $snakeSizeManager;

    /**
     * @param SnakeSizeManager $snakeSizeManager
     */
    public function __construct(SnakeSizeManager $snakeSizeManager)
    {
        $this->snakeSizeManager = $snakeSizeManager;
    }

    /**
     * I don't no why! But my snake up when color change
     *
     * @param Snake              $snake
     * @param PreUpdateEventArgs $event
     */
    public function preUpdate(Snake $snake, PreUpdateEventArgs $event)
    {
        if ($event->hasChangedField('color')) {
            $snake->setSize($this->snakeSizeManager->getAdditionalSize($event->getNewValue('color')));
        }
    }
}
