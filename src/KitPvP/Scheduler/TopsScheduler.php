<?php

declare(strict_types = 1);

namespace KitPvP\Scheduler;

use KitPvP\ {
  KitPvP,
  APIs\Entity\Types\KillsTops
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

class TopsScheduler extends Task {

  public function onRun(int $currentTick) {
    foreach (Server::getInstance()->getDefaultLevel()->getEntities() as $entity) {
      if ($entity instanceof KillsTops) {
        $entity->setNameTag(self::setTops());
        $entity->setNameTagAlwaysVisible(true);
        $entity->setScale(0.1);
      }
    }
  }

  public static function setTops() : string {
    $kills = KitPvP::getConfigs('Kills');
    $tops = [];
    $title = Color::BOLD . '§7» §6K§cI§6T§cP§6V§cP §fKills Leardboard §7«' . "\n";
    foreach ($kills->getAll() as $key => $top) {
      array_push($tops, $top);
    }
    natsort($tops);
    $player = array_reverse($tops);
    if (max($tops) != null) {
      $top1 = array_search(max($tops), $kills->getAll());
      $subtitle1 = '§8[§6#1§8] ' . Color::WHITE . $top1 . Color::GRAY . ': ' . Color::WHITE . max($tops) . Color::YELLOW . ' Kills' . "\n";
    } else {
      $subtitle1 = '';
    }
    if ($player[1] != null) {
      $top2 = array_search($player[1], $kills->getAll());
      $subtitle2 = '§8[§c#2§8] ' . Color::WHITE . $top2 . Color::GRAY . ': ' . Color::WHITE . $player[1] . Color::YELLOW . ' Kills' . "\n";
    } else {
      $subtitle2 = '';
    }
    if ($player[2] != null) {
      $top3 = array_search($player[2], $kills->getAll());
      $subtitle3 = '§8[§6#3§8] ' . Color::WHITE . $top3 . Color::GRAY . ': ' . Color::WHITE . $player[2] . Color::YELLOW . ' Kills' . "\n";
    } else {
      $subtitle3 = '';
    }
    if ($player[3] != null) {
      $top4 = array_search($player[3], $kills->getAll());
      $subtitle4 = '§8[§c#4§8] ' . Color::WHITE . $top4 . Color::GRAY . ': ' . Color::WHITE . $player[3] . Color::YELLOW . ' Kills' . "\n";
    } else {
      $subtitle4 = '';
    }
    if ($player[4] != null) {
      $top5 = array_search($player[4], $kills->getAll());
      $subtitle5 = '§8[§6#5§8] ' . Color::WHITE . $top5 . Color::GRAY . ': ' . Color::WHITE . $player[4] . Color::YELLOW . ' Kills' . "\n";
    } else {
      $subtitle5 = '';
    }
    if ($player[5] != null) {
      $top6 = array_search($player[5], $kills->getAll());
      $subtitle6 = '§8[§c#6§8] ' . Color::WHITE . $top6 . Color::GRAY . ': ' . Color::WHITE . $player[5] . Color::YELLOW . ' Kills' . "\n";
    } else {
      $subtitle6 = '';
    }
    if ($player[6] != null) {
      $top7 = array_search($player[6], $kills->getAll());
      $subtitle7 = '§8[§6#7§8] ' . Color::WHITE . $top7 . Color::GRAY . ': ' . Color::WHITE . $player[6] . Color::YELLOW . ' Kills' . "\n";
    } else {
      $subtitle7 = '';
    }
    if ($player[7] != null) {
      $top8 = array_search($player[7], $kills->getAll());
      $subtitle8 = '§8[§c#8§8] ' . Color::WHITE . $top8 . Color::GRAY . ': ' . Color::WHITE . $player[7] . Color::YELLOW . ' Kills' . "\n";
    } else {
      $subtitle8 = '';
    }
    if ($player[8] != null) {
      $top9 = array_search($player[8], $kills->getAll());
      $subtitle9 = '§8[§6#9§8] ' . Color::WHITE . $top9 . Color::GRAY . ': ' . Color::WHITE . $player[8] . Color::YELLOW . ' Kills' . "\n";
    } else {
      $subtitle9 = '';
    }
    if ($player[9] != null) {
      $top10 = array_search($player[9], $kills->getAll());
      $subtitle10 = '§8[§c#10§8] ' . Color::WHITE . $top10 . Color::GRAY . ': ' . Color::WHITE . $player[9] . Color::YELLOW . ' Kills' . "\n";
    } else {
      $subtitle10 = '';
    }
    return $title . $subtitle1 . $subtitle2 . $subtitle3 . $subtitle4 . $subtitle5 . $subtitle6 . $subtitle7 . $subtitle8 . $subtitle9 . $subtitle10;
  }
}
?>
