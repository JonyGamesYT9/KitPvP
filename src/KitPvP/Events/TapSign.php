<?php

namespace KitPvP\Events;

use KitPvP\KitPvP;
use KitPvP\Sound;
use pocketmine\event\ {
  Listener,
  player\PlayerInteractEvent
};
use pocketmine\tile\Sign;
use pocketmine\ {
  Player,
  Server
};
use pocketmine\item\Item;

class TapSign implements Listener {

  function TapSign(PlayerInteractEvent $e) {

    $sound = new Sound();

    $pl = $e->getPlayer();

    $block = $e->getBlock();

    $sopa = Item::get(282, 0, 1);

    if ($block->getId() == 63 || $block->getId() == 68) {

      $sign = $block->getLevel()->getTile($block);

      if ($sign instanceof Sign) {

        $lines = $sign->getText();

        if ($lines[1] == "§l§cFOOD" && $lines[2] == "§l§cFREE") {

          if (!$pl->getInventory()->canAddItem($sopa)) {
            $pl->sendMessage("§l§eINVENTORY§f» §r§7No puedes agregar mas items a tu Inventario!");
            $sound->getSound($pl, "note.guitar");
            return;
          }

          $pl->getInventory()->addItem(Item::get(282, 0, 1));

          $sound->getSound($pl, "note.flute");

        }
      }
    }
  }
}
?>