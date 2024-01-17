<?php

namespace TGHP\$tghp:classCase$\Metaboxio;

use TGHP\$tghp:classCase$\$tghp:classCase$;
use TGHP\$tghp:classCase$\AbstractDefines;
use TGHP\$tghp:classCase$\Metaboxio\Form\FormAfterSubmissionProcessorInterface;
use TGHP\$tghp:classCase$\Metaboxio\Form\FormDefinerInterface;

class Form extends AbstractDefines
{

    /**
     * Form constructor.
     *
     * @param $tghp:classCase$ $$tghp:camelCase$
     */
    public function __construct($tghp:classCase$ $$tghp:camelCase$)
    {
        parent::__construct($$tghp:camelCase$);
        add_filter('tghpcontact_forms', [$this, 'addForms']);
    }

    /**
     * Create definers
     *
     * @return array
     */
    public function _getDefiners()
    {
        return [
            // Definer classes here
        ];
    }

    /**
     * Implementation definer for forms
     * @param DefinerInterface $definer
     */
    protected function _processDefiner(DefinerInterface $definer)
    {
        if ( !($definer instanceof FormDefinerInterface) ) {
            return;
        }

        /** @var FormDefinerInterface $definer */
        return $definer->define();
    }

    /**
     * Actually add forms that come from our definers
     *
     * @param $forms
     * @return array
     */
    public function addForms($forms)
    {
        foreach ($this->getDefiners() as $_definer) {
            /** @var FormDefinerInterface $_definer */
            $name = $_definer->getName();
            $forms[$name] = $_definer->define();

            if ($_definer instanceof FormAfterSubmissionProcessorInterface) {
                add_action("tghpcontact_after_process_{$name}", [$_definer, 'afterProcess']);
            }
        }

        return $forms;
    }

}