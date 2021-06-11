<?php

namespace App\Items;

class ConjuredItem extends BaseItem {

    protected $baseQualityChangeValue = 2;

    protected function updateQuality(){

        if( $this->sellIn > 1)
        {
            $this->quality = max([$this->quality - $this->baseQualityChangeValue, $this->minQuality]);
        }
        else
        {
            $this->quality = max([$this->quality - $this->baseQualityChangeValue * 2, $this->minQuality]);
        }
    }
}