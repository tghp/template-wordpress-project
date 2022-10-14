<?php

namespace TGHP\$tghp:classCase$;

class Menu extends Abstract$tghp:classCase$
{

    /**
     * Asset constructor.
     *
     * @param $$tghp:camelCase$ $tghp:classCase$
     */
    public function __construct($tghp:classCase$ $$tghp:camelCase$)
    {
        parent::__construct($$tghp:camelCase$);

        add_action('after_setup_theme', [$this, 'addMenus']);
    }

    /**
     * Add WordPress menus
     *
     * @return void
     */
    public function addMenus()
    {
        register_nav_menus([
            'header-nav' => esc_html__('Main navigation', $tghp:classCase$::getTextDomain()),
            'footer-nav' => esc_html__('Footer navigation', $tghp:classCase$::getTextDomain()),
        ]);
    }

}