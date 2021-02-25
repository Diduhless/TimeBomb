<?php
/*
 * Copyright (C) Diduhless - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

declare(strict_types=1);


namespace diduhless\timebomb;


use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\Player;
use pocketmine\plugin\Plugin;

class TimeBombCommand extends Command implements PluginIdentifiableCommand {

    public function __construct() {
        $this->setPermission(Settings::getPermission());
        parent::__construct("timebomb", "Edit the timebomb settings");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if($sender instanceof Player and $this->testPermission($sender)) {
            $sender->sendForm(new TimeBombForm());
        }
    }

    public function getPlugin(): Plugin {
        return TimeBomb::getInstance();
    }

}