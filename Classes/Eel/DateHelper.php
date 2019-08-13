<?php
namespace Networkteam\Neos\Util\Eel;

/***************************************************************
 *  (c) 2018 networkteam GmbH - all rights reserved
 ***************************************************************/

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Configuration\Exception\InvalidConfigurationException;

class DateHelper extends \Neos\Eel\Helper\DateHelper
{

    /**
     * @Flow\InjectConfiguration(path="dateHelper.timezone")
     * @var string
     */
    protected $timezone;

    /**
     * @param string $format
     * @param int $timestamp
     * @return string
     */
    public function strftime($format, $timestamp) {
        return strftime($format, $timestamp);
    }

    /**
     * @param \DateTime $date
     * @param string $timezone
     * @return \DateTime|null
     */
    public function inTimezone(\DateTime $date, string $timezone): ?\DateTime
    {
        try {
            $dateTimeZone = new \DateTimeZone($timezone);
            $date = clone $date;
            $date->setTimezone($dateTimeZone);
        } catch (\Exception $e) {
            $date = null;
        }

        return $date;
    }

    /**
     * @param \DateTime $date
     * @return \DateTime|null
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
     *
     * @param \DateTime $date
     * @return string
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