<?php

namespace KitPvP\Kit;

use KitPvP\KitPvP;
use pocketmine\ {
  Player,
  Server
};
use pocketmine\item\enchantment\ {
  Enchantment,
  EnchantmentInstance
};
use pocketmine\item\Item;
use pocketmine\level\Level;

class KitManager {
  
  public $i = 0;

  function GiveKit(Player $pl) {

    $kit = KitPvP::getConfigs("Kits");

    $name = $pl->getName();
    
    $item = $pl->getInventory();
    $armor = $pl->getArmorInventory();

    switch ($kit->get($name)) {
      case "Default":
               $pl->getInventory()->clearAll(); $pl->getArmorInventory()->clearAll(); $pl->removeAllEffects();
        $filo = new EnchantmentInstance(Enchantment::getEnchantment(9), 1);
        $espada = Item::get(Item::IRON_SWORD, 0, 1);
        $espada->addEnchantment($filo);
        $item->setItem(0, $espada);
        $armor->setHelmet(Item::get(Item::IRON_HELMET, 0, 1));
        $armor->setChestplate(Item::get(303, 0, 1));
        $armor->setLeggings(Item::get(Item::IRON_LEGGINGS, 0, 1));
        $armor->setBoots(Item::get(305, 0, 1));
        $i = 0;
        while($i < 50){
        $item->addItem(Item::get(282, 0, 1));
        $i++;
        }
        break;
      case "Flash":
             $pl->getInventory()->clearAll(); $pl->getArmorInventory()->clearAll(); $pl->removeAllEffects();
                $filo = new EnchantmentInstance(Enchantment::getEnchantment(9), 2);
      $espada = Item::get(Item::IRON_SWORD, 0, 1);
        $espada->addEnchantment($filo);
        $item->setItem(0, $espada);
        $item->setItem(1, Item::get(Item::BOOK, 0, 1)->setCustomName("§l§bSPEED ABILITY\n§8[CLICK]"));
       $armor->setHelmet(Item::get(Item::IRON_HELMET, 0, 1));
        $armor->setChestplate(Item::get(315, 0, 1));
        $armor->setLeggings(Item::get(Item::IRON_LEGGINGS, 0, 1));
        $armor->setBoots(Item::get(317, 0, 1));
        $i = 0;
        while($i < 50){
        $item->addItem(Item::get(282, 0, 1));
        $i++;
        }
        break;
      case "Appler":
               $pl->getInventory()->clearAll(); $pl->getArmorInventory()->clearAll(); $pl->removeAllEffects();
       $filo = new EnchantmentInstance(Enchantment::getEnchantment(9), 1);
      $espada = Item::get(Item::IRON_SWORD, 0, 1);
        $espada->addEnchantment($filo);
        $item->setItem(0, $espada);
        $item->setItem(1, Item::get(Item::GOLDEN_APPLE, 0, 32));
        $armor->setHelmet(Item::get(314, 0, 1));
        $armor->setChestplate(Item::get(315, 0, 1));
        $armor->setLeggings(Item::get(316, 0, 1));
        $armor->setBoots(Item::get(317, 0, 1));
        break;
      case "Eagle": 
        $pl->getInventory()->clearAll(); $pl->getArmorInventory()->clearAll(); $pl->removeAllEffects();
       $filo = new EnchantmentInstance(Enchantment::getEnchantment(9), 1);
      $espada = Item::get(Item::IRON_SWORD, 0, 1);
        $espada->addEnchantment($filo);
        $item->setItem(0, $espada);
        $item->setItem(1, Item::get(Item::BOOK, 0, 1)->setCustomName("§l§6FLY ABILITY\n§8[CLICK]"));
        $armor->setHelmet(Item::get(298, 0, 1));
        $armor->setChestplate(Item::get(307, 0, 1));
        $armor->setLeggings(Item::get(300, 0, 1));
        $armor->setBoots(Item::get(301, 0, 1));
        $i = 0;
        while($i < 50){
        $item->addItem(Item::get(282, 0, 1));
        $i++;
        }
        break;
    }
  }
}
?>
