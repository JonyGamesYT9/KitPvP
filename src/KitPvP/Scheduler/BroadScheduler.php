<?php

namespace KitPvP\Scheduler;

use KitPvP\KitPvP;
use KitPvP\Sound;
use pocketmine\{Player, Server};
use pocketmine\level\Level;
use pocketmine\scheduler\Task;

class BroadScheduler extends Task {
  
  private $plugin;
  
  public function __construct(KitPvP $plugin){
  $this->plugin = $plugin;
  }
  
  public function sendMessage(){
  $sound = new Sound();
  $config = KitPvP::getConfigs("Map");
  $msg = [
  "§7Puedes comprar mas kits para ganar aun mas coins!",
  "§7Los kits se hiran añadiendo cada 1 semana!",
  "§7Usa /report si ves a un Hacker, SpawnKill, Multicuenta(para kill free)",
  "§7El top kills es muy alto! intenta quedar en el top 1."
  ];
  $messages = $msg[array_rand($msg)];
  $title = array("§l§3ANOUNCE§f» §r");
  $titulo = $title[array_rand($title)];
  if($config->get("world") != null){
  foreach(Server::getInstance()->getLevelByName($config->get("world"))->getPlayers() as $kitpvp){
  $kitpvp->sendMessage($titulo.$messages);
  $sound->getSound($kitpvp, "note.hat");
  }
  }
  }
  
  public function onRun($tick){
  $this->sendMessage();
  }
}
