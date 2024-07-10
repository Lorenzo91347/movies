<?php
require_once 'Event.php';

class Movie extends Event
{
    public function __construct($duration)
    {
        parent::__construct('movie', $duration);
    }

    public function getType(): string
    {
        return "Movie";
    }
}
