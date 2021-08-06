<?php

namespace KitPvP;

use pocketmine\ {
  Player,
  Server
};

use pocketmine\level\ {
  Level,
  Position
};

use pocketmine\command\Command;

use pocketmine\event\Listener;

use pocketmine\plugin\PluginBase;

use pocketmine\utils\Config;

use pocketmine\scheduler\Task;

use pocketmine\entity\Entity;

use KitPvP\APIs\Entity\Types\ {
  Human2,
  KillsTops
};

use KitPvP\APIs\Entity\EntityManager;

use KitPvP\APIs\FormAPI\FormUI;

use KitPvP\APIs\ {
  ScoreAPI,
  BossBar
};

use KitPvP\Commands\KitPvPCmd;

use KitPvP\Events\ {
  Exahust,
  Interact,
  KillSystem,
  NoBreak,
  NoPlace,
  SignChange,
  TapSign,
  TapSoup,
  DamageNpc,
};

use KitPvP\Kit\ {
  Abilidades,
  KitManager
};

use KitPvP\Scheduler\ {
  HumanScheduler,
  TopsScheduler,
  ScoreScheduler,
  BroadScheduler
};

use KitPvP\Sound;

use pocketmine\utils\TextFormat as Color;

/**
* Class KitPvP
* Extends PluginBase
*/
class KitPvP extends PluginBase {

  /** @var KitPvP $instance */
  private static $instance;

  /** @var ScoreAPI $scoreboard */
  private static $scoreboard;

  /** @var BossBar $bossbar */
  private static $bossbar;

  /** @var array $prefix */
  private static $prefix = "§6[KitPvP]";

  /**
  * @return void
  */
  function onEnable() : void {

    $logger = $this->getLogger();

    $this->loadMap();

    $this->loadCommand();

    $this->loadEvents();

    $this->loadNpc();

    $this->loadTask();
    
    $logger->info(Color::YELLOW . "=======================================");
    $logger->info(Color::GREEN . "New Configurable ScoreBoard in Config.yml");
    $logger->info(Color::RED . "New Configurable BossBar in Config.yml");
    $logger->info(Color::GREEN . "Resolved Bugs && Remove Score & Boss on Change Level!!!");
    $logger->info(Color::YELLOW . "=======================================");

    $this->saveResource("Kills.yml");
    $this->saveResource("Config.yml");
    
    @mkdir($this->getDataFolder());

    $logger->info("Please Wait...");
    
    $logger->notice("Utils Loaded Plugin Active!");

  }

  /**
  * @return void
  */
  function onLoad() : void {

    KitPvP::$instance = $this;

    KitPvP::$scoreboard = new ScoreAPI($this);

    KitPvP::$bossbar = new BossBar($this);

  }

  /**
  * @return KitPvP
  */
  static function getInstance() : KitPvP {

    return KitPvP::$instance;

  }

  /**
  * @return ScoreAPI
  */
  static function getScoreboard() : ScoreAPI {

    return KitPvP::$scoreboard;

  }

  /**
  * @return BossBar
  */
  static function getBossbar() : BossBar {

    return KitPvP::$bossbar;

  }

  /**
  * @param string $value
  */
  static function getConfigs(string $value) {

    return new Config(KitPvP::getInstance()->getDataFolder() . "{$value}.yml", Config::YAML);

  }
  
  /**
   * @return void
   */
  function loadMap() {

    $config = KitPvP::getConfigs("Map");

    if ($config->get("world")) {

    return $this->getServer()->loadLevel($config->get("world"));

    } else {

    return $this->getLogger()->alert(Color::RED . "MAPA NO ESTABLECIDO");

    }

  }

  /**
   * @return void
   */
  function loadCommand() : void {

    $this->getServer()->getCommandMap()->register("kitpvp", new KitPvPCmd($this));

  }

  /**
   * @return void
   */
  function loadEvents() : void {

    $this->getServer()->getPluginManager()->registerEvents(new Exahust($this), $this);
    $this->getServer()->getPluginManager()->registerEvents(new Interact($this), $this);
    $this->getServer()->getPluginManager()->registerEvents(new KillSystem($this), $this);
    $this->getServer()->getPluginManager()->registerEvents(new NoBreak($this), $this);
    $this->getServer()->getPluginManager()->registerEvents(new NoPlace($this), $this);
    $this->getServer()->getPluginManager()->registerEvents(new SignChange($this), $this);
    $this->getServer()->getPluginManager()->registerEvents(new Abilidades($this), $this);
    $this->getServer()->getPluginManager()->registerEvents(new TapSign($this), $this);
    $this->getServer()->getPluginManager()->registerEvents(new TapSoup($this), $this);
    $this->getServer()->getPluginManager()->registerEvents(new DamageNpc($this), $this);

  }

  /**
   * @return void
   */
  function loadNpc() : void {

    Entity::registerEntity(Human2::class, true);

    Entity::registerEntity(KillsTops::class, true);

  }

  /**
   * @return void
   */
  function loadTask() : void {

    $this->getScheduler()->scheduleRepeatingTask(new ScoreScheduler($this), 20);

    $this->getScheduler()->scheduleRepeatingTask(new TopsScheduler($this), 20);

    $this->getScheduler()->scheduleRepeatingTask(new HumanScheduler($this), 10);
    
    $this->getScheduler()->scheduleRepeatingTask(new BroadScheduler($this), 30 * 40);

  }

}
