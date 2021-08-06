<?php

namespace KitPvP\Events;

use pocketmine\event\Listener;
use pocketmine\Server;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use KitPvP\KitPvP;

class NoBreak implements Listener {
  
public function noBreak(BlockBreakEvent $e){
  
$config = KitPvP::getConfigs("Map");
$pl = $e->getPlayer();

if($config->get("world") != null){
if($pl->getLevel() === Server::getInstance()->getLevelByName($config->get("world"))){
  
if(!$pl->isOp()){
$e->setCancelled(true);
$pl->sendMessage("§l§cERROR§f» §r§7No puedes romper Bloques en esta arena!");
}else{
$e->setCancelled(false);
}
  
}
}
}

public function onDrop(PlayerDropItemEvent $e){
  
$pl = $e->getPlayer();
$config = KitPvP::getConfigs("Map");

if($config->get("world") != null){
if($pl->getLevel() === Server::getInstance()->getLevelByName($config->get("world"))){
  
$e->setCancelled(true);
$pl->sendMessage("§l§cERROR§f» §r§7No puedes tirar Items en esta arena!");
  
}
}
}
}
?>