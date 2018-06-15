<?php
namespace Networkteam\Neos\Util\Eel;

/***************************************************************
 *  (c) 2018 networkteam GmbH - all rights reserved
 ***************************************************************/

class DateHelper extends \Neos\Eel\Helper\DateHelper
{
    /**
     * @param string $format
     * @param int $timestamp
     * @return string
     */
    public function strftime($format, $timestamp) {
        return strftime($format, $timestamp);
    }
}