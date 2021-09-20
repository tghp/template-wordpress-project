<?php

namespace TGHP\$tghp:classCase$\Taxonomy;

use TGHP\$tghp:classCase$\DefinerInterface;

interface TaxonomyDefinerInterface extends DefinerInterface
{

    /**
     * Return the taxonomy code
     *
     * @return string
     */
    public function getTaxonomyCode(): string;

    /**
     * Return the associated post type code
     *
     * @return string
     */
    public function getAssociatedPostTypeCode(): string;

}
