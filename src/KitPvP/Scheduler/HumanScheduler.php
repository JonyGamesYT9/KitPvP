<?php

declare(strict_types = 1);

namespace KitPvP\Scheduler;

use KitPvP\ {
  KitPvP,
  APIs\Entity\Types\Human2
};
use pocketmine\ {
  Server,
  Player,
  utils\TextFormat as Color,
  math\Vector2,
  entity\Effect,
  entity\EffectInstance,
  scheduler\Task
};
use pocketmine\network\mcpe\protocol\ {
  MovePlayerPacket
};
use pocketmine\level\Level;
use pocketmine\utils\Config;

class HumanScheduler extends Task {

  protected $plugin;

  public function __construct(KitPvP $plugin) {
    $this->plugin = $plugin;
  }

  public function onRun(int $currentTick) {
    $config = KitPvP::getConfigs("Map");
    foreach (Server::getInstance()->getDefaultLevel()->getEntities() as $entity) {
      if ($entity instanceof Human2) {
        $entity->setNameTag(self::setName());
        $entity->setNameTagAlwaysVisible(true);
        $entity->setScale(1.6);
      }
    }
  }

  public static function getPlayers() : int {
    $config = KitPvP::getConfigs("Map");
    if ($config->get("world") != null) {
      return count(Server::getInstance()->getLevelByName($config->get("world"))->getPlayers());
    } else {
      return 0;
    }
  }

  public static function setName() : string {
    $tap = [Color::GRAY . 'TAP TO PLAY',
      Color::RED . 'TAP TO PLAY',
      Color::GREEN . 'TAP TO PLAY',
      Color::GOLD . 'TAP TO PLAY'];
    $ran = [Color::AQUA . '[KILLS]',
      Color::AQUA . '[KITS]'];
    $play = [Color::GRAY . self::getPlayers(),
      Color::RED . self::getPlayers(),
      Color::GREEN . self::getPlayers(),
      Color::GOLD . self::getPlayers()];
    $title = Color::GRAY . Color::BOLD . '» ' . $tap[array_rand($tap)] . Color::GRAY . ' «' . "\n";
    $sub1 = Color::GOLD . Color::BOLD . "§6K§cI§6T§cP§6V§cP " . Color::RESET . $ran[array_rand($ran)] . "\n";
    $sub2 = '§fPlaying: ' . $play[array_rand($play)];
    return $title . $sub1 . $sub2;
  }
}
