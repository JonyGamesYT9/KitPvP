<?php

namespace KitPvP\Events;

use KitPvP\KitPvP;
use KitPvP\Sound;
use pocketmine\Item\Item;
use KitPvP\Kit\KitManager;
use pocketmine\ {
  Player,
  Server
};
use pocketmine\event\Listener;
use pocketmine\event\entity\ {
  EntityDamageByEntityEvent,
  EntityDamageEvent
};
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;

class KillSystem implements Listener {
  
  function getSound($player, string $sound): void {
		$pk = new PlaySoundPacket();
		$pk->x = $player->x;
		$pk->y = $player->y;
		$pk->z = $player->z;
		$pk->soundName = $sound;
		$pk->volume = 5;
		$pk->pitch = 1;
		$player->dataPacket($pk);
	}
	
	function onMove(PlayerMoveEvent $e){
	$pl = $e->getPlayer();
	$config = KitPvP::getConfigs("Map");
	if ($config->get("world") != null) {

      if ($pl->getLevel() === Server::getInstance()->getLevelByName($config->get("world"))) {

     $pl->setFood(19);
}
}
	}

  public function onDamage(EntityDamageEvent $e) {
    $pl = $e->getEntity();
    $config = KitPvP::getConfigs("Map");
    $kills = KitPvP::getConfigs("Kills");
    $coins = KitPvP::getConfigs("Coins");
    $damage = KitPvP::getConfigs("Protect");

    if (!$pl instanceof Player) return;

    if ($config->get("world") != null) {

      if ($pl->getLevel() === Server::getInstance()->getLevelByName($config->get("world"))) {

        switch ($e->getCause()) {
         case EntityDamageEvent::CAUSE_VOID:
                                        if ($e->getFinalDamage() >= $pl->getHealth()) {
                    $e->setCancelled(true);
                    $name = $pl->getName();
                    foreach (Server::getInstance()->getLevelByName($config->get("world"))->getPlayers() as $level) {
                      $level->sendMessage("§l§cVOID§f» §r§f$name §ca muerto por el vacio!");
                      $this->getSound($level, "mob.fox.death");
                    }
                    Server::getInstance()->dispatchCommand($pl, "kitpvp join");
                  }
          break;
         case EntityDamageEvent::CAUSE_FALL:
           $e->setCancelled(true);
             $sopa = Item::get(282, 0, 33);
           if(!$pl->getInventory()->canAddItem($sopa)){
            return false;
           }
           $kit = new KitManager();
           $kit->GiveKit($pl);
           break;
          case EntityDamageEvent::CAUSE_FIRE:
            case EntityDamageEvent::CAUSE_FIRE_TICK:
              case EntityDamageEvent::CAUSE_LAVA:
                if($pl->getY() >= $damage->get("Protection")){
                 $e->setCancelled();
                  return false;
                }
                                if ($e->getFinalDamage() >= $pl->getHealth()) {
                    $e->setCancelled(true);
                    $name = $pl->getName();
                    foreach (Server::getInstance()->getLevelByName($config->get("world"))->getPlayers() as $level) {
                      $level->sendMessage("§l§cFIRE§f» §r§f$name §ca quemado o nadando en lava!");
                      $this->getSound($level, "mob.fox.death");
                    }
                    Server::getInstance()->dispatchCommand($pl, "kitpvp join");
                  }
          break;
          case EntityDamageEvent::CAUSE_PROJECTILE:
                            if($pl->getY() >= $damage->get("Protection")){
                 $e->setCancelled();
                  $pl->sendPopup("§l§cERROR§f» §r§7Esta altura esta protegida y no se puede hacer pvp!");
                  return false;
                }
                  if ($e instanceof EntityDamageByEntityEvent) {
              $damager = $e->getDamager();
              if ($damager instanceof Player) {
                if ($e->getFinalDamage() >= $pl->getHealth()) {
                  $e->setCancelled(true);
                  $name = $pl->getName();
                  $nam3 = $damager->getName();
                  foreach (Server::getInstance()->getLevelByName($config->get("world"))->getPlayers() as $level) {
                    $level->sendMessage("§l§cPROJECTILE§f» §r§f$name §cmurio por un proyectil de §f$nam3");
                    $this->getSound($level, "mob.fox.death");
                  }
                  $kills->set($nam3, $kills->get($nam3) + 1); $kills->save();
                                    $coins->set($nam3, $coins->get($nam3) + 20); $coins->save();
                  Server::getInstance()->dispatchCommand($pl, "kitpvp join");
                }
              }
            }
          break;
          case EntityDamageEvent::CAUSE_ENTITY_ATTACK:
                            if($pl->getY() >= $damage->get("Protection")){
                 $e->setCancelled();
                  $pl->sendPopup("§l§cERROR§f» §r§7Esta altura esta protegida y no se puede hacer pvp!");
                  return false;
                }
                    if ($e instanceof EntityDamageByEntityEvent) {
              $damager = $e->getDamager();
              if ($damager instanceof Player) {
                if ($e->getFinalDamage() >= $pl->getHealth()) {
                  $e->setCancelled(true);
                  $name = $pl->getName();
                  $nam3 = $damager->getName();
                  foreach (Server::getInstance()->getLevelByName($config->get("world"))->getPlayers() as $level) {
                    $level->sendMessage("§l§cATTACK§f» §r§f$name §cmurio por culpa de §f$nam3");
                    $this->getSound($level, "mob.fox.death");
                  }
                  $kills->set($nam3, $kills->get($nam3) + 1); $kills->save();
                  $coins->set($nam3, $coins->get($nam3) + 10); $coins->save();
                  Server::getInstance()->dispatchCommand($pl, "kitpvp join");
                }
              }
            }
          break;
         default:
                        if ($e->getFinalDamage() >= $pl->getHealth()) {
                    $e->setCancelled(true);
                    $name = $pl->getName();
                    foreach (Server::getInstance()->getLevelByName($config->get("world"))->getPlayers() as $level) {
                      $level->sendMessage("§l§cDIED§f» §r§f$name §ca muerto!");
                      $this->getSound($level, "mob.fox.death");
                    }
                    Server::getInstance()->dispatchCommand($pl, "kitpvp join");
                  }
      break;
        }
      }
    }
  }
}
?>