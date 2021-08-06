<?php

namespace KitPvP;

use KitPvP\KitPvP;
use KitPvP\APIs\FormAPI\FormUI;
use pocketmine\ {
  Player,
  Server
};
use pocketmine\level\Level;
use pocketmine\item\Item;
use pocketmine\plugin\Plugin;

class Forms {

  use FormUI;

  function getMain(Player $pl) {

    $form = $this->createSimpleFor(function(Player $pl, ?int $data) {

      if (!is_null($data)) {

        switch ($data) {

          case 0:

            $this->getShopKits($pl);

            break;

          case 1:

            $this->getMyKits($pl);

            break;

        }

      }

    });

    $form->setTitle("§l§eKITS MANAGER");

    $form->addButton("§l§fSHOP KITS\n§l§eTap To Open",0,"textures/ui/icon_minecoin_9x9");

    $form->addButton("§l§fMY KITS\n§l§eTap To Open",0,"textures/ui/icon_blackfriday");

    $form->sendToPlayer($pl);

  }

  function getShopKits(Player $pl) {

    $form = $this->createSimpleFor(function(Player $pl, ?int $data) {

      if ( !is_null($data)) {

        switch ($data) {
          
          case 0:
            
          if(!$pl->hasPermission("kitpvp.flash")){
          
          $coins = KitPvP::getConfigs("Coins");
          
          $name = $pl->getName();
          
          if($coins->get($name) >= 750){
            
          $coins->set($name, $coins->get($name) - 750);
            
          $pl->sendMessage("§l§6COMPRA§f» §r§7Compraste el Kit FLASH correctamente");
         
          $this->plugin = KitPvP::getInstance();
         
          $pl->addAttachment($this->plugin, "kitpvp.flash", true);
            
          }else{
            
          $pl->sendMessage("§l§cERROR§f» §r§7No cuentas con suficientes Coins!");
            
          }
          
          }else{
            
          $pl->sendMessage("§l§cERROR§f» §r§7El Kit FLASH ya lo tienes comprado");
          
          }
            
          break;
          
          case 1:
            
          if(!$pl->hasPermission("kitpvp.appler")){
          
          $coins = KitPvP::getConfigs("Coins");
          
          $name = $pl->getName();
          
          if($coins->get($name) >= 500){
            
          $coins->set($name, $coins->get($name) - 500);
            
          $pl->sendMessage("§l§6COMPRA§f» §r§7Compraste el Kit APPLER correctamente");
         
          $this->plugin = KitPvP::getInstance();
         
          $pl->addAttachment($this->plugin, "kitpvp.appler", true);
            
          }else{
            
          $pl->sendMessage("§l§cERROR§f» §r§7No cuentas con suficientes Coins!");
            
          }
          
          }else{
            
          $pl->sendMessage("§l§cERROR§f» §r§7El Kit APPLER ya lo tienes comprado");
          
          }
            
          break;
          
          case 2:
            
          if(!$pl->hasPermission("kitpvp.eagle")){
          
          $coins = KitPvP::getConfigs("Coins");
          
          $name = $pl->getName();
          
          if($coins->get($name) >= 500){
            
          $coins->set($name, $coins->get($name) - 500);
            
          $pl->sendMessage("§l§6COMPRA§f» §r§7Compraste el Kit EAGLE correctamente");
         
          $this->plugin = KitPvP::getInstance();
         
          $pl->addAttachment($this->plugin, "kitpvp.eagle", true);
            
          }else{
            
          $pl->sendMessage("§l§cERROR§f» §r§7No cuentas con suficientes Coins!");
            
          }
          
          }else{
            
          $pl->sendMessage("§l§cERROR§f» §r§7El Kit EAGLE ya lo tienes comprado");
          
          }
            
          break;
          
          case 3:
          $pl->sendMessage("§l§cERROR§f» §r§7Esto no es un Kit solo es un aviso");
          break;
          
        }

      }

    });
    
    $form->setTitle("§l§fKITS SHOP");
    
    if(!$pl->hasPermission("kitpvp.flash")){
    $form->addButton("§l§8BUY: §fFLASH\n§r§7[§b750§7] §7Disponible");
    }else{
    $form->addButton("§l§8SPEND: §cFLASH\n§r§7[§c0§7] §7No disponible");
    }
    
    if(!$pl->hasPermission("kitpvp.appler")){
    $form->addButton("§l§8BUY: §fAPPLER\n§r§7[§b500§7] §7Disponible");
    }else{
    $form->addButton("§l§8SPEND: §cAPPLER\n§r§7[§c0§7] §7No disponible");
    }
    
    if(!$pl->hasPermission("kitpvp.eagle")){
    $form->addButton("§l§8BUY: §fEAGLE\n§r§7[§b800§7] §7Disponible");
    }else{
    $form->addButton("§l§8SPEND: §cEAGLE\n§r§7[§c0§7] §7No disponible");
    }
    
    $form->addButton("§l§8PROXIMAMENTE\n§l§8MAS KITS");
    
    $form->sendToPlayer($pl);

  }
  
  function getMyKits(Player $pl){
    
  $form = $this->createSimpleFor(function(Player $pl, ?int $data){
    
  $name = $pl->getName();
    
  if( !is_null($data)){
    
  switch($data) {
  
  case 0:
    
  $config = KitPvP::getConfigs("Kits");
  
  $config->set($name, "Default");
  
  $config->save();
  
  $pl->sendMessage("§l§aOKAY§f» §r§7te colocaste el Kit DEFAULT");
  break;
  
  case 1:
    
  if(!$pl->hasPermission("kitpvp.flash")){
  $pl->sendMessage("§l§cERROR§f» §r§7este Kit no es de tu propiedad, compralo!");
  }else{
  $config = KitPvP::getConfigs("Kits");
  
  $config->set($name, "Flash");
  
  $config->save();
  
  $pl->sendMessage("§l§aOKAY§f» §r§7te colocaste el Kit FLASH");
  }
    
  break;
  
  case 2:
    
  if(!$pl->hasPermission("kitpvp.appler")){
  $pl->sendMessage("§l§cERROR§f» §r§7este Kit no es de tu propiedad, compralo!");
  }else{
  $config = KitPvP::getConfigs("Kits");
  
  $config->set($name, "Appler");
  
  $config->save();
  
  $pl->sendMessage("§l§aOKAY§f» §r§7te colocaste el Kit APPLER");
  }
    
  break;
  
  case 3:
    
  if(!$pl->hasPermission("kitpvp.eagle")){
  $pl->sendMessage("§l§cERROR§f» §r§7este Kit no es de tu propiedad, compralo!");
  }else{
  $config = KitPvP::getConfigs("Kits");
  
  $config->set($name, "Eagle");
  
  $config->save();
  
  $pl->sendMessage("§l§aOKAY§f» §r§7te colocaste el Kit EAGLE");
  }
    
  break;
  
  }
    
  }
    
  });
  
  $form->setTitle("§l§fMY KITS");
  
  $form->addButton("§l§8KIT: §3DEFAULT\n§7Disponible");
  
  if(!$pl->hasPermission("kitpvp.flash")){
  $form->addButton("§l§8KIT: §cFLASH\n§7No disponible");
  }else{
  $form->addButton("§l§8KIT: §3FLASH\n§7Disponible");
  }
  
  if(!$pl->hasPermission("kitpvp.appler")){
  $form->addButton("§l§8KIT: §cAPPLER\n§7No disponible");
  }else{
  $form->addButton("§l§8KIT: §3APPLER\n§7Disponible");
  }
  
  if(!$pl->hasPermission("kitpvp.eagle")){
  $form->addButton("§l§8KIT: §cEAGLE\n§7No disponible");
  }else{
  $form->addButton("§l§8KIT: §3EAGLE\n§7Disponible");
  }
  
  $form->sendToPlayer($pl);
    
  }
  
  function getCoins(Player $pl){
    
  $form = $this->createSimpleFor(function(Player $pl, ?int $data){
    
  $name = $pl->getName();
  
  if( !is_null($data)){
    
  switch($data) {
  case 0:
  $this->getAddCoins($pl);
  break;
  case 1:
  $this->getRemoveCoins($pl);
  break;
  default:
  break;
  }
    
  }
    
  });
    
  $form->setTitle("§l§6COINS MANAGER");
  
  $form->addButton("§l§bADD COINS\n§r§7Tap to open");
  
  $form->addButton("§l§cREMOVE COINS\n§r§7Tap to open");
  
  $form->sendToPlayer($pl);
    
  }
  
  function getAddCoins(Player $pl){
    
  $form = $this->createCustomFor(function(Player $pl, ?array $data){
    
  if( !is_null($data)){
    
  if(empty($data[0])){
  $pl->sendMessage("§l§cERROR§f» §r§7escribe el nombre del jugador");
  return;
  }
  
  $target = Server::getInstance()->getPlayer($data[0]);
  
  if(empty($data[1])){
  $pl->sendMessage("§l§cERROR§f» §r§7escribe la cantidad a añadir!");
  return;
  }
  
  if(is_null($target)){
  $pl->sendMessage("§l§cERROR§f» §r§7el jugador mencionado no esta activo");
  return;
  }
  
  if(!is_numeric($data[1])){
  $pl->sendMessage("§l§cERROR§f» §r§7la cantidad a añadir no es un numero!");
  return;
  }
  
  $name = $target->getName();
  
  $coins = KitPvP::getConfigs("Coins");
  
  $coins->set($name, $coins->get($name) + $data[1]);
  
  $coins->save();
  
  $pl->sendMessage("§l§aOKAY§f» §r§7añadiste $data[1] coins al jugador $data[0] Correctamente");
    
  $n = $pl->getName();
  
  $target->sendMessage("§l§eCOINS§f» §r§7se te añadieron $data[1] coins de parte de $n !");
    
  }
    
  });
  
  $form->setTitle("§l§bADD COINS");
  
  $form->addInput("§l§f» §r§7Escribe el nombre del jugador", "Ejemplo: Happier123XD");
  
  $form->addInput("§l§f» §r§7Escribe la cantidad a añadir", "Ejemplo: 810");
  
  $form->sendToPlayer($pl);
    
  }
  
  function getRemoveCoins(Player $pl){
    
  $form = $this->createCustomFor(function(Player $pl, ?array $data){
    
  if( !is_null($data)){
    
  if(empty($data[0])){
  $pl->sendMessage("§l§cERROR§f» §r§7escribe el nombre del jugador");
  return;
  }
  
  $target = Server::getInstance()->getPlayer($data[0]);
  
  if(empty($data[1])){
  $pl->sendMessage("§l§cERROR§f» §r§7escribe la cantidad a remover!");
  return;
  }
  
  if(is_null($target)){
  $pl->sendMessage("§l§cERROR§f» §r§7el jugador mencionado no esta activo");
  return;
  }
  
  if(!is_numeric($data[1])){
  $pl->sendMessage("§l§cERROR§f» §r§7la cantidad a remover no es un numero!");
  return;
  }
  
  $name = $target->getName();
  
  $coins = KitPvP::getConfigs("Coins");
  
  $coins->set($name, $coins->get($name) - $data[1]);
  
  $coins->save();
  
  $pl->sendMessage("§l§aOKAY§f» §r§7le quitaste $data[1] coins al jugador $data[0] Correctamente");
    
  $n = $pl->getName();
  
  $target->sendMessage("§l§eCOINS§f» §r§7se te quitaron $data[1] coins de parte de $n !");
    
  }
    
  });
  
  $form->setTitle("§l§cREMOVE COINS");
  
  $form->addInput("§l§f» §r§7Escribe el nombre del jugador", "Ejemplo: Happier123XD");
  
  $form->addInput("§l§f» §r§7Escribe la cantidad a remover", "Ejemplo: 810");
  
  $form->sendToPlayer($pl);
    
  }

}
// »
?>
