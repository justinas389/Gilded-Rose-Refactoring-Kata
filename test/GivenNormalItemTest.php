<?php

namespace App;

class GivenNormalItemTest extends \PHPUnit\Framework\TestCase {
    public function testLoverQualityByOne() {
        $items      = [new Item("Normal Item", 20, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals("9", $items[0]->quality);
    }

    public function testLoverSellInByOne() {
        $items      = [new Item("Normal Item", 20, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals("19", $items[0]->sell_in);
    }

    public function testFlourQualityAtZero() {
        $items      = [new Item("Normal Item", 20, 1)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();
        $gildedRose->updateQuality();

        $this->assertEquals("0", $items[0]->quality);
    }

    public function testAllowNegativeSellIn() {
        $items      = [new Item("Normal Item", 1, 50)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();
        $gildedRose->updateQuality();

        $this->assertEquals("-1", $items[0]->sell_in);
    }

    public function testDecreseQualityByTwoAfterSellInReachZero() {
        $items      = [new Item("Normal Item", 1, 50)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality(); //-1
        $gildedRose->updateQuality(); //-2

        $this->assertEquals("47", $items[0]->quality);
    }
}
