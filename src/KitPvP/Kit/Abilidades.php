<?php

namespace KitPvP\Kit;

use KitPvP\KitPvP;
use KitPvP\Sound;
use KitPvP\Scheduler\Ability\SpeedAbility;
use KitPvP\Scheduler\Ability\FlyAbility;
use pocketmine\event\Listener;
use pocketmine\scheduler\Task;
use pocketmine\ {
  Player,
  Server
};
use pocketmine\event\player\{PlayerInteractEvent, PlayerChatEvent};
use pocketmine\math\Vector3;

class Abilidades implements Listener {

  /** @var array $flyCooldown[] */
  private $flyCooldown = [];

  /** @var array $speedCooldown[] */
  private $speedCooldown = [];

  /** @var $flyTimer */
  private $flyTimer = 75;

  /** @var $speedTimer */
  private $speedTimer = 35;

  public function ActiveFlashAbility(PlayerInteractEvent $e) {
    $pl = $e->getPlayer();
    $name = $pl->getName();
    $item = $e->getItem();
    $config = KitPvP::getConfigs("Map");
    if ($config->get("world") != null) {
      if ($item->getCustomName() === "§l§bSPEED ABILITY\n§8[CLICK]") {
        if ($pl->getLevel() === Server::getInstance()->getLevelByName($config->get("world"))) {
          if (!isset($this->speedCooldown[$pl->getName()])) {
            $this->speedCooldown[$pl->getName()] = time() + $this->speedTimer; // 35 Segundos de Cooldown ya que la habilidad dura 10segundos
            $this->a = KitPvP::getInstance();
            KitPvP::getInstance()->getScheduler()->scheduleRepeatingTask(new SpeedAbility($this->a, $pl->getName()), 20);
            $pl->sendMessage("§l§aABILITY§f» §r§7Activaste la Abilidad §bSPEED §7de tu Kit §eFLASH");
          } else {
            if (time() < $this->speedCooldown[$pl->getName()]) {
              $expire = $this->speedCooldown[$pl->getName()] - time();
              $pl->sendMessage("§l§aABILITY§f» §r§7Podras usar tu habilidad nuevamente en: §6" . $expire . "§7segundos!");
            } else {
              unset($this->speedCooldown[$pl->getName()]);
              $pl->sendMessage("§l§aABILITY§f» §r§7Tu habilidad se a recargado aprieta denuevo para activar!");
            }
          }
        }
      }
    }
  }

  public function ActiveFlyAbility(PlayerInteractEvent $e) {
    $pl = $e->getPlayer();
    $name = $pl->getName();
    $item = $e->getItem();
    $config = KitPvP::getConfigs("Map");
    if ($config->get("world") != null) {
      if ($item->getCustomName() === "§l§6FLY ABILITY\n§8[CLICK]") {
        if ($pl->getLevel() === Server::getInstance()->getLevelByName($config->get("world"))) {
          if (!isset($this->flyCooldown[$pl->getName()])) {
            $this->flyCooldown[$pl->getName()] = time() + $this->flyTimer;
            $this->a = KitPvP::getInstance();
            KitPvP::getInstance()->getScheduler()->scheduleRepeatingTask(new FlyAbility($this->a, $pl->getName()), 20);
            $pl->sendMessage("§l§aABILITY§f» §r§7Activaste la Abilidad §aFLY §7de tu Kit §eEAGLE");
          } else {
            if (time() < $this->flyCooldown[$pl->getName()]) {
              $expire = $this->flyCooldown[$pl->getName()] - time();
              $pl->sendMessage("§l§aABILITY§f» §r§7Podras usar tu habilidad nuevamente en: §6" . $expire . "§7segundos!");
            } else {
              unset($this->flyCooldown[$pl->getName()]);
              $pl->sendMessage("§l§aABILITY§f» §r§7Tu habilidad se a recargado aprieta denuevo para activar!");
            }
          }
        }
      }
    }
  }
}
?>
