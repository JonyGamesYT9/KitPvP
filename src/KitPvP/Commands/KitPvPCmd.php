<?php

namespace KitPvP\Commands;

use KitPvP\KitPvP;
use KitPvP\Forms;
use KitPvP\APIs\Entity\EntityManager;
use KitPvP\APIs\BossBar;
use KitPvP\APIs\Entity\Types\ {
  Human2,
  KillsTops
};
use pocketmine\command\ {
  Command,
  CommandSender
};
use pocketmine\level\ {
  Level,
  Position
};
use pocketmine\ {
  Player,
  Server
};
use pocketmine\item\Item;


/**
* Class KitPvPCmd
* Extends Command
*/
class KitPvPCmd extends Command {

  /** @var KitPvPCmd $plugin */
  protected $plugin;

  /**
  * KitPvPCmd Constructor.
  * @param KitPvP $plugin
  */
  function __construct(KitPvP $plugin) {
    $this->plugin = $plugin;
    parent::__construct("kitpvp", "KitPvP System (/kpvp help) By: JonyGamesYT9", null, ["kpvp", "kitp", "kp"]);
  }

  /**
  * @param CommandSender $pl
  * @param string $label
  * @param array $args
  * @return mixed|void
  */
  function execute(CommandSender $pl, string $label, array $args) {

    if (empty($args[0])) {
      $pl->sendMessage("§l§cERROR§f» §r§7Escribe un argumento!");
      return false;
    }

    switch ($args[0]) {
      case 'help':
        $pl->sendMessage("§l§a» §r§7=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=");
        $pl->sendMessage("§l§e» §r§3/kpvp help: §fHELP COMMANDS");
        $pl->sendMessage("§l§6» §r§3/kpvp make: §fSET KITPVP WORLD");
        $pl->sendMessage("§l§e» §r§3/kpvp spawn: §fSET KITPVP SPAWN");
        $pl->sendMessage("§l§6» §r§3/kpvp npc|tops|remove: §fKITPVP ENTITYS");
        $pl->sendMessage("§l§e» §r§3/kpvp join: §fJOIN TO KITPVP");
        $pl->sendMessage("§l§6» §r§3/kpvp coins: §fADMIN COINS MANAGER");
        $pl->sendMessage("§l§e» §r§3/kpvp sign: §fSEE FOOD FORMAt");
        $pl->sendMessage("§l§6» §r§3/kpvp protection: §fPROTECT KITPVP SPAWN");
        $pl->sendMessage("§l§a» §r§7=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=");
        break;
      case 'make':
        if(!$pl instanceof Player){
        $pl->sendMessage("§l§cERROR§f» §r§7Use this command in-game");
        return false;
        }
        if ($pl->isOp()) {
          $config = KitPvP::getConfigs("Map");
          $config->set("world", $pl->getLevel()->getFolderName());
          $config->save();
          $map = $config->get("world");
          $pl->sendMessage("§l§aOKAY§f» §r§7Colocaste el Mapa en $map");
        } else {
          $pl->sendMessage("§l§6AUTHOR§f» §r§7Plugin By: JonyGamesYT9");
        }
        break;
      case 'sign':
        $pl->sendMessage("line4: food");

        $pl->sendMessage("§l§3FOOD_SIGN§f» §r§7Escribe en un cartel lo mismo de arriba!");
        break;
      case 'spawn':
        if(!$pl instanceof Player){
        $pl->sendMessage("§l§cERROR§f» §r§7Use this command in-game");
        return false;
        }
        if ($pl->isOp()) {
          $config = KitPvP::getConfigs("Map");
          $x = $pl->getX();
          $y = $pl->getY();
          $z = $pl->getZ();
          $config->set("x", $x);
          $config->set("y", $y);
          $config->set("z", $z);
          $config->save();
          $pl->sendMessage("§l§aOKAY§f» §r§7Spawn colocado en X:$x \ Y: $y \ Z: $z");
        } else {
          $pl->sendMessage("§l§6AUTHOR§f» §r§7Plugin By: JonyGamesYT9");
        }
        break;
      case 'npc':
        if(!$pl instanceof Player){
        $pl->sendMessage("§l§cERROR§f» §r§7Use this command in-game");
        return false;
        }
        if ($pl->isOp()) {
          $manager = new EntityManager();
          $manager->setNpc($pl);
          $pl->sendMessage("§l§aOKAY§f» §r§7Npc colocado Correctamente");
        } else {
          $pl->sendMessage("§l§6AUTHOR§f» §r§7Plugin By: JonyGamesYT9");
        }
        break;
      case 'tops':
        if(!$pl instanceof Player){
        $pl->sendMessage("§l§cERROR§f» §r§7Use this command in-game");
        return false;
        }
        if ($pl->isOp()) {
          $manager = new EntityManager();
          $manager->setTop($pl);
          $pl->sendMessage("§l§aOKAY§f» §r§7Top colocado Correctamente");
        } else {
          $pl->sendMessage("§l§6AUTHOR§f» §r§7Plugin By: JonyGamesYT9");
        }
        break;
      case 'remove':
        if(!$pl instanceof Player){
        $pl->sendMessage("§l§cERROR§f» §r§7Use this command in-game");
        return false;
        }
        if ($pl->isOp()) {
          foreach ($pl->getLevel()->getEntities() as $npc) {
            if ($npc instanceof Human2) {
              $npc->kill();
            } else if ($npc instanceof KillsTops) {
              $npc->kill();
            }
          }
          $pl->sendMessage("§l§aOKAY§f» §r§7Eliminaste los Npcs");
        } else {
          $pl->sendMessage("§l§6AUTHOR§f» §r§7Plugin By: JonyGamesYT9");
        }
        break;
      case 'join':
        if(!$pl instanceof Player){
        $pl->sendMessage("§l§cERROR§f» §r§7Use this command in-game");
        return false;
        }
        $config = KitPvP::getConfigs("Map");
        if ($config->get("world") != null) {

          $name = $pl->getName();

          $pl->getInventory()->clearAll();
          $pl->getArmorInventory()->clearAll();
          
          $coins = KitPvP::getConfigs("Coins");
          $kit = KitPvP::getConfigs("Kits");
          $board = KitPvP::getConfigs("Config");
       
          if($coins->get($name) == null){
          $coins->set($name, 0);
          $coins->save();
          }
          
          if($kit->get($name) == null){
          $kit->set($name, "Default");
          $kit->save();
          }
          
          $pl->setFood(19);
          $pl->setHealth(20);

          $pl->getInventory()->setItem(1, Item::get(Item::BOOK, 0, 1)->setCustomName("§l§eKITS\n§r§8[CLICK]"));
          $pl->getInventory()->setItem(2, Item::get(Item::CLOCK, 0, 1)->setCustomName("§l§6STATS\n§r§8[CLICK]"));
          $pl->getInventory()->setItem(7, Item::get(Item::TOTEM, 0, 1)->setCustomName("§l§cLOBBY\n§r§8[CLICK]"));

          $pl->teleport(new Position($config->get("x"), $config->get("y"), $config->get("z"), Server::getInstance()->getLevelByName($config->get("world"))));
          BossBar::set($pl, $board->get("bossbar_title"));
        } else {
          $pl->sendMessage("§l§cERROR§f» §r§7Mundo de KitPvP no Colocado");
        }
        break;
      case "coins":
        if(!$pl instanceof Player){
        $pl->sendMessage("§l§cERROR§f» §r§7Use this command in-game");
        return false;
        }
        if($pl->isOp()){
        $form = new Forms();
        $form->getCoins($pl);
        }else{
        $pl->sendMessage("§l§6AUTHOR§f» §r§7Plugin By: JonyGamesYT9");
        }
        break;
      case "protection":
        if(!$pl instanceof Player){
        $pl->sendMessage("§l§cERROR§f» §r§7Use this command in-game");
        return false;
        }
        if($pl->isOp()){
        $config = KitPvP::getConfigs("Protect");
        $config->set("Protection", $pl->getY());
        $config->save();
        $pl->sendMessage("§l§aOKAY§f» §r§7Colocaste la Protección Correctamente, Ahora si el jugador si su altura es mayor a §6{$pl->getY()} §7no podra pegar con nada, en cambio si la altura del jugador es menor a §6{$pl->getY()} §7si se podran pegar entre todos.");
        }else{
        $pl->sendMessage("§l§6AUTHOR§f» §r§7Plugin By: JonyGamesYT9");
        }
        break;
      default:
        $pl->sendMessage("§l§6AUTHOR§f» §r§7Plugin By: JonyGamesYT9");
        break;
    }
  }
}
?>
