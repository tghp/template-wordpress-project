<?php

namespace TGHP\$tghp:classCase$;

use PHPHtmlParser\Dom;
use PHPHtmlParser\Dom\Node\AbstractNode;

class Util extends Abstract$tghp:classCase$
{

    public function removeFiltersWithMethodName($hookName = '', $methodName = '', $priority = 0)
    {
        global $wp_filter;

        // Take only filters on right hook name and priority
        if (!isset($wp_filter[$hookName][$priority]) || !is_array($wp_filter[$hookName][$priority])) {
            return false;
        }

        // Loop on filters registered
        foreach ((array) $wp_filter[$hookName][$priority] as $unique_id => $filter_array) {
            // Test if filter is an array ! (always for class/method)
            if (isset($filter_array['function']) && is_array($filter_array['function'])) {
                // Test if object is a class and method is equal to param !
                if (is_object($filter_array['function'][0]) && get_class($filter_array['function'][0]) && $filter_array['function'][1] == $methodName) {
                    // Test for WordPress >= 4.7 WP_Hook class (https://make.wordpress.org/core/2016/09/08/wp_hook-next-generation-actions-and-filters/)
                    if (is_a($wp_filter[$hookName], 'WP_Hook')) {
                        unset($wp_filter[$hookName]->callbacks[$priority][$unique_id]);
                    } else {
                        unset($wp_filter[$hookName][$priority][$unique_id]);
                    }
                }
            }
        }

        return false;
    }

    public function formatPathForEnvironments($path)
    {
        if (isset($_SERVER['KINSTA_CACHE_ZONE']) || isset($_SERVER['HTTP_X_KINSTA_EDGE_INCOMINGIP'])) {
            $kinstaPathPattern = '#/www/[^/]*/releases/[^/]*/#';
            if (preg_match($kinstaPathPattern, $path)) {
                $path = preg_replace('#/www/[^/]*/releases/[^/]*/#', '', $path);
            }
        }

        return $path;
    }

    public function getAttachmentSizesSrcset($attachment_id, $sizes)
    {
        $attachmentMeta = wp_get_attachment_metadata($attachment_id);
        $image = wp_get_attachment_image_src($attachment_id, 'full');

        if(!is_array($attachmentMeta) || !is_array($image)) {
            return false;
        }

        $imageSrc = $image[0];

        // Retrieve the uploads sub-directory from the full size image.
        $dirname = _wp_get_attachment_relative_path($attachmentMeta['file']);

        if ($dirname) {
            $dirname = trailingslashit($dirname);
        }

        $upload_dir    = wp_get_upload_dir();
        $image_baseurl = trailingslashit($upload_dir['baseurl']) . $dirname;

        /*
         * Images that have been edited in WordPress after being uploaded will
         * contain a unique hash. Look for that hash and use it later to filter
         * out images that are leftovers from previous versions.
         */
        $image_edited = preg_match( '/-e[0-9]{13}/', wp_basename($imageSrc), $image_edit_hash );

        // Array to hold URL candidates.
        $sources = array();

        foreach ($sizes as $_size) {
            if (isset($attachmentMeta['sizes'][$_size]) && is_array($attachmentMeta['sizes'][$_size])) {
                $sizeImage = $attachmentMeta['sizes'][$_size];

                // Filter out images that are from previous edits.
                if ($image_edited && !strpos($sizeImage['file'], $image_edit_hash[0])) {
                    continue;
                }

                // Add the URL, descriptor, and value to the sources array to be returned.
                $sources[$sizeImage['width']] = [
                    'url' => $image_baseurl . $sizeImage['file'],
                    'descriptor' => 'w',
                    'value' => $sizeImage['width'],
                ];
            }
        }


        // Only return a 'srcset' value if there is more than one source.
        if (!is_array($sources) || count($sources) < 2) {
            return false;
        }

        $srcset = '';

        foreach ($sources as $_source) {
            $srcset .= str_replace(' ', '%20', $_source['url']) . ' ' . $_source['value'] . $_source['descriptor'] . ', ';
        }

        return rtrim($srcset, ', ');
    }

}