<?php

namespace App\Items;

class BackstagePassItem extends BaseItem {

    protected function updateQuality(){

        if( $this->sellIn > 10)
        {
           $this->quality = min([$this->quality + $this->baseQualityChangeValue, $this->maxQuality]);
        }
        elseif( $this->sellIn > 5)
        {
            $this->quality = min([$this->quality + $this->baseQualityChangeValue * 2, $this->maxQuality]);
        }    
        elseif( $this->sellIn > 0)
        {
            $this->quality = min([$this->quality + $this->baseQualityChangeValue * 3, $this->maxQuality]);
        }    
        else 
        {
            $this->quality = $this->minQuality;
        }
    }

}