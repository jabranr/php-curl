<?php

namespace Jabran\Tests\HttpUtil;

use Jabran\HttpUtil\Exception\HttpCurlException;
use Jabran\HttpUtil\HttpCurlRequest;

class HttpCurlRequestTest extends \PHPUnit_Framework_TestCase {

    private $_curl;

    const URL = 'http://jabran.me/';

    public function setUp() {
        $this->_curl = new HttpCurlRequest(self::URL);
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
    public function testGetHttpCode() {
        $this->_curl->execute();
        $this->assertInternalType('integer', $this->_curl->getHttpCode());
        $this->assertGreaterThan(0, $this->_curl->getHttpCode());
    }

    /**
     * @depends testConstructor
     */
    public function testGetInfo() {
        $this->_curl->execute(false);
        $info = $this->_curl->getInfo(CURLINFO_EFFECTIVE_URL);
        $this->_curl->close();
        $this->assertEquals($info, self::URL);
    }

    /**
     * @depends testConstructor
     */
    public function testGetTotalTime() {
        $this->_curl->execute();
        $this->assertInternalType('float', $this->_curl->getTotalTime());
    }

    /**
     * @test
     * @depends testConstructor
     */
    public function testGetResponse() {
        $this->_curl->execute();
        $this->assertInternalType('string', $this->_curl->getResponse());
    }

    /**
     * @test
     * @expectedException Jabran\HttpUtil\Exception\HttpCurlException
     */
    public function testExecuteWillThrowException() {
        $curl = new HttpCurlRequest('foo.bar');
        $curl->setOption(CURLOPT_RETURNTRANSFER, true);
        $curl->execute();
    }
}
