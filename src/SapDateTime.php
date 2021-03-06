<?php
/**
 * File src/SapDateTime.php
 *
 * SAP date, week and timestamp conversions.
 *
 * @package sap-datetime
 * @author  Gregor J.
 * @license MIT
 */

namespace kbATeam\SapDateTime;

/**
 * Class kbATeam\SapDateTime\SapDateTime
 *
 * Helps converting between PHPs DateTime objects and SAP date, week and timestamp.
 *
 * @package kbATeam\SapDateTime
 * @author  Gregor J.
 * @license MIT
 */
class SapDateTime extends \DateTime
{
    /**
     * @const string SAP week format.
     */
    const SAP_WEEK = 'oW';

    /**
     * @const string SAP date format.
     */
    const SAP_DATE = 'Ymd';

    /**
     * @const string SAP timestamp format.
     */
    const SAP_TIMESTAMP = 'YmdHis';

    /**
     * This regular expression covers only years from 1900 to 9999.
     * @var string regular expression for parsing an SAP week.
     */
    protected static $sapWeekRegex = '~^(19[\d]{2}|[2-9][\d]{3})(0[1-9]|[1-4][\d]|5[0-3])$~';

    /**
     * Parse an SAP week string into a new DateTime object.
     *
     * @param string        $sapWeek  String representing the SAP week.
     * @param \DateTimeZone $timezone A DateTimeZone object representing the desired
     *                                time zone.
     * @return \DateTime|boolean
     * @throws \Exception
     */
    public static function createFromSapWeek($sapWeek, $timezone = null)
    {
        if (preg_match(static::$sapWeekRegex, $sapWeek, $matches) !== 1) {
            return false;
        }
        $week = sprintf('%sW%s', $matches[1], $matches[2]);
        return new parent($week, $timezone);
    }

    /**
     * Parse a string into a new DateTime object according to the specified format.
     *
     * @param string        $format   Format accepted by date().
     * @param string        $time     String representing the time.
     * @param \DateTimeZone $timezone A DateTimeZone object representing the desired
     *                                time zone.
     * @return \DateTime|boolean
     * @throws \Exception
     *
     * @link https://php.net/manual/en/datetime.createfromformat.php
     */
    public static function createFromFormat(
        $format,
        $time,
        $timezone = null
    ) {
        if ($format === static::SAP_WEEK) {
            return static::createFromSapWeek($time, $timezone);
        }
        if ($timezone === null) {
            return parent::createFromFormat($format, $time);
        }
        //@codeCoverageIgnoreStart
        return parent::createFromFormat($format, $time, $timezone);
        //@codeCoverageIgnoreEnd
    }
}
