<?php

/***************************************************************
 *  (c) 2018 networkteam GmbH - all rights reserved
 ***************************************************************/

namespace Networkteam\Neos\Util\Eel;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Configuration\Exception\InvalidConfigurationException;

class DateHelper extends \Neos\Eel\Helper\DateHelper
{
    /**
     * @Flow\InjectConfiguration(path="dateHelper.timezone")
     * @var string
     */
    protected $timezone;

    public function strftime(string $format, int $timestamp): string|bool
    {
        return strftime($format, $timestamp);
    }

    public function inTimezone(\DateTime $date, string $timezone): ?\DateTime
    {
        try {
            $dateTimeZone = new \DateTimeZone($timezone);
            $date = clone $date;
            $date->setTimezone($dateTimeZone);
        } catch (\Exception) {
            $date = null;
        }

        return $date;
    }

    /**
     * @throws InvalidConfigurationException
     */
    public function inLocalTimezone(\DateTime $date): ?\DateTime
    {
        if (empty($this->timezone)) {
            throw new InvalidConfigurationException('Config "dateHelper.timezone" is not set.', 1561369362);
        }

        return $this->inTimezone($date, $this->timezone);
    }

    /**
     * Equivalent method to JavaScript Date.prototype.toISOString
     */
    public function toISOString(\DateTime $date): string
    {
        $date = clone $date;
        $date->setTimezone(new \DateTimeZone('UTC'));

        return sprintf(
            '%sT%sZ',
            $date->format('Y-m-d'),
            $date->format('H:i:s.u')
        );
    }
}
