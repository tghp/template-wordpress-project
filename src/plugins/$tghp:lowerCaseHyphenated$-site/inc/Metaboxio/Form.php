<?php

namespace TGHP\$tghp:classCase$\Metaboxio;

use TGHP\$tghp:classCase$\$tghp:classCase$;
use TGHP\$tghp:classCase$\AbstractDefines;
use TGHP\$tghp:classCase$\DefinerInterface;
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

        return [
            'form_name' => $definer->getName(),
            ...$definer->define(),
        ];
    }

    /**
     * Actually add forms that come from our definers
     *
     * @param $forms
     * @return array
     */
    public function addForms($forms)
    {
        foreach ($this->definerResults as $definerResult) {
            $name = $definerResult['form_name'];
            /** @var FormDefinerInterface $definerResult */
            $forms[$name] = $definerResult;

            if ($definerResult instanceof FormAfterSubmissionProcessorInterface) {
                add_action("tghpcontact_after_process_{$name}", [$definerResult, 'afterProcess']);
            }
        }

        return $forms;
    }

}
