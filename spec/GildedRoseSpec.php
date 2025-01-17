<?php

use App\Item;
use App\Items\NormalItem;
use App\Items\BrieItem;
use App\Items\SulfurasItem;
use App\Items\BackstagePassItem;
use App\Items\ConjuredItem;
use App\GildedRose;

describe('Gilded Rose', function () {
    describe('next day', function () {
        context('normal Items', function () {
            it('updates normal items before sell date', function () {
                $gr = new GildedRose([new NormalItem('normal', 10, 5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(9);
                expect($gr->getItem(0)->sellIn)->toBe(4);
            });
            it('updates normal items on the sell date', function () {
                $gr = new GildedRose([new NormalItem('normal', 10, 0)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(8);
                expect($gr->getItem(0)->sellIn)->toBe(-1);
            });
            it('updates normal items after the sell date', function () {
                $gr = new GildedRose([new NormalItem('normal', 10, -5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(8);
                expect($gr->getItem(0)->sellIn)->toBe(-6);
            });
            it('updates normal items with a quality of 0', function () {
                $gr = new GildedRose([new NormalItem('normal', 0, 5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(0);
                expect($gr->getItem(0)->sellIn)->toBe(4);
            });
            it('does not all a Normal Item to be created with a quality of less than 0', function () {
                $gr = new GildedRose([new NormalItem('normal', -1, 5)]);
                expect($gr->getItem(0)->quality)->toBe(0);
                expect($gr->getItem(0)->sellIn)->toBe(5);
            });
            it('does not all a Normal Item to be created with a quality of more than 50', function () {
                $gr = new GildedRose([new NormalItem('normal', 51, 5)]);
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(5);
            });
        });
        context('Brie Items', function () {
            it('updates Brie items before the sell date', function () {
                $gr = new GildedRose([new BrieItem('Aged Brie', 10, 5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(11);
                expect($gr->getItem(0)->sellIn)->toBe(4);
            });
            it('updates Brie items before the sell date with maximum quality', function () {
                $gr = new GildedRose([new BrieItem('Aged Brie', 50, 5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(4);
            });
            it('updates Brie items on the sell date', function () {
                $gr = new GildedRose([new BrieItem('Aged Brie', 10, 0)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(12);
                expect($gr->getItem(0)->sellIn)->toBe(-1);
            });
            it('updates Brie items on the sell date, near maximum quality', function () {
                $gr = new GildedRose([new BrieItem('Aged Brie', 49, 0)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(-1);
            });
            it('updates Brie items on the sell date with maximum quality', function () {
                $gr = new GildedRose([new BrieItem('Aged Brie', 50, 0)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(-1);
            });
            it('updates Brie items after the sell date', function () {
                $gr = new GildedRose([new BrieItem('Aged Brie', 10, -10)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(12);
                expect($gr->getItem(0)->sellIn)->toBe(-11);
            });
            it('updates Brie items after the sell date with maximum quality', function () {
                $gr = new GildedRose([new BrieItem('Aged Brie', 50, -10)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(-11);
            });
            it('does not all a BrieItem to be created with a quality of less than 0', function () {
                $gr = new GildedRose([new BrieItem('Aged Brie', -1, 5)]);
                expect($gr->getItem(0)->quality)->toBe(0);
                expect($gr->getItem(0)->sellIn)->toBe(5);
            });
            it('does not all a BrieItem to be created with a quality of more than 50', function () {
                $gr = new GildedRose([new BrieItem('Aged Brie', 51, 5)]);
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(5);
            });
        });        
        context('Sulfuras Items', function () {
            it('updates Sulfuras items before the sell date', function () {
                $gr = new GildedRose([new SulfurasItem('Sulfuras, Hand of Ragnaros', 10, 5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(80);
                expect($gr->getItem(0)->sellIn)->toBe(5);
            });
            it('updates Sulfuras items on the sell date', function () {
                $gr = new GildedRose([new SulfurasItem('Sulfuras, Hand of Ragnaros', 10, 5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(80);
                expect($gr->getItem(0)->sellIn)->toBe(5);
            });
            it('updates Sulfuras items after the sell date', function () {
                $gr = new GildedRose([new SulfurasItem('Sulfuras, Hand of Ragnaros', 10, -1)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(80);
                expect($gr->getItem(0)->sellIn)->toBe(-1);
            });
        });
        context('Backstage Passes', function () {
            it('updates Backstage pass items long before the sell date', function () {
                $gr = new GildedRose([new BackstagePassItem('Backstage passes to a TAFKAL80ETC concert', 10, 11)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(11);
                expect($gr->getItem(0)->sellIn)->toBe(10);
            });
            it('updates Backstage pass items close to the sell date', function () {
                $gr = new GildedRose([new BackstagePassItem('Backstage passes to a TAFKAL80ETC concert', 10, 10)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(12);
                expect($gr->getItem(0)->sellIn)->toBe(9);
            });
            it('updates Backstage pass items close to the sell data, at max quality', function () {
                $gr = new GildedRose([new BackstagePassItem('Backstage passes to a TAFKAL80ETC concert', 50, 10)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(9);
            });
            it('updates Backstage pass items very close to the sell date', function () {
                $gr = new GildedRose([new BackstagePassItem('Backstage passes to a TAFKAL80ETC concert', 10, 5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(13); // goes up by 3
                expect($gr->getItem(0)->sellIn)->toBe(4);
            });
            it('updates Backstage pass items very close to the sell date, at max quality', function () {
                $gr = new GildedRose([new BackstagePassItem('Backstage passes to a TAFKAL80ETC concert', 50, 5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(4);
            });
            it('updates Backstage pass items with one day left to sell', function () {
                $gr = new GildedRose([new BackstagePassItem('Backstage passes to a TAFKAL80ETC concert', 10, 1)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(13);
                expect($gr->getItem(0)->sellIn)->toBe(0);
            });
            it('updates Backstage pass items with one day left to sell, at max quality', function () {
                $gr = new GildedRose([new BackstagePassItem('Backstage passes to a TAFKAL80ETC concert', 50, 1)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(0);
            });
            it('updates Backstage pass items on the sell date', function () {
                $gr = new GildedRose([new BackstagePassItem('Backstage passes to a TAFKAL80ETC concert', 10, 0)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(0);
                expect($gr->getItem(0)->sellIn)->toBe(-1);
            });
            it('updates Backstage pass items after the sell date', function () {
                $gr = new GildedRose([new BackstagePassItem('Backstage passes to a TAFKAL80ETC concert', 10, -1)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(0);
                expect($gr->getItem(0)->sellIn)->toBe(-2);
            });
            it('does not all a BackstagePassItem to be created with a quality of less than 0', function () {
                $gr = new GildedRose([new BackstagePassItem('Backstage passes to a TAFKAL80ETC concert', -1, 5)]);
                expect($gr->getItem(0)->quality)->toBe(0);
                expect($gr->getItem(0)->sellIn)->toBe(5);
            });
            it('does not all a BackstagePassItem to be created with a quality of more than 50', function () {
                $gr = new GildedRose([new BackstagePassItem('Backstage passes to a TAFKAL80ETC concert', 51, 5)]);
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(5);
            });
        });
        context("Conjured Items", function () {
            it('updates Conjured items before the sell date', function () {
                $gr = new GildedRose([new ConjuredItem('Conjured Mana Cake', 10, 10)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(8);
                expect($gr->getItem(0)->sellIn)->toBe(9);
            });
            it('updates Conjured items at zero quality', function () {
                $gr = new GildedRose([new ConjuredItem('Conjured Mana Cake', 0, 10)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(0);
                expect($gr->getItem(0)->sellIn)->toBe(9);
            });
            it('updates Conjured items on the sell date', function () {
                $gr = new GildedRose([new ConjuredItem('Conjured Mana Cake', 10, 0)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(6);
                expect($gr->getItem(0)->sellIn)->toBe(-1);
            });
            it('updates Conjured items on the sell date at 0 quality', function () {
                $gr = new GildedRose([new ConjuredItem('Conjured Mana Cake', 0, 0)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(0);
                expect($gr->getItem(0)->sellIn)->toBe(-1);
            });
            it('updates Conjured items after the sell date', function () {
                $gr = new GildedRose([new ConjuredItem('Conjured Mana Cake', 10, -10)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(6);
                expect($gr->getItem(0)->sellIn)->toBe(-11);
            });
            it('updates Conjured items after the sell date at zero quality', function () {
                $gr = new GildedRose([new ConjuredItem('Conjured Mana Cake', 0, -10)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(0);
                expect($gr->getItem(0)->sellIn)->toBe(-11);
            });
            it('does not all a ConjuredItem to be created with a quality of less than 0', function () {
                $gr = new GildedRose([new ConjuredItem('Conjured Mana Cake', -1, 5)]);
                expect($gr->getItem(0)->quality)->toBe(0);
                expect($gr->getItem(0)->sellIn)->toBe(5);
            });
            it('does not all a ConjuredItem to be created with a quality of more than 50', function () {
                $gr = new GildedRose([new ConjuredItem('Conjured Mana Cake', 51, 5)]);
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(5);
            });
        });
    });
});
