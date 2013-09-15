<?php

namespace kosssi\ExampleDoctrineEventsBundle\Entity;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ant
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="kosssi\ExampleDoctrineEventsBundle\Repository\AntRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Ant
{
    const COLOR_RED = "red";
    const COLOR_BLACK = "black";

    const CASTE_QUEEN = 0;
    const CASTE_WORKER = 1;
    const CASTE_SOLDIER = 2;
    const CASTE_PRINCESS = 3;
    const CASTE_DRONE = 4;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255)
     */
    private $color;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="caste", type="integer")
     */
    private $caste;


    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtAndUpdatedAtPrePersist()
    {
        $now = new \Datetime();

        $this->createdAt = $now;
        $this->updatedAt = $now;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtPreUpdate(PreUpdateEventArgs $event)
    {
        $this->updatedAt = new \Datetime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function casteRules(PreUpdateEventArgs $event)
    {
        if ($event->hasChangedField('caste')) {
            $this->caste = $event->getOldValue('caste');
        }
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return Ant
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Ant
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Ant
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set caste
     *
     * @param integer $caste
     * @return Ant
     */
    public function setCaste($caste)
    {
        $this->caste = $caste;

        return $this;
    }

    /**
     * Get caste
     *
     * @return integer 
     */
    public function getCaste()
    {
        return $this->caste;
    }
}
