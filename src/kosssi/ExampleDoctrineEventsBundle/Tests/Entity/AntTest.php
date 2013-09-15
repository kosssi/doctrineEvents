<?php

namespace kosssi\ExampleDoctrineEventsBundle\Tests\Entity;

use kosssi\ExampleDoctrineEventsBundle\Entity\Ant;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AntTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $now = new \DateTime();

        $ant = new Ant();
        $ant->setCaste(Ant::CASTE_QUEEN);
        $ant->setColor(Ant::COLOR_BLACK);
        $ant->setCreatedAt($now);
        $ant->setUpdatedAt($now);

        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $container->get('doctrine.orm.default_entity_manager');
        $em->persist($ant);
        $em->flush();

        /** @var \kosssi\ExampleDoctrineEventsBundle\Repository\AntRepository $repository */
        $repository = $container->get('kosssi_example_doctrine_events.ant_repository');
        $ants = $repository->findAll();

        $this->assertTrue(count($ants) > 0);

        foreach ($ants as $ant) {
            $em->remove($ant);
        }
        $em->flush();
    }

    public function testSetCreatedAtUpdatedAtPrePersist()
    {
        $client = static::createClient();
        $container = $client->getContainer();

        $ant = new Ant();
        $ant->setCaste(Ant::CASTE_QUEEN);
        $ant->setColor(Ant::COLOR_BLACK);

        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $container->get('doctrine.orm.default_entity_manager');
        $em->persist($ant);
        $em->flush();

        $this->assertNotNull($ant->getCreatedAt());
        $this->assertNotNull($ant->getUpdatedAt());

        $em->remove($ant);
        $em->flush();
    }

    public function testSetUpdatedAtPreUpdate()
    {
        $client = static::createClient();
        $container = $client->getContainer();

        $ant = new Ant();
        $ant->setCaste(Ant::CASTE_QUEEN);
        $ant->setColor(Ant::COLOR_BLACK);

        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $container->get('doctrine.orm.default_entity_manager');
        $em->persist($ant);
        $em->flush();

        $updatedAt = $ant->getUpdatedAt();
        sleep(1);

        $ant->setColor(Ant::COLOR_RED);
        $em->persist($ant);
        $em->flush();

        $this->assertNotEquals($updatedAt, $ant->getUpdatedAt());

        $em->remove($ant);
        $em->flush();
    }

    public function testCasteRules()
    {
        $client = static::createClient();
        $container = $client->getContainer();

        $ant = new Ant();
        $ant->setCaste(Ant::CASTE_QUEEN);
        $ant->setColor(Ant::COLOR_BLACK);

        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $container->get('doctrine.orm.default_entity_manager');
        $em->persist($ant);
        $em->flush();

        $ant->setCaste(Ant::CASTE_WORKER);
        $em->persist($ant);
        $em->flush();

        $this->assertNotEquals(Ant::CASTE_WORKER, $ant->getCaste());

        $em->remove($ant);
        $em->flush();
    }
}
