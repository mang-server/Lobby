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

namespace kim\present\mangserver\lobby;

use kim\present\generator\void\VoidGenerator;
use pocketmine\Server;
use pocketmine\utils\SingletonTrait;

class LobbyManager{
    use SingletonTrait;
    public const LOBBY_WORLD = "lobby";

    public function __construct(){
        $this->init();
    }

    public function init(){
        $worldManager = Server::getInstance()->getWorldManager();
        $worldManager->generateWorld(self::LOBBY_WORLD, null, VoidGenerator::class, [], true);

        $lobbyWorld = $worldManager->getWorldByName(self::LOBBY_WORLD);
        $worldManager->setDefaultWorld($lobbyWorld);
    }
}