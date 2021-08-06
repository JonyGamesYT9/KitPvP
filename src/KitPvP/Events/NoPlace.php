<?php

namespace KitPvP\Events;

use KitPvP\KitPvP;
use pocketmine\event\Listener;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\{Player, Server};

class NoPlace implements Listener {
  
  public function noPlace(BlockPlaceEvent $e){
    
  $config = KitPvP::getConfigs("Map");
  $pl = $e->getPlayer();
  $name = $pl->getName();
  
  if($config->get("world") != null){
  if($pl->getLevel() === Server::getInstance()->getLevelByName($config->get("world"))){
    
  if(!$pl->isOp()){
  $e->setCancelled(true);
  $pl->sendMessage("§l§cERROR§f» §r§7No puedes colocar Bloques en esta arena!");
  }else{
  $e->setCancelled(false);
  }
    
  }
  }
  }
}