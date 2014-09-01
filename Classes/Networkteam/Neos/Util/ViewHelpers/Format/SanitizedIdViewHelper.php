<?php
namespace Networkteam\Neos\Util\ViewHelpers\Format;
/***************************************************************
 *  (c) 2014 networkteam GmbH - all rights reserved
 ***************************************************************/

class SanitizedIdViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Be aware that this ViewHelper will not maintain the uniqueness of a generated Id
	 *
	 * @param string $string to be sanitized
	 * @return string
	 */
	public function render($string = '') {
		$stringToSanitize = $this->renderChildren();
		if(strlen($stringToSanitize) === 0) {
			$stringToSanitize = $string;
		}
		$sanitizer = new \Networkteam\Neos\Util\String\StringToIdSanitizer();

		return $sanitizer->convertToId($stringToSanitize);
	}
}