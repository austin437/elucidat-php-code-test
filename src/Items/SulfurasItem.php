<?php

namespace App\Items;

class SulfurasItem extends BaseItem {

    protected $maxQuality = 80;
    protected $minQuality = 80;

    public function nextDay()
    {
        $this->checkQualityIsWithinBounds();
    }

}