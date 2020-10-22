<?php

/*
 *
 *  ____                           _   _  ___
 * |  _ \ _ __ ___  ___  ___ _ __ | |_| |/ (_)_ __ ___
 * | |_) | '__/ _ \/ __|/ _ \ '_ \| __| ' /| | '_ ` _ \
 * |  __/| | |  __/\__ \  __/ | | | |_| . \| | | | | | |
 * |_|   |_|  \___||___/\___|_| |_|\__|_|\_\_|_| |_| |_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the MIT License.
 *
 * @author  PresentKim
 * @link    https://github.com/PresentKim
 * @license https://www.gnu.org/licenses/mit MIT License
 *
 *   (\ /)
 *  ( . .) ♥
 *  c(")(")
 */

declare(strict_types=1);

namespace kim\present\mangserver\lobby\world;

use pocketmine\math\Vector3;
use pocketmine\Server;
use pocketmine\world\World;

final class LobbyWorldManager{
    private string $worldName;

    private World $world;

    public function __construct(string $worldName){
        $this->worldName = $worldName;
        $this->world = $this->generateWorld();
    }

    private function generateWorld() : World{
        $worldManager = Server::getInstance()->getWorldManager();
        $worldManager->generateWorld($this->worldName, null, LobbyGenerator::class);
        $worldManager->loadWorld($this->worldName);
        $world = $worldManager->getWorldByName($this->worldName);
        if($world === null)
            throw new \RuntimeException("Lobby world loading failed");

        $world->setTime(World::TIME_MIDNIGHT);
        $world->stopTime();
        $world->setSpawnLocation(new Vector3(7, 65, 7));

        $worldManager->setDefaultWorld($world);
        return $world;
    }

    public function getWorldName() : string{
        return $this->worldName;
    }

    public function getWorld() : World{
        return $this->world;
    }
}