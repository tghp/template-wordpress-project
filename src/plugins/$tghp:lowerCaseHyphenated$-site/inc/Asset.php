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

    /**
     * Get possible CSS non-critical filenames
     *
     * @return string[]
     */
    public function getCssFileSearchNames()
    {
        $files = ['main'];

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

        return $files;
    }

    /**
     * Get possible critical CSS filenames
     *
     * @return string[]
     */
    public function getCssCriticalFileSearchNames()
    {
        return array_map(function ($filename) {
            if ($filename === 'main') {
                return 'critical';
            } else {
                return "critical--{$filename}";
            }
        }, $this->getCssFileSearchNames());
    }

    /**
     * Output all critical CSS
     *
     * @return string
     */
    public function outputCriticalCss()
    {
        if (defined('VITE_HMR')) {
            return '';
        }

        $css = '';
        $usedFiles = [];

        foreach ($this->getCssCriticalFileSearchNames() as $criticalFile) {
            if ($criticalCss = $this->outputAsset("dist/{$criticalFile}.css")) {
                $usedFiles[] = $criticalFile;
                $css .= $criticalCss;
            }
        }

        return sprintf(
            '<!-- %s --><style type="text/css">%s</style>',
            implode(',', $usedFiles),
            $css
        );
    }

    /**
     * Output all non-critical CSS
     *
     * @return string
     */
    public function outputDeferedNonCriticalCss()
    {
        if (defined('VITE_HMR')) {
            return '';
        }

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