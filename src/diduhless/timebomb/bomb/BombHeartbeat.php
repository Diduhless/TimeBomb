<?php
/*
 * Copyright (C) Diduhless - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

declare(strict_types=1);


namespace diduhless\timebomb\bomb;


use pocketmine\scheduler\Task;

class BombHeartbeat extends Task {

    public function onRun(int $currentTick) {
        foreach(BombFactory::getBombs() as $bomb) {
            $bomb->attemptToExplode();
        }
    }

}