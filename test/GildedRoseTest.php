<?php

namespace App;

class GildedRoseTest extends \PHPUnit\Framework\TestCase {
    public function testLoverQuality_GivenNormalItem() {
        $items      = [new Item("Normal Item", 20, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals("9", $items[0]->quality);
    }
}
