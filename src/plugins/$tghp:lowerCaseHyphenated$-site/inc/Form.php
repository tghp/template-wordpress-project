<?php

namespace TGHP\$tghp:classCase$;

use TGHP\$tghp:classCase$\Form\Contact;
use TGHP\$tghp:classCase$\Form\FormAfterSubmissionProcessorInterface;
use TGHP\$tghp:classCase$\Form\FormDefinerInterface;
use TGHP\$tghp:classCase$\Form\Newsletter;

class Form
{

    protected $definers = [];

    public function __construct()
    {
        add_filter('tghpcontact_forms', [$this, 'addForms']);
    }

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