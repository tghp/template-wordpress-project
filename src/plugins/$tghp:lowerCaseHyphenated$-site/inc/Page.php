<?php

namespace TGHP\$tghp:classCase$;

class Page extends Abstract$tghp:classCase$
{

    /**
     * @param string $templateName
     * @return WP_Post|null
     */
    public function getPageWithTemplate(string $templateName)
    {
        $pageQuery = new \WP_Query([
            'post_type' => 'page',
            'meta_key' => '_wp_page_template',
            'meta_value' => $templateName,
            'posts_per_page' => 1
        ]);

        if ($pageQuery->have_posts()) {
            return $pageQuery->posts[0];
        }

        return null;
    }

    public function getHomePage()
    {
        return $this->getPageWithTemplate('template-home.php');
    }

}