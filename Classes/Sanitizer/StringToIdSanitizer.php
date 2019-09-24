<?php
namespace Networkteam\Neos\Util\Sanitizer;

/***************************************************************
 *  (c) 2014 networkteam GmbH - all rights reserved
 ***************************************************************/

class StringToIdSanitizer implements \Neos\Eel\ProtectedContextAwareInterface {

	/**
	 * @var string
	 */
	protected $validFirstCharacters = '/[a-zA-Z]/';

	/**
	 * @var string
	 */
	protected $validCharacters = '/[a-zA-Z0-9\-]/';

	/**
	 * @param string $string
	 * @return string
	 */
	public function convertToId($string) {
		$idString = '';
		$isFirst = TRUE;
		$stringArr = str_split($string);
		foreach ($stringArr as $character) {
			if ($isFirst && !preg_match($this->validFirstCharacters, $character)) {
				continue;
			}
			$isFirst = FALSE;
			if(!preg_match($this->validCharacters, $character)) {
				$character = '-';
			}
			if(substr($idString, -1, 1) === '-' && $character === '-') {
				continue;
			}
			$idString .= $character;
		}

		if(strlen($idString) === 0) {
			while(strlen($idString) < 10){
				$character = chr(rand(97, 122));
				$idString .= $character;
			}
			$idString .= '-generated-no-valid-characters';
		}
		return trim($idString, '-');
	}

	/**
	 * @param string $methodName
	 * @return boolean
	 */
	public function allowsCallOfMethod($methodName) {
		return TRUE;
	}
}