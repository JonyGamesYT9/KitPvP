<?php

namespace KitPvP\APIs\Entity;

use KitPvP\KitPvP;
use KitPvP\APIs\Entity\Types\{Human2, KillsTops};
use pocketmine\utils\Config;
use pocketmine\level\Position;
use pocketmine\{Server, Player, utils\TextFormat, level\Level, entity\Skin, entity\Entity, math\Vector3};

class EntityManager {
  
    function setNpc(Player $player){
    $nbt = Entity::createBaseNBT(new Vector3((float)$player->getX(), (float)$player->getY(), (float)$player->getZ()));
		$nbt->setTag($player->namedtag->getCompoundTag('Skin'));
		$human = new Human2($player->getLevel(), $nbt);
		$human->setNameTag('');
		$human->setNameTagVisible(true);
		$human->setNameTagAlwaysVisible(true);
		$human->yaw = $player->getYaw();
		$human->pitch = $player->getPitch();
		$human->spawnToAll();
	}
   
    function setTop(Player $player){
    $nbt = Entity::createBaseNBT(new Vector3((float)$player->getX(), (float)$player->getY(), (float)$player->getZ()));
		$nbt->setTag($player->namedtag->getCompoundTag('Skin'));
		$human = new KillsTops($player->getLevel(), $nbt);
		$human->setNameTag('');
		$human->setNameTagVisible(true);
		$human->setNameTagAlwaysVisible(true);
		$human->yaw = $player->getYaw();
		$human->pitch = $player->getPitch();
		$human->spawnToAll();
	}
}
