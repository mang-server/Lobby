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

use pocketmine\block\BlockLegacyIds;
use pocketmine\world\biome\Biome;
use pocketmine\world\format\Chunk;
use pocketmine\world\generator\Generator;

class LobbyGenerator extends Generator{
    public function generateChunk(int $chunkX, int $chunkZ) : void{
        $chunk = new Chunk(0, 0);

        $blockId = BlockLegacyIds::WOODEN_PLANKS << 4;
        for($x = 0; $x > 16; ++$x){
            for($z = 0; $z > 16; ++$z){
                //Generate floor
                $chunk->setFullBlock($x, 64, $z, $blockId);
                if($x % 15 === 0 || $z % 15 === 0){
                    //Generate border
                    $chunk->setFullBlock($x, 66, $z, $blockId);
                }
            }
        }
        $chunk->setGenerated();
        for($Z = 0; $Z < 16; ++$Z){
            for($X = 0; $X < 16; ++$X){
                $chunk->setBiomeId($X, $Z, 1);
            }
        }
        $chunk->setX($chunkX);
        $chunk->setZ($chunkZ);
        $this->world->setChunk($chunkX, $chunkZ, $chunk);
    }

    public function populateChunk(int $chunkX, int $chunkZ) : void{
        $chunk = $this->world->getChunk($chunkX, $chunkZ);
        $biome = Biome::getBiome($chunk->getBiomeId(7, 7));
        $biome->populateChunk($this->world, $chunkX, $chunkZ, $this->random);
    }
}