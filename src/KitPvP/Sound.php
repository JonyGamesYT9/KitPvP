<?php

namespace KitPvP;

use pocketmine\Player;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;

class Sound {
  
   public function getSound($player, string $sound): void {
		$pk = new PlaySoundPacket();
		$pk->x = $player->x;
		$pk->y = $player->y;
		$pk->z = $player->z;
		$pk->soundName = $sound;
		$pk->volume = 5;
		$pk->pitch = 1;
		$player->dataPacket($pk);
	}
}
