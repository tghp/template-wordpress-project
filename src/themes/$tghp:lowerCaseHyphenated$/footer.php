    <footer class="site-footer">
        <nav class="site-footer__nav">
            <?php
            wp_nav_menu([
                'theme_location' => 'footer-nav',
                'container' => false,
                'menu_class' => 'site-nav'
            ]);
            ?>
        </nav>

        <div class="site-footer__copyright">
            <?= sprintf('&copy; %s %s', date('Y'), get_bloginfo('name')) ?>
        </div>
    </footer>
<?php wp_footer() ?>
</body>
</html>
