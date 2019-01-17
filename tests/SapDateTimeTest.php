<?php
/**
 * File tests/SapDateTimeTest.php
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
     * @throws \Exception
     */
    public function testParseSapWeeks($sapWeek, $expected)
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
     * @throws \Exception
     */
    public function testParseInvalidSapWeeks($sapWeek)
    {
        $dateTime = SapDateTime::createFromFormat(SapDateTime::SAP_WEEK, $sapWeek);
        static::assertFalse($dateTime);
    }

    /**
     * Data provider of timestamps and their according SAP week strings.
     * @return array
     */
    public static function timestampsAndSapWeeks()
    {
        return [
            ['2018-10-19 08:09:10', '201842'],
            ['1907-12-31 09:10:11', '190801'],
            ['1908-12-31 10:11:12', '190853'],
            ['1909-12-31 11:12:13', '190952'],
            ['1910-12-31 12:13:14', '191052'],
            ['1911-12-31 12:13:14', '191152'],
            ['1912-12-31 12:13:14', '191301']
        ];
    }

    /**
     * Test formatting timestamps to SAP week strings.
     * @param string $timestamp Timestamp string
     * @param string $expected SAP week string
     * @throws \Exception
     * @dataProvider timestampsAndSapWeeks
     */
    public function testCreateSapWeeks($timestamp, $expected)
    {
        $dateTime = new SapDateTime($timestamp);
        $sapWeekString = $dateTime->format(SapDateTime::SAP_WEEK);
        static::assertSame($expected, $sapWeekString);
    }
}
