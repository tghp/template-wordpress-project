<?php
/*
Plugin Name: WP Miscellaneous Scripts
Description: Add marketing scripts to your site
Version: 0.1
Author: Josh Davenport
Author URI: http://www.joshdavenport.co.uk/
*/

/**
 * Add the settings field
 */
$wpmiscscripts_settings = new WPMiscScripts_Settings();
class WPMiscScripts_Settings {
    function __construct() {
        add_filter( 'admin_init' , array( &$this , 'register_fields' ));
    }

    function register_fields() {
        register_setting( 'general', 'misc_scripts', 'esc_attr' );
        add_settings_field('misc_scripts', '<label for="misc_scripts">'.__('Miscellaneous Scripts' , 'misc_scripts' ).'</label>' , array(&$this, 'fields_html') , 'general' );
    }

    function fields_html() {
        $value = get_option( 'misc_scripts', '' );
        echo '<textarea id="misc_scripts" name="misc_scripts" rows="15" cols="50" class="large-text code">' . $value . '</textarea>';
    }
}

/**
 * Output the scripts in the frontend footer
 */
function wpmisscripts_output() {
    if($miscscripts = get_option('misc_scripts', '')): ?>
        <?php echo html_entity_decode($miscscripts, ENT_QUOTES) ?>
    <?php
    endif;
}
add_action('wp_footer', 'wpmisscripts_output', 9999);