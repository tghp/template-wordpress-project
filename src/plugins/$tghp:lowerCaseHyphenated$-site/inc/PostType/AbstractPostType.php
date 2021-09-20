<?php

namespace TGHP\$tghp:classCase$\PostType;

use TGHP\$tghp:classCase$\Abstract$tghp:classCase$;
use TGHP\$tghp:classCase$\$tghp:classCase$;

abstract class AbstractPostType extends Abstract$tghp:classCase$ implements PostTypeDefinerInterface
{
    /**
     * Post type code
     *
     * @var null|string
     */
    protected $postTypeCode = null;

    /**
     * Disable gutenberg for this post type
     *
     * @var bool
     */
    protected $disableGutenberg = false;

    /**
     * AbstractPostType constructor.
     *
     * @param $tghp:classCase$ $$tghp:camelCase$
     * @throws \Exception
     */
    public function __construct($tghp:classCase$ $$tghp:camelCase$)
    {
        parent::__construct($$tghp:camelCase$);

        // Ensure a post type code is set in child classes
        if (empty($this->postTypeCode)) {
            throw new \Exception(__('Must define post type code.', $tghp:classCase$::getTextDomain()));
        }
    }

    /**
     * Get post type code
     *
     * @return string
     */
    public function getPostTypeCode(): string
    {
        return $this->postTypeCode;
    }

}
