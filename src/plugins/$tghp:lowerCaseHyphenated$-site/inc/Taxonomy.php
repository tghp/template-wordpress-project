<?php

namespace TGHP\$tghp:classCase$;

use TGHP\$tghp:classCase$\Taxonomy\TaxonomyDefinerInterface;
use TGHP\$tghp:classCase$\Taxonomy\Team;

class Taxonomy extends AbstractDefines
{

    /**
     * @var array
     */
    protected $taxonomy;

    public function __construct($tghp:classCase$ $$tghp:camelCase$)
    {
        parent::__construct($$tghp:camelCase$);

        add_action('init', [$this, 'addTaxonomies']);
    }

    protected function _getDefiners()
    {
        return [];
    }

    protected function _processDefiner(DefinerInterface $definer)
    {
        return $definer;
    }

    /**
     * Actually add taxonomies that come from our definers
     *
     * @param $taxonomy
     * @return array
     */
    public function addTaxonomies($taxonomy)
    {
        foreach ($this->definerResults as $definer) {
            if ($definer instanceof TaxonomyDefinerInterface) {
                register_taxonomy(
                    $definer->getTaxonomyCode(),
                    array( $definer->getAssociatedPostTypeCode() ),
                    $definer->define()
                );
            }
        }
    }

}
