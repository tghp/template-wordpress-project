<?php

namespace TGHP\$tghp:classCase$\Blocks;

use TGHP\$tghp:classCase$\DefinerInterface;

interface BlockDefinerInterface extends DefinerInterface
{
    /**
     * Get block code
     *
     * @return string
     */
    public function getCode(): string;

    /**
     * Get block id
     *
     * @return string
     */
    public function getId(): string;

    /**
     * Get block template
     *
     * @return void
     */
    public function render(): void;

}
