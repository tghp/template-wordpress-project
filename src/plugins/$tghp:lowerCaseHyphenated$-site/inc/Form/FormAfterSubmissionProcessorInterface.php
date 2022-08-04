<?php

namespace TGHP\$tghp:classCase$\Form;

interface FormAfterSubmissionProcessorInterface
{

    /**
     * @return void
     */
    public function afterProcess($postId);

}