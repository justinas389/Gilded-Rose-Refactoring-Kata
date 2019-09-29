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

    public function testSulfurasNeverHasToBeSold() {
        $items      = [new Item("Sulfuras, Hand of Ragnaros", 1, 20)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();
        $gildedRose->updateQuality();

        $this->assertEquals("1", $items[0]->sell_in);
    }

    public function testSulfurasNeverHasToDecreasesQality() {
        $items      = [new Item("Sulfuras, Hand of Ragnaros", 10, 20)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertGreaterThan(19, $items[0]->quality);
    }

    public function testBackstagePassesIncreaseQuality() {
        $items      = [new Item("Backstage passes to a TAFKAL80ETC concert", 20, 30)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(31, $items[0]->quality);
    }

    public function testBackstagePassesIncreaseQualityRules() {
        $items      = [new Item("Backstage passes to a TAFKAL80ETC concert", 11, 30)];
        $gildedRose = new GildedRose($items);

        for ($i=0; $i < 7; $i++) {
          $gildedRose->updateQuality();

        }

        $this->assertEquals(44, $items[0]->quality);
    }

    public function testReduceQualityByTwo() {
        $conjuredIitem      = [new Item("Conjured Mana Cake", 10, 20)];
        $gildedRose = new GildedRose($conjuredIitem);

        $gildedRose->updateQuality();

        $this->assertEquals(18, $conjuredIitem[0]->quality);
    }

    public function testReduceQualityByFour_AfterSellInReachZero() {
        $conjuredIitem      = [new Item("Conjured Mana Cake", 1, 20)];
        $gildedRose = new GildedRose($conjuredIitem);

        $gildedRose->updateQuality();
        $gildedRose->updateQuality();
        $gildedRose->updateQuality();

        $this->assertEquals(10, $conjuredIitem[0]->quality);
    }

    public function testConjuredFlourQualityAtZero_GivenSellInRemains() {
      $conjuredIitem      = [new Item("Conjured Mana Cake", 10, 1)];
      $gildedRose = new GildedRose($conjuredIitem);

      $gildedRose->updateQuality();

      $this->assertEquals(0, $conjuredIitem[0]->quality);
    }

    public function testConjuredFlourQualityAtZero_GivenSellInZero() {
      $conjuredIitem      = [new Item("Conjured Mana Cake", 0, 3)];
      $gildedRose = new GildedRose($conjuredIitem);

      $gildedRose->updateQuality();

      $this->assertEquals(0, $conjuredIitem[0]->quality);
    }

}
