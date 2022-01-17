<?php

namespace TGHP\$tghp:classCase$;

use TGHP\$tghp:classCase$\Metabox\MetaboxDefinerInterface;
use TGHP\$tghp:classCase$\Metabox\MetaboxPreparerInterface;

class Metabox extends AbstractDefinesMetabox
{

    /**
     * Metabox constructor.
     *
     * @param $$tghp:camelCase$ $tghp:classCase$
     */
    public function __construct($tghp:classCase$ $$tghp:camelCase$)
    {
        parent::__construct($$tghp:camelCase$);

        add_filter('mb_aio_extensions', [$this, 'enableExtensions'], 10, 1);
        add_filter('mb_aio_show_settings', '__return_false');
        add_action('rwmb_enqueue_scripts', [$this, 'addAdminStyles']);
    }

    /**
     * Create definers
     *
     * @return array
     */
    public function _getDefiners()
    {
        return [];
    }

    /**
     * Get metabox prefix
     *
     * @return string
     */
    public static function getPrefix(): string
    {
        return constant('TGHP_$tghp:upperCaseUnderscored$_PLUGIN_METABOX_PREFIX');
    }

    /**
     * Generate metabox key
     *
     * @param $key
     * @return string
     */
    public static function generateKey(string $key): string
    {
        return self::getPrefix(). $key;
    }

    /**
     * Generate metabox key if it looks like it hasn't already been generated
     *
     * @param $key
     * @return string
     */
    public static function maybeGenerateKey($key)
    {
        if (!preg_match('/^' . self::getPrefix() . '/', $key)) {
            return self::generateKey($key);
        }

        return $key;
    }

    /**
     * Remove metabox prefix from key or array of keys
     *
     * @param array|string $fields
     * @param string $prefix
     * @return array
     */
    public static function removePrefixFromKey($fields): array
    {
        $returnFirst = false;

        if(!is_array($fields)) {
            $returnFirst = true;
        }

        $updatedFields = [];

        if (!empty($fields)) {
            if ($returnFirst) {
                return str_replace(self::getPrefix(), '', $fields);
            } else {
                foreach ($fields as $key => $field) {
                    if (is_array($field)) {
                        $updatedFields[$key] = self::removePrefixFromKey($field);
                    } else {
                        $updatedFields[str_replace(self::getPrefix(), '', $key)] = $field;
                    }
                }
            }
        }

        return $updatedFields;
    }

    /**
     * Enable required metabox extensions
     *
     * @param array $extensions
     * @return array
     */
    public function enableExtensions(array $extensions): array
    {
        $extensions = [
            'meta-box-include-exclude',
            'meta-box-conditional-logic',
            'meta-box-tabs',
            'meta-box-show-hide',
            'meta-box-group',
            'mb-settings-page',
            'mb-blocks',
            'mb-revision',
            'mb-frontend-submission',
            'mb-term-meta',
            'mb-user-meta'
        ];

        return $extensions;
    }

    /**
     * Add admin styles
     */
    public function addAdminStyles()
    {
        if (is_admin()) {
            wp_enqueue_style(
                'meta-box-style',
                $tghp:classCase$::getPluginUrl() . '/assets/src/css/metabox.css',
                [],
                filemtime($tghp:classCase$::getPluginPath() . '/assets/src/css/metabox.css')
            );
        }
    }

    /**
     * Get single metafield value
     *
     * @param string $field_id
     * @param array $args
     * @param null $postId
     * @return mixed
     */
    public function getSingleMetafieldValue(string $field_id, array $args = [], $postId = null)
    {
        return rwmb_meta($field_id, $args, $postId);
    }

    /**
     * Get multiple metafield values
     *
     * @param array $field_ids
     * @param array $args
     * @param null $postId
     * @return array
     */
    public function getMultipleMetafieldValues(array $fieldIds, array $args = [], $postId = null)
    {
        $values = [];

        foreach ($field_ids as $field) {
            $key = $field;
            $value = rwmb_meta(self::maybeGenerateKey($key), $args, $postId);
            $values[$key] = !empty($value) ? $value : false;
        }

        return array_filter($values);
    }

    /**
     * Get single metafield value from options page
     *
     * @param string $field_id
     * @return mixed
     */
    public function getSingleMetafieldValueFromOptions(string $fieldId)
    {
        return rwmb_meta(
            $fieldId,
            ['object_type' => 'setting'],
            'site_options'
        );
    }

    /**
     * Get multiple metafield values from options page
     *
     * @param array $field_ids
     * @return mixed
     */
    public function getMultipleMetafieldValueFromOptions(array $fieldIds)
    {
        return $this->getMultipleMetafieldValues(
            $fieldIds,
            ['object_type' => 'setting'],
            'site_options'
        );
    }
}
