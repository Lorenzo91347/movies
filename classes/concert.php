<?php
require_once 'Event.php';

class Concert extends Event
{
    public function __construct($duration)
    {
        parent::__construct('concert', $duration);
    }

    public function getType(): string
    {
        return "Concert";
    }
}
