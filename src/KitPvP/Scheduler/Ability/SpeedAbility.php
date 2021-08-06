<?php

namespace KitPvP\Scheduler\Ability;

use KitPvP\KitPvP;
use pocketmine\scheduler\Task;
use pocketmine\{Player, Server};
use pocketmine\level\Level;
use pocketmine\entity\{Effect, EffectInstance};

class SpeedAbility extends Task {
  
  public $timer = 10;
  
  protected $plugin;
  
  protected $player;
  
  public function __construct(KitPvP $plugin, $player){
    
  $this->plugin = $plugin;
  $this->player = $player;
    
  }
  
  public function onRun($tick){
    
  $pl = $this->plugin->getServer()->getPlayer($this->player);
  
  if($pl instanceof Player){
    
  if($this->timer === 10){
  $pl->addEffect(new EffectInstance(Effect::getEffect(Effect::SPEED), (999999*20), (4), (false)));
  }
  if($this->timer === 9){
    
  }
  if($this->timer === 8){
    
  }
  if($this->timer === 7){
    
  }
  if($this->timer === 6){
    
  }
  if($this->timer === 5){
    
  }
  if($this->timer === 4){
    
  }
  if($this->timer === 3){
  $pl->sendMessage("§l§aABILITY§f» §r§7Tu habilidad se acaba en §63!");
  }
  if($this->timer === 2){
  $pl->sendMessage("§l§aABILITY§f» §r§7Tu habilidad se acaba en §62!");
  }
  if($this->timer === 1){
  $pl->sendMessage("§l§aABILITY§f» §r§7Tu habilidad se acaba en §61!");
  }
  if($this->timer === 0){
  
  $pl->sendMessage("§l§aABILITY§f» §r§7Tu habilidad se a acabado!");
  $pl->removeAllEffects();
  $this->plugin->getScheduler()->cancelTask($this->getTaskId());
    
  }
  $this->timer--;
  }else{
  $this->plugin->getScheduler()->cancelTask($this->getTaskId());
  }
  }
}
?>
