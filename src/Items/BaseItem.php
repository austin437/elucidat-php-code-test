<?php

namespace App\Items;

use App\Item;

abstract class BaseItem extends Item {

    public $name;
    public $sellIn;
    public $quality;
    protected $maxQuality = 50;
    protected $minQuality = 0;
    protected $baseQualityChangeValue = 1;

    public function __construct($name, $quality, $sellIn)
    {
        $this->name = $name;
        if( $quality > $this->maxQuality ) $quality = $this->maxQuality;
        if( $quality < $this->minQuality ) $quality = $this->minQuality;
        $this->quality = $quality;
        $this->sellIn = $sellIn;
    }

    public function nextDay()
    {
        $this->updateQuality();
        $this->updateSellIn();        
    }

    protected function updateQuality(){

        if( $this->sellIn > 1)
        {
            $this->quality = max([$this->quality - $this->baseQualityChangeValue, 0]);
        }
        else
        {
            $this->quality = max([$this->quality - $this->baseQualityChangeValue * 2, 0]);
        }
    }

    protected function updateSellin(){
        $this->sellIn = $this->sellIn - 1;
    }

}