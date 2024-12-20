<?php

namespace VsrStudio\EconomyLandScore\Task;

use pocketmine\scheduler\Task;
use pocketmine\player\Player;
use VsrStudio\EconomyLandScore\EconomyLandScore;

class UpdateLandTask extends Task {

    private EconomyLandScore $plugin;

    public function __construct(EconomyLandScore $plugin) {
        $this->plugin = $plugin;
    }

    public function onRun(): void {
        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {
            $this->plugin->getLandProvider()->updateLandCache($player);
        }
    }
}
