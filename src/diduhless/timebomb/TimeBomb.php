<?php

declare(strict_types=1);


namespace diduhless\timebomb;


use diduhless\timebomb\bomb\BombHeartbeat;
use diduhless\timebomb\bomb\BombListener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class TimeBomb extends PluginBase {
    use SingletonTrait;

    public function onLoad() {
        self::setInstance($this);
        $this->saveDefaultConfig();
    }

    public function onEnable() {
        Settings::initialize($this);

        $server = $this->getServer();
        $server->getPluginManager()->registerEvents(new BombListener(), $this);
        $server->getCommandMap()->register("timebomb", new TimeBombCommand());

        $this->getScheduler()->scheduleRepeatingTask(new BombHeartbeat(), 20);
    }

    public function onDisable() {
        Settings::save();
    }

}