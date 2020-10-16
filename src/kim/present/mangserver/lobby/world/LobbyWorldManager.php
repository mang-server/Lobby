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

use kim\present\generator\void\VoidGenerator;
use pocketmine\Server;
use pocketmine\world\Position;
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
        $worldManager->generateWorld($this->worldName, null, VoidGenerator::class, [], true);
        $world = $worldManager->getWorldByName($this->worldName);
        if($world === null)
            throw new \RuntimeException("Lobby world loading failed");

        $worldManager->setDefaultWorld($this->world);
        return $world;
    }

    public function getWorld() : World{
        return $this->world;
    }
}