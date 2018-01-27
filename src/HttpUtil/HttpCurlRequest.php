<?php

namespace Jabran\HttpUtil;

use Jabran\HttpUtil\Exception\HttpCurlException;

/**
 * Execute cURL operations with ease
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @license MIT
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
     * @var int
     */
    private $httpCode;

    /**
     * @var int
     */
    private $totalTime;

    /**
     * @var int
     */
    private $errorCode;

    /**
     * @var string
     */
    private $errorMessage;

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
     * @param $name
     * @param mixed $value
     *
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
     *
     * @return $this
     */
    public function setOptions($options) {
        curl_setopt_array($this->handle, $options);
        return $this;
    }

    /**
     * Execute a cURL request
     *
     * @param bool $close
     *
     * @return mixed
     */
    public function execute($close = true) {
        $this->response = curl_exec($this->handle);
        $this->httpCode = $this->getInfo(CURLINFO_HTTP_CODE);
        $this->totalTime = $this->getInfo(CURLINFO_TOTAL_TIME);
        $this->errorCode = curl_errno($this->handle);
        $this->errorMessage = curl_error($this->handle);

        if ($close) {
            $this->close();
        }

        if (CURLE_OK !== $this->errorCode) {
            throw new HttpCurlException(
                sprintf('cURL error: [%s] %s', $this->errorCode, $this->errorMessage)
            );
        }

        $this->errorCode = null;
        $this->errorMessage = null;
        return $this->response;
    }

    /**
     * Get cURL request info
     *
     * @param null $name
     *
     * @return mixed
     */
    public function getInfo($name = null) {
        if (! $name) {
            return curl_getinfo($this->handle);
        }

        return curl_getinfo($this->handle, $name);
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
     * @codeCoverageIgnore
     */
    public function getHttpCode() {
        return $this->httpCode;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTotalTime() {
        return $this->totalTime;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getErrorCode() {
        return $this->errorCode;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getErrorMessage() {
        return $this->errorMessage;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getHandle() {
        return $this->handle;
    }
}

