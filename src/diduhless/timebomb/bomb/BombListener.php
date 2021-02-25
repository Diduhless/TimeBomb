<?php
/*
 * Copyright (C) Diduhless - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

declare(strict_types=1);


namespace diduhless\timebomb\bomb;


use diduhless\timebomb\Settings;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;

class BombListener implements Listener {

    public function onDeath(PlayerDeathEvent $event): void {
        if(Settings::isEnabled()) {
            BombFactory::spawnBomb($event->getPlayer());
            $event->setDrops([]);
        }
    }

}