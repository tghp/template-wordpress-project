<?php

namespace TGHP\$tghp:classCase$;

use TGHP\$tghp:classCase$\Blocks\BlockDefinerInterface;
use TGHP\$tghp:classCase$\Blocks\CaseStudySingle;

class Blocks extends AbstractDefinesMetabox
{

    /**
     * Blocks constructor.
     *
     * @param $tghp:classCase$ $$tghp:camelCase$
     */
    public function __construct($tghp:classCase$ $$tghp:camelCase$)
    {
        parent::__construct($$tghp:camelCase$);
        add_filter('block_categories_all', [$this, 'addGutenbergBlockCategories'], 10, 2);
        add_filter('allowed_block_types_all', [$this, 'setAllowedBlockTypes'], 10, 2);
    }

    protected function _getDefiners()
    {
        return [];
    }

    /**
     * Add additional gutenberg block categories
     *
     * @param $categories
     * @param $post
     * @return array
     */
    public function addGutenbergBlockCategories($categories, $post): array
    {
        return array_merge(
            [
                [
                    'slug' => '$tghp:lowerCaseHyphenated$-blocks',
                    'title' => __('$tghp:classCase$ Blocks', $tghp:classCase$::getTextDomain()),
                ],
            ],
            $categories
        );
    }

    /**
     * Control the allowed block types
     *
     * @param bool|string[] $allowedBlockTypes
     * @param \WP_Block_Editor_Context $context
     * @return string[]
     */
    public function setAllowedBlockTypes($allowedBlockTypes, $context): array
    {
        $definedBlocks = array_map(function ($block) {
            return "meta-box/{$block->getId()}";
        }, $this->_getDefiners());

        return [
            ...$definedBlocks,
            // Maybe also some of those
//            'core/image',
//            'core/paragraph',
//            'core/heading',
//            'core/list',
//            'core/embed',
        ];
    }

}
