<?php

namespace kosssi\ExampleDoctrineEventsBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use kosssi\ExampleDoctrineEventsBundle\Entity\Snake;

/**
 * Class SnakeCreatedAdUpdatedAtListener
 *
 * @author Simon Constans <kosssi@gmail.com>
 */
class SnakeCreatedAtUpdatedAtListener
{
    /**
     * @param Snake              $snake
     * @param LifecycleEventArgs $event
     */
    public function prePersist(Snake $snake, LifecycleEventArgs $event)
    {
        $now = new \Datetime();

        $snake->setCreatedAt($now);
        $snake->setUpdatedAt($now);
    }

    /**
     * @param Snake              $snake
     * @param PreUpdateEventArgs $event
     */
    public function preUpdate(Snake $snake, PreUpdateEventArgs $event)
    {
        $now = new \Datetime();

        $snake->setUpdatedAt($now);
    }
}
