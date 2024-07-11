<?php
require_once 'Event.php';

class Play extends Event
{
    public function __construct($duration, $timeframe)
    {
        parent::__construct('play', $duration, $timeframe);
    }

    public function getType(): string
    {
        return "Play";
    }
}
