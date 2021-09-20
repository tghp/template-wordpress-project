<?php

namespace TGHP\$tghp:classCase$;

use TGHP\$tghp:classCase$\Metabox\MetaboxDefinerInterface;
use TGHP\$tghp:classCase$\Metabox\MetaboxPreparerInterface;

abstract class AbstractDefinesMetabox extends AbstractDefines
{

    /**
     * @var array
     */
    protected $metaboxes;

    /**
     * @param $tghp:classCase$ $$tghp:camelCase$
     */
    public function __construct($tghp:classCase$ $$tghp:camelCase$)
    {
        parent::__construct($$tghp:camelCase$);

        // Add hooks that will interact with the sub-classes
        add_filter('init', [$this, 'prepareMetaboxes'], 5);
        add_filter('rwmb_meta_boxes', [$this, 'addMetaboxes']);
    }

    /**
     * Implementation definer for metaboxes
     * @param DefinerInterface $definer
     */
    protected function _processDefiner(DefinerInterface $definer)
    {
        if ( !($definer instanceof MetaboxDefinerInterface) ) {
            return;
        }

        /** @var MetaboxDefinerInterface $definer */
        return $definer->define();
    }

    /**
     * Run through any prepare processes
     *
     * @return void
     */
    public function prepareMetaboxes(): void
    {
        foreach ($this->getDefiners() as $definer) {
            if ($definer instanceof MetaboxPreparerInterface) {
                $definer->prepare();
            }
        }
    }

    /**
     * Actually add metaboxes that come from our definers
     *
     * @param $metaBoxes
     * @return array
     */
    public function addMetaboxes($metaBoxes)
    {
        foreach ($this->definerResults as $definedMetaboxes) {
            $metaBoxes = array_merge(
                $metaBoxes,
                $definedMetaboxes
            );
        }

        return $metaBoxes;
    }
}