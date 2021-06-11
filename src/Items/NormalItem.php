<?php

namespace App\Items;

use App\Item;

class NormalItem extends Item {

    public $name;
    public $sellIn;
    public $quality;

    public function __construct($name, $quality, $sellIn)
    {
        $this->name = $name;
        $this->quality = min([max([$quality, 0]), 50]);
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
            $this->quality = max([$this->quality - 1, 0]);
        }
        else
        {
            $this->quality = max([$this->quality - 2, 0]);
        }
    }

    protected function updateSellin(){
        $this->sellIn = $this->sellIn - 1;
    }

}