<?php

namespace TGHP\$tghp:classCase$\Metaboxio\Metabox;

use TGHP\$tghp:classCase$\Abstract$tghp:classCase$;

abstract class AbstractMetabox extends Abstract$tghp:classCase$
{

    public function getStrippedTinymceConfig($extra = [])
    {
        return [
            'toolbar1' => 'bold,italic,link,' . ($extra['toolbar1'] ?? ''),
            'toolbar2' => $extra['toolbar2'] ?? '',
            'toolbar3' => $extra['toolbar3'] ?? '',
        ];
    }

}
