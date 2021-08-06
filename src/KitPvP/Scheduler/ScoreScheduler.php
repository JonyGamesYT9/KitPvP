<?php

namespace KitPvP\Scheduler;

use KitPvP\KitPvP;
use KitPvP\APIs\ScoreAPI;
use pocketmine\ {
  Server,
  Player,
  utils\TextFormat as Color,
  level\Level,
  scheduler\Task
};

class ScoreScheduler extends Task {

  /** @var KitPvP $plugin */
  protected $plugin;

  /**
  * ScoreScheduler Constructor
  * @param KitPvP $plugin
  */
  public function __construct(KitPvP $plugin) {
    $this->plugin = $plugin;
  }

  /**
  * @param Int $currentTick
  */

  public function onRun(int $currentTick) {

    $config = $this->plugin->getConfigs('Map');

    $mapa = $config->get("world");

    $arena = $this->plugin->getServer()->getLevelByName($mapa);

    $kills = KitPvP::getConfigs('Kills');

    if ($arena !== null) {

      foreach ($arena->getPlayers() as $pl) {

        $api = KitPvP::getScoreboard();

        $players = count($arena->getPlayers());

        $coins = KitPvP::getConfigs("Coins");
        
        $kit = KitPvP::getConfigs("Kits");
        
        $board = KitPvP::getConfigs("Config");

        $mykills = $kills->get($pl->getName());
        $mycoins = $coins->get($pl->getName());
        $mykit = $kit->get($pl->getName());

        $api->set($pl, $pl->getName(), $board->get("scoreboard_title"));
        $api->setLine($pl, 1, "§r");
        $api->setLine($pl, 2, "§l§6N§cA§6M§cE§f:");
        $api->setLine($pl, 3, "§f" . $pl->getName());
        $api->setLine($pl, 4, "§r§r§r");
        $api->setLine($pl, 5, "§l§6C§cO§6I§cN§6S§f:");
        $api->setLine($pl, 6, "§f" . $mycoins);
        $api->setLine($pl, 7, "§r§r§r§r");
        $api->setLine($pl, 8, "§l§6K§cI§6L§cL§6S§f: §r" . $mykills);
        $api->setLine($pl, 9, "§l§6K§cI§6T§f: §r" . $mykit);
        $api->setLine($pl, 10, "§r§r§r§r§r");
        $api->setLine($pl, 11, $board->get("scoreboard_ip"));
        $api->getObjectiveName($pl);
      }
    }
  }

  public function getRank(Player $player) {
    $purePerms = $this->plugin->getServer()->getPluginManager()->getPlugin("PurePerms");
    if ($purePerms !== null) {
      $group = $purePerms->getUserDataMgr()->getData($player)['group'];
      if ($group !== null) {
        return $group;
      } else {
        return "Guest";
      }
    } else {
      return "Require PurePerms";
    }
  }
}
?>
