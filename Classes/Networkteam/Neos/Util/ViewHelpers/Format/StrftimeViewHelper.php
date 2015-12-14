<?php
namespace Networkteam\Neos\Util\ViewHelpers\Format;

/***************************************************************
 *  (c) 2014 networkteam GmbH - all rights reserved
 ***************************************************************/

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Utility\Arrays;

class StrftimeViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {


	/**
	 * NOTE: This property has been introduced via code migration to ensure backwards-compatibility.
	 * @see AbstractViewHelper::isOutputEscapingEnabled()
	 * @var boolean
	 */
	protected $escapeOutput = FALSE;

	/**
	 * @Flow\Inject(setting="locales")
	 * @var string
	 */
	protected $locales;

	/**
	 * Render the supplied DateTime object as a formatted date using strftime.
	 *
	 * @param mixed $date either a DateTime object or a string (UNIX-Timestamp)
	 * @param string $format Format String which is taken to format the Date/Time
	 * @return string Formatted date
	 */
	public function render($date = NULL, $format = '%A, %d. %B %Y') {
		if ($date === NULL) {
			$date = $this->renderChildren();
			if ($date === NULL) {
				return '';
			}
		}

		$systemLocale = setlocale(LC_TIME, 0);
		setlocale(LC_TIME, Arrays::trimExplode(',', $this->locales));

		if ($date instanceof \DateTime) {
			$result = strftime($format, $date->getTimestamp());
		} else {
			$result = strftime($format, (int)$date);
		}

		setlocale(LC_TIME, $systemLocale);
		return $result;
	}

}