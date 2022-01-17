<?php

namespace TGHP\$tghp:classCase$\Taxonomy;

use TGHP\$tghp:classCase$\Abstract$tghp:classCase$;
use TGHP\$tghp:classCase$\$tghp:classCase$;

abstract class AbstractTaxonomy extends Abstract$tghp:classCase$ implements TaxonomyDefinerInterface
{
    /**
     * Taxonomy code
     *
     * @var null|string
     */
    protected $taxonomyCode = null;

    /**
     * Disable gutenberg for this taxonomy
     *
     * @var bool
     */
    protected $disableGutenberg = false;

    /**
     * Post type for the taxonomy
     *
     * @var null|string
     */
    protected $postTypeCode = null;

    /**
     * AbstractTaxonomy constructor.
     *
     * @param $tghp:classCase$ $$tghp:camelCase$
     * @throws \Exception
     */
    public function __construct($tghp:classCase$ $$tghp:camelCase$)
    {
        parent::__construct($$tghp:camelCase$);

        // Ensure a taxonomy code is set in child classes
        if (empty($this->getTaxonomyCode())) {
            throw new \Exception(__('Must define taxonomy code.', $tghp:classCase$::getTextDomain()));
        }
    }

    /**
     * Get taxonomy code
     *
     * @return string
     */
    public function getTaxonomyCode(): string
    {
        return $this->taxonomyCode;
    }

    /**
     * Get associated post type code
     *
     * @return string
     */
    public function getAssociatedPostTypeCode(): string
    {
        return $this->postTypeCode;
    }

}
