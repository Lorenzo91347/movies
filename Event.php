<?php
require_once __DIR__ . '/interface/PricingContract.php';

abstract class Event implements Pricing
{
    private $eventType;
    private $duration;
    private $hrPrice;

    public function __construct($eventType, $duration)
    {
        $this->eventType = $eventType;
        $this->duration = $duration;
        $this->setHrPrice();
    }

    abstract public function getType(): string;

    private function setHrPrice(): void
    {
        switch ($this->eventType) {
            case 'movie':
                $this->hrPrice = 15;
                break;
            case 'concert':
                $this->hrPrice = 25;
                break;
            case 'play':
                $this->hrPrice = 12;
                break;
        }
    }

    public function pricing(): float
    {
        return $this->hrPrice * $this->duration;
    }

    protected function getEventType(): string
    {
        return $this->eventType;
    }

    protected function getDuration(): float
    {
        return $this->duration;
    }
}
