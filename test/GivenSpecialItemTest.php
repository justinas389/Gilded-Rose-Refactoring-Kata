<?php

namespace App;

class GivenConjuredItemTest extends \PHPUnit\Framework\TestCase {
    public function testIncreaseQualityByOneForAgedBrie() {
        $items      = [new Item("Aged Brie", 20, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals("11", $items[0]->quality);
    }

    public function testMaxQualityValueFifty() {
        $items      = [new Item("Aged Brie", 20, 49)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();
        $gildedRose->updateQuality();

        $this->assertEquals("50", $items[0]->quality);
    }
    
}
