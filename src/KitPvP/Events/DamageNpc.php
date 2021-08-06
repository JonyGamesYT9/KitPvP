<?php

namespace KitPvP\Events;

use KitPvP\KitPvP;
use KitPvP\APIs\Entity\Types\{Human2, KillsTops};
use pocketmine\event\Listener;
use pocketmine\{Player, Server};
use pocketmine\event\entity\{EntityDamageByEntityEvent, EntityDamageEvent};
use pocketmine\level\{Level, Position};
use pocketmine\entity\Entity;

class DamageNpc implements Listener {
  
  public function onDamageNpc(EntityDamageByEntityEvent $e){
  if($e->getEntity() instanceof Human2){
  $pl = $e->getDamager();
  if($pl instanceof Player){
  $e->setCancelled(true);
  KitPvP::getInstance()->getServer()->dispatchCommand($pl, "kpvp join");
  }
  }
  }
  
  public function onDamageTops(EntityDamageByEntityEvent $e){
  if($e->getEntity() instanceof KillsTops){
  $pl = $e->getDamager();
  if($pl instanceof Player){
  $e->setCancelled(true);
  }
  }
  }
}
