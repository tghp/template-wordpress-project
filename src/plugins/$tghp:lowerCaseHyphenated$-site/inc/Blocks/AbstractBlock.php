<?php

namespace TGHP\$tghp:classCase$\Blocks;

use TGHP\$tghp:classCase$\Abstract$tghp:classCase$;
use TGHP\$tghp:classCase$\$tghp:classCase$;
use TGHP\$tghp:classCase$\Metabox\MetaboxDefinerInterface;

abstract class AbstractBlock extends Abstract$tghp:classCase$ implements BlockDefinerInterface, MetaboxDefinerInterface
{

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

    public function getId(): string
    {
        return "tghp-{$this->getCode()}-block";
    }

    public function render(): void
    {
        $template = sprintf(
            '%s/blocks/%s/template.php',
            TGHP_$tghp:upperCaseUnderscored$_PLUGIN_PATH,
            $this->getCode()
        );

        if (file_exists($template)) {
            $block = $this;
            require $template;
        }
    }

}