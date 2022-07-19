<?php

namespace TGHP\$tghp:classCase$;

use TGHP\$tghp:classCase$\Metabox\MetaboxDefinerInterface;
use TGHP\$tghp:classCase$\Metabox\MetaboxPreparerInterface;

class Admin extends AbstractDefinesMetabox
{

    /**
     * Metabox constructor.
     *
     * @param $$tghp:camelCase$ $tghp:classCase$
     */
    public function __construct($tghp:classCase$ $$tghp:camelCase$)
    {
        parent::__construct($$tghp:camelCase$);

        add_action('admin_enqueue_scripts', [$this, 'addAdminStyles']);
    }

    /**
     * Add admin styles
     */
    public function addAdminStyles()
    {
        if (is_admin()) {
            wp_enqueue_style(
                'admin-style',
                $tghp:classCase$::getPluginUrl() . '/assets/src/css/admin.css',
                [],
                filemtime($tghp:classCase$::getPluginPath() . '/assets/src/css/admin.css')
            );
        }
    }

}
