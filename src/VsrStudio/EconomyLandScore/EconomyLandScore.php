<?php

namespace VsrStudio\EconomyLandScore;

use Ifera\ScoreHud\event\TagsResolveEvent;
use Ifera\ScoreHud\scoreboard\ScoreTag;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use VsrStudio\EconomyLandScore\Provider\LandProvider;
use VsrStudio\EconomyLandScore\Task\UpdateLandTask;

class EconomyLandScore extends PluginBase implements Listener {

    private LandProvider $landProvider;

    protected function onEnable(): void {
        $economyLand = $this->getServer()->getPluginManager()->getPlugin("EconomyLand");
        if ($economyLand === null || !$economyLand->isEnabled()) {
            $this->getLogger()->error("EconomyLand plugin tidak ditemukan. Plugin dinonaktifkan.");
            $this->getServer()->getPluginManager()->disablePlugin($this);
            return;
        }

        $scoreHud = $this->getServer()->getPluginManager()->getPlugin("ScoreHud");
        if ($scoreHud === null || !$scoreHud->isEnabled()) {
            $this->getLogger()->error("ScoreHud plugin tidak ditemukan. Plugin dinonaktifkan.");
            $this->getServer()->getPluginManager()->disablePlugin($this);
            return;
        }

        $this->landProvider = new LandProvider($economyLand);
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getScheduler()->scheduleRepeatingTask(new UpdateLandTask($this), 20 * 5);
    }

    public function onTagsResolve(TagsResolveEvent $event): void {
        $player = $event->getPlayer();
        $tag = $event->getTag();

        if ($tag->getName() === "economyland.score") {
            $landName = $this->landProvider->getCachedLandName($player);
            $event->setTag(new ScoreTag("economyland.score", $landName ?? "Tidak ada land"));
        }
    }

    public function getLandProvider(): LandProvider {
        return $this->landProvider;
    }
}
