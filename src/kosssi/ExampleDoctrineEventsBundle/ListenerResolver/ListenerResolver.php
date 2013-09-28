<?php

namespace kosssi\ExampleDoctrineEventsBundle\ListenerResolver;

use Doctrine\ORM\Mapping\DefaultEntityListenerResolver;

class ListenerResolver extends DefaultEntityListenerResolver
{
    public function __construct($container)
    {
        $this->container = $container;
    }

    public function resolve($className)
    {
        $id = null;
        if ($className === 'kosssi\ExampleDoctrineEventsBundle\Listener\SnakeSizeListener') {
            $id = 'kosssi_listener_snake_size';
        }

        if (is_null($id)) {
            return new $className();
        } else {
            return $this->container->get($id);
        }
    }
}
