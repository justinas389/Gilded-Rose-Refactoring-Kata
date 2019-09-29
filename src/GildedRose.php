<?php

namespace App;

final class GildedRose {

    private $items = [];

    private $BackstagePassItemName = 'Backstage passes to a TAFKAL80ETC concert';
    private $AgedBrieItemName = 'Aged Brie';
    private $SulfurasItemName = 'Sulfuras, Hand of Ragnaros';
    private $ConjuredItemName = 'Conjured Mana Cake';

    public function __construct($items) {
        $this->items = $items;
    }

    public function updateQuality() {
        foreach ($this->items as $item) {
            if ($item->name != $this->AgedBrieItemName and $item->name != $this->BackstagePassItemName) {
                if ($item->quality > 0) {
                    if ($item->name != $this->SulfurasItemName) {
                        $item->quality = $item->quality - 1;
                        if ($item->name == $this->ConjuredItemName && $item->quality > 0) {
                            $item->quality = $item->quality - 1;
                        }
                    } else {
                        $item->quality = 80;
                    }
                }
            } else {
                if ($item->quality < 50) {
                    $item->quality = $item->quality + 1;
                    if ($item->name == $this->BackstagePassItemName) {
                        if ($item->sell_in < 11) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                        if ($item->sell_in < 6) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                    }
                }
            }

            if ($item->name != $this->SulfurasItemName) {
                $item->sell_in = $item->sell_in - 1;
            }

            if ($item->sell_in < 0) {
                if ($item->name != $this->AgedBrieItemName) {
                    if ($item->name != $this->BackstagePassItemName) {
                        if ($item->quality > 0) {
                            if ($item->name != $this->SulfurasItemName) {
                                $item->quality = $item->quality - 1;
                                if ($item->name == $this->ConjuredItemName && $item->quality > 0) {
                                    $item->quality = $item->quality - 1;
                                }
                            }
                        }
                    } else {
                        $item->quality = $item->quality - $item->quality;
                    }
                } else {
                    if ($item->quality < 50) {
                        $item->quality = $item->quality + 1;
                    }
                }
            }
        }
    }
}
