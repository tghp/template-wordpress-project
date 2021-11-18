<?php
// Define constants
define('TGHP_$tghp:upperCaseUnderscored$_THEME_NAME', '$tghp:lowerCaseHyphenated$-theme');
define('TGHP_$tghp:upperCaseUnderscored$_THEME_ABSPATH', dirname(__FILE__) . '/');

// Include the main $tghp:classCase$ class.
require_once TGHP_$tghp:upperCaseUnderscored$_THEME_ABSPATH . 'inc/$tghp:classCase$.php';

/**
 * Return $tghp:classCase$Theme instance
 *
 * @return \TGHP\$tghp:classCase$Theme\$tghp:classCase$
 */
function TGHP$tghp:classCase$Theme()
{
    return \TGHP\$tghp:classCase$Theme\$tghp:classCase$::instance();
}

TGHP$tghp:classCase$Theme();
