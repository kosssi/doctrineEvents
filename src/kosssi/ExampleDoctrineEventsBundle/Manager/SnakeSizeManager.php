<?php

namespace kosssi\ExampleDoctrineEventsBundle\Manager;

use kosssi\ExampleDoctrineEventsBundle\Entity\Snake;

class SnakeSizeManager
{
    public function getAdditionalSize($color)
    {
        $up = 0;
        if ($color == Snake::COLOR_BLACK) {
            $up = 10;
        } elseif ($color == Snake::COLOR_RED) {
            $up = 100;
        }

        return $up;
    }
}
