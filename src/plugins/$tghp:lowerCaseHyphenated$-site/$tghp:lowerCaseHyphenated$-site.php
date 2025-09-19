<?php
/**
 * Plugin Name: TGHP $tghp:classCase$
 * Description: Main plugin for $tghp:classCase$ theme setup
 * Version:     1.0.0
 * Author:      TGHP
 */

// Define constants
define('TGHP_$tghp:upperCaseUnderscored$_PLUGIN_VERSION', '1.0.0');
define('TGHP_$tghp:upperCaseUnderscored$_PLUGIN_NAME', '$tghp:lowerCaseHyphenated$-site');
define('TGHP_$tghp:upperCaseUnderscored$_PLUGIN_METABOX_PREFIX', '_tghp$tghp:lowerCaseJoined$_');
define('TGHP_$tghp:upperCaseUnderscored$_PLUGIN_PATH', dirname(__FILE__));
define('TGHP_$tghp:upperCaseUnderscored$_PLUGIN_URL', untrailingslashit(plugins_url('/', __FILE__)));

// Prevent loading this file directly
if (!defined('ABSPATH')) {
    die();
}

// Abort plugin loading if WordPress is upgrading
if (defined('WP_INSTALLING') && WP_INSTALLING) {
    return;
}

// Init plugin
require TGHP_$tghp:upperCaseUnderscored$_PLUGIN_PATH . '/inc/$tghp:classCase$.php';

/**
 * Return $tghp:classCase$ instance
 *
 * @deprecated Prefer TGHPSite() function
 * @return \TGHP\$tghp:classCase$\$tghp:classCase$
 */
function TGHP$tghp:classCase$()
{
    $theme = wp_get_theme();

    if ($theme && ($theme->get_template() == '$tghp:lowerCaseHyphenated$' || $theme->get_stylesheet() == '$tghp:lowerCaseHyphenated$')) {
        return \TGHP\$tghp:classCase$\$tghp:classCase$::instance();
    }
}

/**
 * Alias for TGHP$tghp:classCase$ function above
 *
 * @return  \TGHP\$tghp:classCase$\$tghp:classCase$
 */
function TGHPSite()
{
    return TGHP$tghp:classCase$();
}

/**
 * @return \TGHP\$tghp:classCase$\Metaboxio\Metabox
 */
function TGHPSiteMetabox()
{
    return TGHPSite()->metabox;
}

if (!function_exists('_S')) {
    /**
     * Short alias for TGHPSite() function
     *
     * @return \TGHP\$tghp:classCase$\$tghp:classCase$
     */
    function _S()
    {
        return TGHPSite();
    }
}

if (!function_exists('_MB')) {
    /**
     * Short alias for TGHPSiteMetabox() function
     *
     * @return \TGHP\$tghp:classCase$\Metaboxio\Metabox
     */
    function _MB()
    {
        return TGHPSiteMetabox();
    }
}

TGHP$tghp:classCase$();
