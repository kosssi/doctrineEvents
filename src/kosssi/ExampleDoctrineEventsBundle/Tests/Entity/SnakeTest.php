<?php

namespace kosssi\ExampleDoctrineEventsBundle\Tests\Entity;

use kosssi\ExampleDoctrineEventsBundle\Entity\Snake;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SnakeTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $container = $client->getContainer();

        $snake = new Snake();
        $snake->setSize(200);
        $snake->setColor(Snake::COLOR_BLACK);

        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $container->get('doctrine.orm.default_entity_manager');
        $em->persist($snake);
        $em->flush();

        $snake->setColor(Snake::COLOR_RED);
        $em->persist($snake);
        $em->flush();

        $this->assertNotEquals(200, $snake->getSize());

        $em->remove($snake);
        $em->flush();
    }
}
