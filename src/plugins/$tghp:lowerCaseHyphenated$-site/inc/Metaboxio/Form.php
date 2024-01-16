<?php

namespace TGHP\$tghp:classCase$\Metaboxio;

use TGHP\$tghp:classCase$\$tghp:classCase$;
use TGHP\$tghp:classCase$\Metaboxio\Form\FormAfterSubmissionProcessorInterface;
use TGHP\$tghp:classCase$\Metaboxio\Form\FormDefinerInterface;

class Form
{

    protected $definers = [];

    /**
     * Form constructor.
     *
     * @param $tghp:classCase$ $$tghp:camelCase$
     */
    public function __construct()
    {
        add_filter('tghpcontact_forms', [$this, 'addForms']);
    }

    /**
     * Create definers
     *
     * @return array
     */
    public function getDefiners()
    {
        if (!$this->definers) {
            $this->definers = [];
        }

        return $this->definers;
    }

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