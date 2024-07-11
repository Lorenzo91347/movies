<?php
require_once 'Event.php';

class Concert extends Event
{
    public function __construct($duration, $timeframe)
    {
        parent::__construct('concert', $duration, $timeframe);
    }

    public function getType(): string
    {
        return "Concert";
    }
}
