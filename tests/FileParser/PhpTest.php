<?php
namespace Noodlehaus\FileParser\Test;

use Noodlehaus\FileParser\Php;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-04-21 at 22:37:22.
 */
class PhpTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Php
     */
    protected $php;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->php = new Php();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Noodlehaus\FileParser\Php::getSupportedExtensions()
     */
    public function testGetSupportedExtensions()
    {
        $expected = array('php');
        $actual   = $this->php->getSupportedExtensions();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers                   Noodlehaus\FileParser\Php::parse()
     * @expectedException        Noodlehaus\Exception\UnsupportedFormatException
     * @expectedExceptionMessage PHP file does not return an array
     */
    public function testLoadInvalidPhp()
    {
        $this->php->parse(__DIR__ . '/../mocks/fail/error.php');
    }

    /**
     * @covers                   Noodlehaus\FileParser\Php::parse()
     * @expectedException        Noodlehaus\Exception\ParseException
     * @expectedExceptionMessage PHP file threw an exception
     */
    public function testLoadExceptionalPhp()
    {
        $this->php->parse(__DIR__ . '/../mocks/fail/error-exception.php');
    }

    /**
     * @covers Noodlehaus\FileParser\Php::parse()
     */
    public function testLoadPhpArray()
    {
        $actual = $this->php->parse(__DIR__ . '/../mocks/pass/config.php');
        $this->assertEquals('localhost', $actual['host']);
        $this->assertEquals('80', $actual['port']);
    }

    /**
     * @covers Noodlehaus\FileParser\Php::parse()
     */
    public function testLoadPhpCallable()
    {
        $actual = $this->php->parse(__DIR__ . '/../mocks/pass/config-exec.php');
        $this->assertEquals('localhost', $actual['host']);
        $this->assertEquals('80', $actual['port']);
    }
}
