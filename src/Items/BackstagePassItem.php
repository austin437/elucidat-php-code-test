<?php

namespace App\Items;

class BackstagePassItem extends BaseItem {

    protected function updateQuality(){

        if( $this->sellIn > 10)
        {
           $this->quality = $this->quality + $this->baseQualityChangeValue;
        }
        elseif( $this->sellIn > 5)
        {
            $this->quality = $this->quality + $this->baseQualityChangeValue * 2;
        }    
        elseif( $this->sellIn > 0)
        {
            $this->quality = $this->quality + $this->baseQualityChangeValue * 3;
        }    
        else 
        {
            $this->quality = $this->minQuality;
        }

        $this->checkQualityIsWithinBounds();
    }

}