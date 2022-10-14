<?php

namespace TGHP\$tghp:classCase$Theme;

class Theme extends Abstract$tghp:classCase$
{
    /**
     * Theme constructor.
     *
     * @param $$tghp:camelCase$
     */
    public function __construct($$tghp:camelCase$)
    {
        parent::__construct($$tghp:camelCase$);
        add_action('after_setup_theme', [$this, 'setup']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);
        add_action('init', [$this, 'addImageSizes']);
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('admin_print_styles', 'print_emoji_styles');
    }

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    public function setup()
    {
        /**
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /**
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        /**
         * This theme uses wp_nav_menu() in one location.
         */
        register_nav_menus([
            'header-nav' => esc_html__('Main navigation', \TGHP\$tghp:classCase$Theme\$tghp:classCase$::getTextDomain()),
            'footer-nav' => esc_html__('Footer navigation', \TGHP\$tghp:classCase$Theme\$tghp:classCase$::getTextDomain()),
        ]);
    }

    /**
     * Enqueue scripts for the theme, using the internal _enqueueScript method so that they can be collected for HMR
     *
     * @return void
     */
    public function enqueueScripts()
    {
        $this->_enqueueScript(
            'main',
            get_stylesheet_directory_uri() . '/assets/src/js/main.ts',
            get_stylesheet_directory_uri() . '/assets/dist/main.js',
            get_stylesheet_directory() . '/assets/dist/main.js'
        );
    }

    /**
     * Enqueue script, either using wp_enqueue_script or providing the script to the HMR system if it is enabled
     *
     * @param $handle
     * @param $src
     * @param $filePath
     * @return void
     */
    protected function _enqueueScript($handle, $developmentSrc, $productionSrc, $productionFilePath)
    {
        if (defined('VITE_HMR')) {
            $baseUrl = preg_replace('#/wp/?$#', '', home_url());
            $developmentSrc = str_replace($baseUrl, '', $developmentSrc);
            $developmentSrc = preg_replace('#^/?wp-content#', 'src', $developmentSrc);

            TGHPSite()->dev->enqueueScript($developmentSrc);
        } else {
            wp_enqueue_script(
                $handle,
                $productionSrc,
                [],
                $productionFilePath
            );
        }
    }



}
