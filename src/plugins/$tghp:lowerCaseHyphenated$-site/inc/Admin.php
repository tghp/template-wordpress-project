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

        add_action('admin_init', [$this, 'preventUpdateChecks']);
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

    /**
     * @return void
     */
    public function preventUpdateChecks()
    {
        if (!isset($_SERVER['APP_ENV']) || $_SERVER['APP_ENV'] !== 'local') {
            /*
             * Disable Theme Updates
             */
            remove_action('load-update-core.php', 'wp_update_themes');
            wp_clear_scheduled_hook('wp_update_themes');

            /*
             * Disable Plugin Updates
             */
            remove_action('load-update-core.php', 'wp_update_plugins');
            wp_clear_scheduled_hook('wp_update_plugins');

            /*
             * Disable Core Updates
             */
            wp_clear_scheduled_hook('wp_version_check');
            remove_action('wp_maybe_auto_update', 'wp_maybe_auto_update');
            remove_action('admin_init', 'wp_maybe_auto_update');
            remove_action('admin_init', 'wp_auto_update_core');
            wp_clear_scheduled_hook('wp_maybe_auto_update');

            /**
             * Disable yoast pings
             */
            add_filter('wpseo_allow_xml_sitemap_ping', '__return_false');
        }
    }

}
