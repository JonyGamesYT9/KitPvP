<?php

namespace KitPvP\Events;

use KitPvP\KitPvP;
use KitPvP\Sound;
use pocketmine\level\Level;
use pocketmine\ {
  Player,
  Server
};
use pocketmine\event\ {
  Listener,
  player\PlayerInteractEvent
};
use pocketmine\item\Item;

class TapSoup implements Listener {

  function TapSoup(PlayerInteractEvent $e) {

    $pl = $e->getPlayer();
    
    $sound = new Sound();

    $item = $e->getItem();

    $config = KitPvP::getConfigs("Map");

    if ($config->get("world") != null) {

      if ($pl->getLevel() === Server::getInstance()->getLevelByName($config->get("world"))) {

        if ($item->getId() == 282) {

          if ($pl->getHealth() == 20) {
            $pl->sendMessage("§l§cHEALTH§f» §r§7Tu vida ya esta al maximo!");
            $sound->getSound($pl, "note.guitar");
            return false;
          }

          $e->setCancelled(true);

          $pl->getInventory()->setItemInHand(Item::get(0, 0, 1));

          $pl->setHealth($pl->getHealth() + 1.5);
          
          $sound->getSound($pl, "note.hat");

          $pl->sendPopup("§l§cHEALTH§f» §r§7Te curaste un poco!");

        }
      }
    }
  }
}
?>