<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
<meta charset="<?php bloginfo('charset') ?>" />
<meta name="viewport" content="width=device-width" />
<?php wp_head(); ?>
<?= TGHPSite()->asset->outputCriticalCss() ?>
<?= TGHPSite()->asset->outputDeferedNonCriticalCss() ?>
<?= TGHPSite()->dev->outputHmrLoad() ?>
</head>
<body <?php body_class() ?>>
    <header class="site-header">
        <a href="<?php echo esc_url(home_url('/')) ?>" title="<?php echo esc_html(get_bloginfo('name')) ?>" rel="home" class="site-header__logo">
            <?= TGHPSite()->asset->outputAsset('images/logo.svg') ?>
        </a>

        <nav class="site-header__nav">
            <?php
            wp_nav_menu([
                'theme_location' => 'header-nav',
                'container' => false,
                'menu_class' => 'site-nav'
            ]);
            ?>
        </nav>
    </header>
