<?php

namespace Jabran\Tests\HttpUtil;

use Jabran\HttpUtil\HttpCurlRequest;

class HttpCurlRequestTest extends \PHPUnit_Framework_TestCase {

    private $_curl;

    public function setUp() {
        $this->_curl = new HttpCurlRequest('http://jabran.me');
    }

    public function tearDown() {
        $this->_curl = null;
    }

    /**
     * @test
     */
    public function testConstructor() {
        $this->assertInstanceOf('Jabran\HttpUtil\HttpCurlRequest', $this->_curl);
        $this->assertNotNull($this->_curl->getHandle());
        $this->assertEquals('resource', gettype($this->_curl->getHandle()));
        $this->assertEquals('curl', get_resource_type($this->_curl->getHandle()));
    }

    /**
     * @test
     */
    public function testGetStatusCode() {
        $stub = $this->getMock('Jabran\HttpUtil\HttpCurlRequest');
        $stub
            ->method('getStatusCode')
            ->willReturn(200);

        $this->assertEquals(200, $stub->getStatusCode());
    }
}
