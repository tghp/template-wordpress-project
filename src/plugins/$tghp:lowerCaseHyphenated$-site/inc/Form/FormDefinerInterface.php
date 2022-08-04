<?php

namespace TGHP\$tghp:classCase$\Form;

interface FormDefinerInterface
{

    /**
     * @return string
     */
    public function getName();

    /**
     * @return array
     */
    public function define();

}