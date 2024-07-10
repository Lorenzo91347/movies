<?php
require_once 'Event.php';

class Play extends Event
{
    public function __construct($duration)
    {
        parent::__construct('play', $duration);
    }

    public function getType(): string
    {
        return "Play";
    }
}
