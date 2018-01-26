<?php

namespace Jabran\HttpUtil;

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
     * @var mixed
     */
    private $response;

    /**
     * HttpCurlRequest constructor
     * Initiate a cURL request with URI
     *
     * @param string $uri
     */
    public function __construct($uri = '') {
        $this->handle = curl_init($uri);
        return $this;
    }

    /**
     * Set a cURL option
     *
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function setOption($name, $value) {
        curl_setopt($this->handle, $name, $value);
        return $this;
    }

    /**
     * Set cURL options
     *
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options) {
        curl_setopt_array($this->handle, $options);
        return $this;
    }

    /**
     * Execute a cURL request
     *
     * @return mixed
     */
    public function execute() {
        $response = curl_exec($this->handle);

        if (CURLE_OK !== $this->getErrorCode()) {
            $this->close();
            throw new HttpCurlException(
                sprintf('An error (%d) occured while executing the cURL request.', $this->getErrorCode())
            );
        }

        $this->close();
        $this->response = $response;
        return $this->response;
    }

    /**
     * Get cURL request info
     *
     * @param mixed $name
     * @return mixed
     */
    public function getInfo($name = null) {
        if (!$name) {
            return curl_getinfo($this->handle);
        }

        return curl_getinfo($this->handle, $name);
    }

    /**
     * Get cURL request error
     *
     * @return string
     */
    public function getError() {
        return curl_error($this->handle);
    }

    /**
     * Get cURL request error code
     *
     * @return int
     */
    public function getErrorCode() {
        return curl_errno($this->handle);
    }

    /**
     * Get cURL request HTTP status code
     *
     * @return mixed
     */
    public function getStatusCode() {
        return $this->getInfo(CURLINFO_HTTP_CODE);
    }

    /**
     * Get total time taken by cURL request
     *
     * @return mixed
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
     * @return $this
     */
    public function close() {
        curl_close($this->handle);
        return $this;
    }

    /**
     * Get resource handle
     *
     * @return resource
     */
    public function getHandle() {
        return $this->handle;
    }
}

