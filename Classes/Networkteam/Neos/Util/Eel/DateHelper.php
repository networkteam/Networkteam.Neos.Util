<?php
namespace Networkteam\Neos\Util\Eel;

/***************************************************************
 *  (c) 2018 networkteam GmbH - all rights reserved
 ***************************************************************/

/**
 * Class DateHelper
 *
 * @package Networkteam\Neos\Util\Eel
 */
class DateHelper extends \Neos\Eel\Helper\DateHelper
{

    /**
     * @param string $format
     * @param int $timestamp
     * @return
     */
    public function strftime($format, $timestamp) {
        return strftime($format, $timestamp);
    }
}