<?php

namespace TGHP\$tghp:classCase$\PostType;

use TGHP\$tghp:classCase$\DefinerInterface;

interface PostTypeDefinerInterface extends DefinerInterface
{

    /**
     * Return the post type code
     *
     * @return string
     */
    public function getPostTypeCode(): string;

}
