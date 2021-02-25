<?php

declare(strict_types=1);


namespace diduhless\timebomb\bomb;


use diduhless\timebomb\Settings;
use pocketmine\block\Block;
use pocketmine\level\Explosion;
use pocketmine\level\Level;
use pocketmine\math\Vector3;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\IntTag;
use pocketmine\nbt\tag\StringTag;
use pocketmine\Player;
use pocketmine\tile\Chest;
use pocketmine\tile\Tile;
use pocketmine\utils\TextFormat;

class Bomb {

    /** @var Player */
    private $player;

    /** @var Chest */
    private $chest;

    /** @var int */
    private $time;

    public function __construct(Player $player) {
        $this->player = $player;
        $this->createBomb($player);
    }

    public function explode(): void {
        BombFactory::removeBomb($this);

        $this->chest->getLevel()->setBlock($this->chest, Block::get(Block::AIR));

        $explosion = new Explosion($this->chest, Settings::getRadius());
        $explosion->explodeA();
        $explosion->explodeB();
    }

    public function attemptToExplode(): void {
        if($this->getTimeElapsed() > Settings::getCooldown()) {
            $this->explode();
        } else {
            $this->updateName();
        }
    }

    private function updateName(): void {
        $this->chest->setName(
            $this->player->getName() . "'s Chest" . TextFormat::EOL .
            "Exploding in " . $this->getTimeRemaining() . " seconds"
        );
    }

    private function getTimeElapsed(): int {
        return time() - $this->time;
    }

    private function getTimeRemaining(): int {
        return Settings::getCooldown() - $this->getTimeElapsed();
    }

    private function createBomb(Player $player): void {
        $position = $player->getPosition();
        $level = $position->getLevel();

        /** @var Chest $first_tile */
        $first_tile = $this->createTile($level, $position);
        /** @var Chest $second_tile */
        $second_tile = $this->createTile($level, $position->add(1));

        $first_tile->pairWith($second_tile);
        $first_tile->getInventory()->setContents(array_merge(
            $player->getInventory()->getContents(),
            $player->getArmorInventory()->getContents()
        ));
        $first_tile->spawnToAll();
        $second_tile->spawnToAll();

        $chest_block = Block::get(Block::CHEST);
        $level->setBlock($position, $chest_block);
        $level->setBlock($position->add(1), $chest_block);

        $this->time = time();
        $this->chest = $first_tile;

        $this->updateName();
    }

    private function createTile(Level $level, Vector3 $vector): Tile {
        return Tile::createTile(Tile::CHEST, $level, new CompoundTag("", [
            new StringTag("id", Tile::CHEST),
            new IntTag("x", $vector->getFloorX()),
            new IntTag("y", $vector->getFloorY()),
            new IntTag("z", $vector->getFloorZ())
        ]));
    }

}