<?php

namespace KitPvP\Scheduler\Ability;

use KitPvP\KitPvP;
use pocketmine\scheduler\Task;
use pocketmine\{Player, Server};
use pocketmine\level\Level;
use pocketmine\entity\{Effect, EffectInstance};

class FlyAbility extends Task {
  
  public $timer = 15;
  
  protected $plugin;
  
  protected $player;
  
  public function __construct(KitPvP $plugin, $player){
    
  $this->plugin = $plugin;
  $this->player = $player;
    
  }
  
  public function onRun($tick){
    
  $pl = Server::getInstance()->getPlayer($this->player);
    
  if($pl instanceof Player){
    
  $time = $this->timer;
    
  if($time === 15){
  $pl->setAllowFlight(true);
  }
  if($time === 14){
    
  }
  if($time === 13){
    
  }
  if($time === 12){
    
  }
  if($time === 11){
    
  }
  if($time === 10){
    
  }
  if($time === 9){
    
  }
  if($time === 8){
    
  }
  if($time === 7){
    
  }
  if($time === 6){
    
  }
  if($time === 5){
    
  }
  if($time === 4){
    
  }
  if($time === 3){
  $pl->sendMessage("§l§aABILITY§f» §r§7Tu habilidad se acaba en §63!");
  }
  if($time === 2){
  $pl->sendMessage("§l§aABILITY§f» §r§7Tu habilidad se acaba en §62!");
  }
  if($time === 1){
  $pl->sendMessage("§l§aABILITY§f» §r§7Tu habilidad se acaba en §61!");
  }
  if($time === 0){
  $pl->setAllowFlight(false);
  $pl->sendMessage("§l§aABILITY§f» §r§7Tu habilidad se a acabado!");
  $pl->setFlying(false);
  $this->plugin->getScheduler()->cancelTask($this->getTaskId());
  }
  $this->timer--;
  }else{
  $this->plugin->getScheduler()->cancelTask($this->getTaskId());
  }
    
  }
  
}
