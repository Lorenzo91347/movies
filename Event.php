<?php
require_once __DIR__ . '/interface/PricingContract.php';

abstract class Event implements Pricing
{
    private $eventType;
    private $duration;
    private $hrPrice;
    private $timeFrame;
    private $discount;

    public function __construct($eventType, $duration, $timeFrame)
    {
        $this->eventType = $eventType;
        $this->duration = $duration;
        $this->timeFrame = $timeFrame;
        $this->setHrPrice();
        $this->setDiscount();
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

    private function setDiscount()

    {
        switch ($this->timeFrame) {
            case 'morning':
                $this->discount = 0.30;
                break;
            case 'afternoon':
                $this->discount = 0.10;
                break;
            case 'evening':
                $this->discount = 0;
                break;
        }

        return $this->discount;
    }



    public function pricing(): float
    {
        $finalPrice =  $this->hrPrice * $this->duration;
        if ($this->discount > 0) {
            $discountAmount = $finalPrice * ($this->discount / 100);
            $finalPrice -= $discountAmount;
        }
        return number_format((float)$finalPrice, 2, '.', '');
    }

    /* protected function getEventType(): string
    {
        return $this->eventType;
    } */

    protected function getDuration(): float
    {
        return $this->duration;
    }
}
