<?php

namespace TGHP\$tghp:classCase$\Api;

interface ApiDefinerInterface
{

    /**
     * @return string
     */
    public function getRoute();

    /**
     * @return string
     */
    public function getType();

    /**
     * @param \WP_REST_Request $data
     * @return int|string|array|\WP_REST_Response
     */
    public function handle($data);

}