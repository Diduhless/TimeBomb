<?php
/*
 * Copyright (C) Diduhless - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

declare(strict_types=1);


namespace diduhless\timebomb;


use EasyUI\element\Input;
use EasyUI\element\Toggle;
use EasyUI\utils\FormResponse;
use EasyUI\variant\CustomForm;
use pocketmine\Player;

class TimeBombForm extends CustomForm {

    public function __construct() {
        parent::__construct("TimeBomb Settings");
    }

    public function onCreation(): void {
        $this->addElement("enable", new Toggle("Enable the plugin", Settings::isEnabled()));
        $this->addElement("cooldown", new Input("Bomb cooldown", (string) Settings::getCooldown()));
        $this->addElement("radius", new Input("Bomb radius", (string) Settings::getRadius()));
    }

    protected function onSubmit(Player $player, FormResponse $response): void {
        Settings::setEnabled($response->getToggleSubmittedChoice("enable"));
        Settings::setCooldown((int) $response->getInputSubmittedText("cooldown"));
        Settings::setRadius((int) $response->getInputSubmittedText("radius"));
    }

}