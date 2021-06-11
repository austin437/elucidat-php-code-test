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
        $this->quality = $quality;
        $this->checkQualityIsWithinBounds();
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
            $this->quality = $this->quality - $this->baseQualityChangeValue;
        }
        else
        {
            $this->quality = $this->quality - $this->baseQualityChangeValue * 2;
        }

        $this->checkQualityIsWithinBounds();
    }

    protected function checkQualityIsWithinBounds(){
        if( $this->quality > $this->maxQuality ) $this->quality = $this->maxQuality;
        if( $this->quality < $this->minQuality ) $this->quality = $this->minQuality;
    }

    protected function updateSellin(){
        $this->sellIn = $this->sellIn - 1;
    }

}