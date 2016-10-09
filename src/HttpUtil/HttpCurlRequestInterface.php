<?php

namespace Jabran\HttpUtil;

/**
 * Basic interface for a cURL class
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @license MIT License
 */
interface HttpCurlRequestInterface {

    /**
     * Set options for cURL request
     *
     * @param cURL constant $name
     * @param mixed $value
     */
    public function setOption($name, $value);

    /**
     * Set options for cURL request
     *
     * @param array $options
     */
    public function setOptions($options);

    /**
     * Execute a cURL request
     */
    public function execute();

    /**
     * Get cURL request info
     *
     * @param cURL constant $name
     */
    public function getInfo($name);

    /**
     * Get cURL status code
     */
    public function getStatusCode();

    /**
     * Get cURL error code
     *
     * @see https://curl.haxx.se/libcurl/c/libcurl-errors.html
     */
    public function getErrorCode();

    /**
     * Get cURL response
     */
    public function getResponse();

    /**
     * Close a cURL connection
     */
    public function close();
}

