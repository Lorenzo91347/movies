<?php
require_once 'Event.php';

class Movie extends Event
{
    public function __construct($duration, $timeframe)
    {
        parent::__construct('movie', $duration, $timeframe);
    }

    public function getType(): string
    {
        return "Movie";
    }
}
