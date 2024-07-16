<?php

namespace TGHP\$tghp:classCase$\Metaboxio\Form;

user TGHP\$tghp:classCase$\DefinerInterface;

interface FormDefinerInterface extends DefinerInterface
{

    /**
     * @return string
     */
    public function getName();

    /**
     * @return array
     */
    public function define(): array;

}
