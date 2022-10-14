<?php

namespace TGHP\$tghp:classCase$;

class Enqueues extends Abstract$tghp:classCase$
{

    /**
     * Asset constructor.
     *
     * @param $$tghp:camelCase$ $tghp:classCase$
     */
    public function __construct($tghp:classCase$ $$tghp:camelCase$)
    {
        parent::__construct($$tghp:camelCase$);

        add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);
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