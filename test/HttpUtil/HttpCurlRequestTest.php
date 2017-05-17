<?php

namespace Jabran\Tests\HttpUtil;

use Jabran\HttpUtil\HttpCurlRequest;

class HttpCurlRequestTest extends \PHPUnit_Framework_TestCase {

    private $_curl;

    const URL = 'http://jabran.me/';

    public function setUp() {
        $this->_curl = new HttpCurlRequest(static::URL);
        $this->_curl->setOption(CURLOPT_RETURNTRANSFER, true);
    }

    public function tearDown() {
        $this->_curl = null;
    }

    public function testConstructor() {
        $this->assertInstanceOf('Jabran\HttpUtil\HttpCurlRequest', $this->_curl);
        $this->assertNotNull($this->_curl->getHandle());
        $this->assertEquals('resource', gettype($this->_curl->getHandle()));
        $this->assertEquals('curl', get_resource_type($this->_curl->getHandle()));
    }

    /**
     * @depends testConstructor
     */
    public function testGetStatusCode() {
        $this->_curl->execute();
        $this->assertInternalType('integer', $this->_curl->getStatusCode());
        $this->assertGreaterThan(0, $this->_curl->getStatusCode());
    }

    /**
     * @depends testConstructor
     */
    public function testGetInfo() {
        $this->_curl->execute();
        $this->assertEquals($this->_curl->getInfo(CURLINFO_EFFECTIVE_URL), static::URL);
    }

    /**
     * @depends testConstructor
     */
    public function testGetRequestTime() {
        $this->_curl->execute();
        $this->assertInternalType('float', $this->_curl->getRequestTime());
    }

    /**
     * @depends testConstructor
     */
    public function testGetResponse() {
        $this->_curl->execute();
        $this->assertInternalType('string', $this->_curl->getResponse());
    }

}
