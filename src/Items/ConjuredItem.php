<?php

namespace App\Items;

class ConjuredItem extends BaseItem {

    protected $baseQualityChangeValue = 2;

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
}