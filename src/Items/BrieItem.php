<?php

namespace App\Items;

class BrieItem extends BaseItem {

    protected function updateQuality(){
        
        if( $this->sellIn < 1)
        {
            $this->quality = min([$this->quality + $this->baseQualityChangeValue * 2, $this->maxQuality]);
        }
        else
        {
            $this->quality = min([$this->quality + $this->baseQualityChangeValue, $this->maxQuality]);
        }    
        
    }

}