<?php

namespace VsrStudio\EconomyLandScore\Provider;

use onebone\economyland\EconomyLand;
use pocketmine\player\Player;

class LandProvider {

    private EconomyLand $economyLand;
    private array $landCache = [];

    public function __construct(EconomyLand $economyLand) {
        $this->economyLand = $economyLand;
    }

    public function updateLandCache(Player $player): void {
        $position = $player->getPosition();
        $land = $this->economyLand->getLandProvider()->getLand($position);

        $this->landCache[$player->getName()] = $land ? $land->getName() : null;
    }

    public function getCachedLandName(Player $player): ?string {
        return $this->landCache[$player->getName()] ?? null;
    }
}
