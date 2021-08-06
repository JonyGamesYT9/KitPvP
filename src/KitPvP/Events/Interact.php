<?php

namespace KitPvP\Events;

use pocketmine\ {
  Server,
  Player
};
use pocketmine\item\Item;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use KitPvP\KitPvP;
use KitPvP\Sound;
use KitPvP\Forms;

class Interact implements Listener {

  public function onInteract(PlayerInteractEvent $e) {

    $pl = $e->getPlayer();

    $name = $pl->getName();

    $item = $e->getItem();

    $sound = new Sound();

    $form = new Forms();

    if ($item->getCustomName() === "§l§eKITS\n§r§8[CLICK]") {

      $form->getMain($pl);

    } else if ($item->getCustomName() === "§l§6STATS\n§r§8[CLICK]") {

      $coins = KitPvP::getConfigs("Coins");

      $kills = KitPvP::getConfigs("Kills");

      $mycoins = $coins->get($name);

      $mykills = $kills->get($name);

      $myrank = $this->getRank($pl);

      $pl->sendMessage("§l§f» §r§7=-=-=-=-=-=-=-=-=-=-=-=-=-=");
      $pl->sendMessage("§l§6» §r§bMy coins: §f$mycoins");
      $pl->sendMessage("§l§e» §r§bMy kills: §f$mykills");
      $pl->sendMessage("§l§6» §r§bMy rank: §f$myrank");
      $pl->sendMessage("§l§f» §r§7=-=-=-=-=-=-=-=-=-=-=-=-=-=");

    } else if ($item->getCustomName() === "§l§cLOBBY\n§r§8[CLICK]") {

      KitPvP::getInstance()->getServer()->dispatchCommand($pl, "hub");

    }
  }

  public function getRank(Player $player) {
    $purePerms = Server::getInstance()->getPluginManager()->getPlugin("PurePerms");
    if ($purePerms !== null) {
      $group = $purePerms->getUserDataMgr()->getData($player)['group'];
      if ($group !== null) {
        return $group;
      } else {
        return "Guest";
      }
    } else {
      return "Require Pureperms";
    }
  }
}
?>