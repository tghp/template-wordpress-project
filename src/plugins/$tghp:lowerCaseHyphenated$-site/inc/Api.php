<?php

namespace TGHP\$tghp:classCase$;

use TGHP\$tghp:classCase$\Api\ApiDefinerInterface;

class Api extends Abstract$tghp:classCase$
{

    protected $definers = [];

    /**
     * Metabox constructor.
     *
     * @param $$tghp:camelCase$ $tghp:classCase$
     */
    public function __construct($tghp:classCase$ $$tghp:camelCase$)
    {
        parent::__construct($$tghp:camelCase$);

        $this->addApis();
    }

    public function getDefiners()
    {
        if (!$this->definers) {
            $this->definers = [];
        }

        return $this->definers;
    }

    public function addApis()
    {
        $definers = $this->getDefiners();

        add_action('rest_api_init', function () use ($definers) {
            foreach ($definers as $_definer) {
                /** @var ApiDefinerInterface $_definer */

                register_rest_route('$tghp:lowerCaseHyphenated$/v1', $_definer->getRoute(), [
                    'methods' => $_definer->getType(),
                    'callback' => [$_definer, 'handle'],
                ]);
            }
        });
    }

}