<?php

declare(strict_types=1);


namespace diduhless\timebomb\bomb;


use pocketmine\Player;

class BombFactory {

    /** @var Bomb[] */
    static private $bombs = [];

    /**
     * @return Bomb[]
     */
    public static function getBombs(): array {
        return self::$bombs;
    }

    static public function spawnBomb(Player $player): void {
        self::$bombs[] = new Bomb($player);
    }

    static public function removeBomb(Bomb $bomb): void {
        unset(self::$bombs[array_search($bomb, self::$bombs)]);
    }

}