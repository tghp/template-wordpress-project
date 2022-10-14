<?php

namespace TGHP\$tghp:classCase$;

class ThemeSupports extends Abstract$tghp:classCase$
{

    /**
     * Asset constructor.
     *
     * @param $$tghp:camelCase$ $tghp:classCase$
     */
    public function __construct($tghp:classCase$ $$tghp:camelCase$)
    {
        parent::__construct($$tghp:camelCase$);

        add_action('after_setup_theme', [$this, 'addThemeSupports']);
    }

    /**
     * Add WordPress menus
     *
     * @return void
     */
    public function addThemeSupports()
    {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
    }

}