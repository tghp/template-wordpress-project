<?php

namespace TGHP\$tghp:classCase$\Blocks;

use TGHP\$tghp:classCase$\Abstract$tghp:classCase$;
use TGHP\$tghp:classCase$\$tghp:classCase$;
use TGHP\$tghp:classCase$\Metabox\MetaboxDefinerInterface;

abstract class AbstractBlock extends Abstract$tghp:classCase$ implements BlockDefinerInterface, MetaboxDefinerInterface
{

    /**
     * Get the block code, use as it's main identifier in code, derived from the class name:
     * e.g. ExampleBlock -> example-block
     *
     * @return string
     * @throws ReflectionException
     */
    public function getCode(): string
    {
        $code = (new \ReflectionClass($this))->getShortName();
        $code = trim(
            strtolower(
                preg_replace('/([A-Z])/', '-$1', $code)
            ),
            '-'
        );
        return $code;
    }

    /**
     * Get an internal WP ID for the block
     * @return string
     */
    public function getId(): string
    {
        return "tghp-{$this->getCode()}-block";
    }

    /**
     * Render out the block, using the template: /templates/blocks/{code}/template.php
     * @return void
     */
    public function render(): void
    {
        $template = sprintf(
            '%s/templates/blocks/%s/template.php',
            TGHP_$tghp:upperCaseUnderscored$_PLUGIN_PATH,
            $this->getCode()
        );

        if (file_exists($template)) {
            $block = $this;
            require $template;
        }
    }

    /**
     * Enqueue styles for the blocks, for admin preview only
     *
     * @return object
     */
    public function enqueueAdminBlockAssets(): object
    {
        return function () {
            if (is_admin()) {
                wp_enqueue_style(
                    "block--{$this->getCode()}",
                    sprintf('%s/assets/dist/css/block--%s.css', get_template_directory_uri(), $this->getCode()),
                    [],
                    filemtime(sprintf('%s/assets/dist/css/block--%s.css', get_template_directory(), $this->getCode()))
                );
            }
        };
    }

}