<?php
namespace Networkteam\Neos\Util\ViewHelpers\Format;
/***************************************************************
 *  (c) 2014 networkteam GmbH - all rights reserved
 ***************************************************************/

class SanitizedIdViewHelper extends \Neos\FluidAdaptor\Core\ViewHelper\AbstractViewHelper {


	/**
	 * NOTE: This property has been introduced via code migration to ensure backwards-compatibility.
	 * @see AbstractViewHelper::isOutputEscapingEnabled()
	 * @var boolean
	 */
	protected $escapeOutput = FALSE;

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