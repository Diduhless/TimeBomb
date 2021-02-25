<?php
/*
 * Copyright (C) Diduhless - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

declare(strict_types=1);


namespace diduhless\timebomb;


use pocketmine\utils\Config;

class Settings {

    /** @var Config */
    static private $config;

    /** @var bool */
    static private $enabled;

    /** @var int */
    static private $cooldown;

    /** @var int */
    static private $radius;

    /** @var string */
    static private $permission;

    static public function initialize(TimeBomb $plugin): void {
        $config = $plugin->getConfig();

        self::$config = $config;
        self::$enabled = $config->get("enable");
        self::$cooldown = $config->get("bomb.cooldown");
        self::$radius = $config->get("bomb.radius");
        self::$permission = $config->get("edit.permission");
    }

    static public function save(): void {
        self::$config->set("enable", self::$enabled);
        self::$config->set("bomb.cooldown", self::$cooldown);
        self::$config->set("bomb.radius", self::$radius);
    }

    static public function isEnabled(): bool {
        return self::$enabled;
    }

    static public function setEnabled(bool $enabled): void {
        self::$enabled = $enabled;
    }

    static public function getCooldown(): int {
        return self::$cooldown;
    }

    static public function setCooldown(int $cooldown): void {
        self::$cooldown = $cooldown;
    }

    static public function getRadius(): int {
        return self::$radius;
    }

    static public function setRadius(int $radius): void {
        self::$radius = $radius;
    }

    static public function getPermission(): string {
        return self::$permission;
    }

}