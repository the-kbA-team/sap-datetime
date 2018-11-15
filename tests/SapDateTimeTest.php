<?php
/**
 * File src/SapDateTimeTest.php
 *
 * Test SapDateTime class.
 *
 * @package sap-datetime
 * @author  Gregor J.
 * @license MIT
 */

namespace Tests\kbATeam\SapDateTime;

use kbATeam\SapDateTime\SapDateTime;

/**
 * Class Tests\kbATeam\SapDateTime\SapDateTimeTest
 *
 * Unit tests for the SapDateTime class.
 *
 * @package Tests\kbATeam\SapDateTime
 * @author  Gregor J.
 * @license MIT
 */
class SapDateTimeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Data provider for valid SAP week strings and the expected output.
     *
     * @return array
     */
    public static function validSapWeeks()
    {
        return [
            ['201846', '2018 week 46'],
            ['190801', '1908 week 01'],
            ['190853', '1908 week 53'],
            ['190952', '1909 week 52'],
            ['191052', '1910 week 52'],
            ['191152', '1911 week 52'],
            ['191301', '1913 week 01']
        ];
    }

    /**
     * Test valid SAP week conversions.
     *
     * @param string $sapWeek  The SAP week string.
     * @param string $expected The expected week in format <year>W<week>.
     * @dataProvider validSapWeeks
     */
    public function testSapWeeks($sapWeek, $expected)
    {
        $dateTime = SapDateTime::createFromFormat(SapDateTime::SAP_WEEK, $sapWeek);
        static::assertInstanceOf(\DateTime::class, $dateTime);
        static::assertSame($expected, $dateTime->format('o \w\e\ek W'));
    }

    /**
     * Data provider for invalid SAP week strings.
     *
     * @return array
     */
    public static function invalidSapWeeks()
    {
        return [
            ['189952'],
            ['33333'],
            ['19901'],
            ['201854']
        ];
    }

    /**
     * Test valid SAP week conversions.
     *
     * @param string $sapWeek  The SAP week string.
     * @dataProvider invalidSapWeeks
     */
    public function testInvalidSapWeeks($sapWeek)
    {
        $dateTime = SapDateTime::createFromFormat(SapDateTime::SAP_WEEK, $sapWeek);
        static::assertFalse($dateTime);
    }
}
