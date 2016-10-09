<?php

namespace Jabran\Tests\HttpUtil\Exception;

use Jabran\HttpUtil\Exception\HttpCurlException;

class HttpCurlExceptionTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     * @expectedException Jabran\HttpUtil\Exception\HttpCurlException
     * @expectedExceptionMessage foo
     */
    public function testHttpCurlException() {
        throw new HttpCurlException('foo');
    }

    /**
     * @test
     */
    public function testHttpCurlExceptionInheritance() {
        $this->assertInstanceOf('RunTimeException', new HttpCurlException());
    }
}
