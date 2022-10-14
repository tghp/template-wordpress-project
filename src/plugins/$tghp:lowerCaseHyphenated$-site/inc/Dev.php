<?php

namespace TGHP\$tghp:classCase$;

class Dev extends Abstract$tghp:classCase$
{

    /**
     * Storage for HMR enqueued scripts
     * @var array
     */
    protected $enqueuedScripts = [];

    /**
     * Enqueue a script that will go via Vite using HMR
     *
     * @param $urlPath
     * @return void
     */
    public function enqueueScript($urlPath)
    {
        $this->enqueuedScripts[] = $urlPath;
    }

    /**
     * @return string
     */
    public function outputHmrLoad()
    {
        ob_start();

        if (defined('VITE_HMR') && defined('VITE_PORT')) {
            $viteConfig = file_get_contents(__DIR__ . '/../../../../vite.config.mts');

            if ($viteConfig) {
                $usesReact = preg_match('/[\'"]?react[\'"]?:\s*?true/', $viteConfig);


                $cssSearchFiles = $this->$tghp:camelCase$->asset->getCssFileSearchNames();
                $cssCriticalSearchFiles = $this->$tghp:camelCase$->asset->getCssCriticalFileSearchNames();
                $allCssSearchFiles = [
                    ...$cssSearchFiles,
                    ...$cssCriticalSearchFiles,
                ];

                $cssCritical = [];
                $cssNonCritical = [];

                foreach ($allCssSearchFiles as $cssSearchFile) {
                    if ($filename = $this->$tghp:camelCase$->asset->locate("src/sass/{$cssSearchFile}.scss")) {
                        if (preg_match('#(themes/.+\.scss)#', $filename, $match)) {
                            $cssInfo = [
                                'filename' => basename($filename),
                                'path' => $filename,
                                'url' => "src/{$match[1]}",
                            ];

                            if (in_array($cssSearchFile, $cssSearchFiles)) {
                                $cssNonCritical[] = $cssInfo;
                            } else {
                                $cssCritical[] = $cssInfo;
                            }
                        }
                    }
                }

                $enqueuedScripts = $this->enqueuedScripts;

                include_once sprintf(
                    '%s/templates/dev/hmr.php',
                    TGHP_$tghp:upperCaseUnderscored$_PLUGIN_PATH
                );
            }
        }

        $contents = ob_get_clean();

        if ($contents) {
            return $contents;
        } else {
            return '';
        }
    }

}