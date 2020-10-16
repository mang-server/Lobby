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

use kim\present\mangserver\lobby\world\LobbyWorldManager;
use pocketmine\utils\SingletonTrait;

final class Lobby{
    use SingletonTrait;

    public const LOBBY_WORLD = "lobby";

    private LobbyWorldManager $worldManager;

    public function __construct(){
        $this->init();
    }

    public function init(){
        $this->worldManager = new LobbyWorldManager(self::LOBBY_WORLD);
    }

    public function getWorldManager() : LobbyWorldManager{
        return $this->worldManager;
    }
}