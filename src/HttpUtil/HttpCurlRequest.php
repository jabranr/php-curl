<?php

namespace Jabran\HttpUtil;

use Jabran\HttpUtil\HttpCurlRequestInterface;
use Jabran\HttpUtil\Exception\HttpCurlException;

/**
 * Execute cURL operations with ease
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @license MIT License
 */
class HttpCurlRequest implements HttpCurlRequestInterface {

    /**
     * @var resource
     */
    private $handle;

    /**
     * Initiate a cURL request with URI
     *
     * @uses curl_init
     * @param string $uri
     * @return Jabran\HttpUtil\HttpCurlRequest
     */
    public function __construct($uri = '') {
        $this->handle = curl_init($uri);
        return $this;
    }

    /**
     * Set a cURL option
     *
     * @uses curl_setopt
     * @param string $name
     * @param string $value
     * @return Jabran\HttpUtil\HttpCurlRequest
     */
    public function setOption($name, $value) {
        curl_setopt($this->handle, $name, $value);
        return $this;
    }

    /**
     * Set cURL options
     *
     * @uses curl_setopt_array
     * @param array $options
     * @return Jabran\HttpUtil\HttpCurlRequest
     */
    public function setOptions($options) {
        curl_setopt_array($this->handle, $options);
        return $this;
    }

    /**
     * Execute a cURL request
     *
     * @uses curl_exec
     * @throws Jabran\HttpUtil\Exception\HttpCurlException
     * @return mixed
     */
    public function execute() {
        $response = curl_exec($this->handle);

        if (CURLE_OK !== $this->getErrorCode()) {
            throw new HttpCurlException(
                sprintf('An error (%d) occured while executing the cURL request.', $this->getErrorCode())
            );
        }

        $this->response = $response;
        return $this->response;
    }

    /**
     * Get cURL request info
     *
     * @uses curl_getinfo
     * @param cURL constant $name
     * @return mixed|array
     */
    public function getInfo($name = null) {
        if (! $name) {
            return curl_getinfo($this->handle);
        }

        return curl_getinfo($this->handle, $name);
    }

    /**
     * Get cURL request error
     *
     * @uses curl_error
     * @return string
     */
    public function getError() {
        return curl_error($this->handle);
    }

    /**
     * Get cURL request error code
     *
     * @uses curl_errno
     * @return cURL constant
     */
    public function getErrorCode() {
        return curl_errno($this->handle);
    }

    /**
     * Get cURL request HTTP status code
     *
     * @uses curl_getinfo
     * @return int
     */
    public function getStatusCode() {
        return $this->getInfo(CURLINFO_HTTP_CODE);
    }

    /**
     * Get total time taken by cURL request
     *
     * @uses curl_getinfo
     * @return float
     */
    public function getRequestTime() {
        return $this->getInfo(CURLINFO_TOTAL_TIME);
    }

    /**
     * Get raw response from cURL request
     *
     * @return mixed
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * Close a cURL request
     *
     * @uses curl_close
     * @return Jabran\HttpUtil\HttpCurlRequest
     */
    public function close() {
        curl_close($this->handle);
        return $this;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getHandle() {
       return $this->handle;
    }
}

