<?php

namespace KitPvP\Events;

use KitPvP\KitPvP;
use pocketmine\event\ {
  Listener,
  block\SignChangeEvent
};
use pocketmine\ {
  Player,
  Server
};

class SignChange implements Listener {

  function noIsOp(SignChangeEvent $e) {

    $pl = $e->getPlayer();

    $line1 = $e->getLine(0);
    $line2 = $e->getLine(1);
    $line3 = $e->getLine(2);
    $line4 = $e->getLine(3);

    $config = KitPvP::getConfigs("Map");

    if ($config->get("world") != null) {

      if ($pl->getLevel() === Server::getInstance()->getLevelByName($config->get("world"))) {

        if ($line4 == "food") {

          if (!$pl->isOp()) {

            $e->setLine(3, "§6YOU NOT OP");
            $pl->sendMessage("§l§3FOOD_SIGN§f» §r§7No eres OP para crear un Cartel");

          } else {

            $e->setLine(0, "");
            $e->setLine(1, "§l§cFOOD");
            $e->setLine(2, "§l§cFREE");
            $e->setLine(3, "");
            $pl->sendMessage("§l§3FOOD_SIGN§f» §r§7Colocaste el Cartel de Food Correctamente");

          }
        }
      }
    }
  }
}
?>