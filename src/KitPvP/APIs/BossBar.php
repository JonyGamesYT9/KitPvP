<?php

namespace KitPvP\APIs;

use pocketmine\Player;
use pocketmine\entity\Attribute;
use pocketmine\entity\Entity;
use pocketmine\entity\EntityIds;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\AddActorPacket;
use pocketmine\network\mcpe\protocol\BossEventPacket;
use pocketmine\network\mcpe\protocol\RemoveActorPacket;

class BossBar {

    /** @var int $bossId */
    private static $bossId;

    /** @var array $bossbars */
    private static $bossbars = [];

    /**
     * @param Player $sender
     * @param string $text
     */
    public static function set(Player $sender, string $text): void {
        if (self::hasBoss($sender)) {
            if (self::$bossbars[$sender->getName()] == $text) {
                return;
            }

            self::unset($sender);
        }

        self::$bossbars[$sender->getName()] = $text;
        $pk = new AddActorPacket();
        $pk->type = AddActorPacket::LEGACY_ID_MAP_BC[EntityIds::CREEPER];
        $pk->entityUniqueId  = self::getBossId();
        $pk->entityRuntimeId = self::getBossId();
        $pk->position = new Vector3($sender->getX(), -10, $sender->getZ());
        $pk->motion = new Vector3();
        $pk->attributes[] = Attribute::getAttribute(Attribute::HEALTH)->setMaxValue(100)->setValue(100);
        $pk->metadata = [
            Entity::DATA_FLAGS => [Entity::DATA_TYPE_LONG, 0],
            Entity::DATA_AIR => [Entity::DATA_TYPE_SHORT, 400],
            Entity::DATA_MAX_AIR => [Entity::DATA_TYPE_SHORT, 400],
            Entity::DATA_LEAD_HOLDER_EID => [Entity::DATA_TYPE_LONG, -1],
            Entity::DATA_NAMETAG => [Entity::DATA_TYPE_STRING, $text],
            Entity::DATA_SCALE => [Entity::DATA_TYPE_FLOAT, 0]
        ];
        $sender->sendDataPacket($pk);
        $pk = new BossEventPacket();
        $pk->bossEid = self::getBossId();
        $pk->eventType = BossEventPacket::TYPE_SHOW;
        $pk->title = $text;
        $pk->healthPercent = 1;
        $pk->color = 0;
        $pk->overlay = 0;
        $sender->sendDataPacket($pk);
    }

    /**
     * @param Player $sender
     */
    public static function unset(Player $sender): void {
        $pk = new RemoveActorPacket();
        $pk->entityUniqueId = self::getBossId();
        $sender->sendDataPacket($pk);
        $pk = new BossEventPacket();
        $pk->bossEid = self::getBossId();
        $pk->eventType = BossEventPacket::TYPE_HIDE;
        $sender->sendDataPacket($pk);

        if (isset(self::$bossbars[$sender->getName()])) {
            unset(self::$bossbars[$sender->getName()]);
        }
    }

    /**
     * @return int
     */
    private static function getBossId(): int {
        if(self::$bossId === null) {
            self::$bossId = Entity::$entityCount++;
        }

        return self::$bossId;
    }

    /**
     * @param Player $sender
     * @return bool
     */
    public static function hasBoss(Player $sender): bool {
        return isset(self::$bossbars[$sender->getName()]);
    }
}
