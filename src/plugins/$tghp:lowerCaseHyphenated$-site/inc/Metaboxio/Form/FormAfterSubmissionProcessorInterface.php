<?php

namespace TGHP\$tghp:classCase$\Metaboxio\Form;

interface FormAfterSubmissionProcessorInterface
{

    /**
     * @return void
     */
    public function afterProcess($postId);

}