<?php

namespace TGHP\$tghp:classCase$;

class Asset extends AbstractInheritingThemeFile
{

    /**
     * Store any found results in a basic cache
     *
     * @var array
     */
    protected $cache = [];

    public function getSearchSubPath($locationType)
    {
        return 'assets';
    }

    public function outputAsset($path, $base64 = false)
    {
        $path = apply_filters('tghp_posttype_asset_output_path', $path);

        if (isset($this->cache[$path])) {
            return $this->cache[$path];
        }

        if ($path = $this->locate($path)) {
            $path = $this->$tghp:camelCase$->util->formatPathForEnvironments($path);
            $assetContents = file_get_contents($path);

            $filetype = mime_content_type($path);

            if ($filetype === 'image/svg') {
                $filetype = 'image/svg+xml';
            }

            if ($base64) {
                $assetContents = sprintf(
                    'data:%s;base64,%s',
                    $filetype,
                    base64_encode($assetContents)
                );
            }

            $this->cache[$path] = $assetContents;

            return $assetContents;
        }

        return '';
    }

    public function outputCriticalCss()
    {
        $files = ['main'];
        $css = '';
        $usedFiles = [];

        if (is_singular()) {
            $postType = get_post_type();
            $files[] = "single-{$postType}";
        }

        if (is_singular('page')) {
            $files[] = 'page';

            $template = basename(get_page_template());

            if ($template) {
                $files[] = str_replace('.php', '', $template);
            }
        } else if (is_archive()) {
            $term = get_queried_object();
            $files[] = "archive-{$term->taxonomy}";
        } else if (is_search()) {
            $files[] = 'search';
        }

        foreach ($files as $criticalFile) {
            if ($criticalFile === 'main') {
                $cssFile = 'critical';
            } else {
                $cssFile = "critical--{$criticalFile}";
            }

            if ($criticalCss = $this->outputAsset("dist/{$cssFile}.css")) {
                $usedFiles[] = $cssFile;
                $css .= $criticalCss;
            }
        }

        return sprintf(
            '<!-- %s --><style type="text/css">%s</style>',
            implode(',', $usedFiles),
            $css
        );
    }

    public function outputDeferedNonCriticalCss()
    {
        $cssUrl = get_stylesheet_directory_uri() . '/assets/dist/main.css';
        $cssTimestamp = filemtime(get_stylesheet_directory() . '/assets/dist/main.css');

        return sprintf(
            implode('', [
                '<link rel="preload" href="%1$s?version=%2$s" as="style">',
                '<link rel="stylesheet" href="%1$s?version=%2$s" media="print" onload="this.media=\'all\'; this.onload=null;">'
            ]),
            $cssUrl,
            $cssTimestamp
        );
    }

}