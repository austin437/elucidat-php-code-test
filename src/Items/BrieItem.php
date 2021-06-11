<?php

namespace App\Items;

class BrieItem extends BaseItem {

    protected function updateQuality(){
        
        if( $this->sellIn < 1)
        {
            $this->quality = $this->quality + $this->baseQualityChangeValue * 2;
        }
        else
        {
            $this->quality = $this->quality + $this->baseQualityChangeValue;
        }    

        $this->checkQualityIsWithinBounds();

    }

}