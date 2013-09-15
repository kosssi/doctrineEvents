<?php

namespace kosssi\ExampleDoctrineEventsBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AntRepositoryTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $container = $client->getContainer();

        /** @var \kosssi\ExampleDoctrineEventsBundle\Repository\AntRepository $repository */
        $repository = $container->get('kosssi_example_doctrine_events.ant_repository');

        $this->assertInstanceOf('kosssi\ExampleDoctrineEventsBundle\Repository\AntRepository', $repository);
    }
}
