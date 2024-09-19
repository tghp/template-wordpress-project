<?php

namespace TGHP\$tghp:classCase$;

class Admin extends Abstract$tghp:classCase$
{

    /**
     * Metabox constructor.
     *
     * @param $$tghp:camelCase$ $tghp:classCase$
     */
    public function __construct($tghp:classCase$ $$tghp:camelCase$)
    {
        parent::__construct($$tghp:camelCase$);

        add_action('admin_init', [$this, 'preventWpApiCallsAndChecks']);
        add_action('admin_enqueue_scripts', [$this, 'addAdminStyles']);
//        add_action('admin_init', [$this, 'controlEditor']);
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
     * Control when the editor displays
     *
     * @return void
     */
    public function controlEditor()
    {
        global $pagenow;

        if (isset($_GET['post']) && $pagenow !== 'post-new.php') {
            $template = get_post_meta($_GET['post'], '_wp_page_template', true);

            if ($template && $template !== 'default') {
                $remove = true;
            }
        } else {
            $remove = true;
        }

        if (isset($remove) && $remove) {
            remove_post_type_support('page', 'editor');
        }
    }

    /**
     * @return void
     */
    public function preventMetaboxUpdateChecks()
    {
        add_action('admin_enqueue_scripts', function () {
            wp_dequeue_script('mb-notification');
        }, 100);

        add_action('admin_head', function () {
            echo '<style>#meta-box-notification { display: none !important; }</style>';
        });

        $this->$tghp:camelCase$->util->removeFiltersWithMethodName('init', 'enable_update', 1);
    }

    /**
     * @return void
     */
    public function preventWpApiCallsAndChecks()
    {
        if (!defined(WP_ENV) || WP_ENV !== 'local') {
            /*
             * Disable general calls (e.g. api.wordpress.org/block-patterns/)
             */
            add_filter( 'pre_http_request', function ($preempt, $parsedargs, $url) {
                if (preg_match('#api\.wordpress\.org#', $url)) {
                    return true;
                }

                return false;
            }, 10, 3);

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
