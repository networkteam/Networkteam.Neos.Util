<?php
namespace Networkteam\Neos\Util\Tests\Unit\Sanitizer;

/***************************************************************
 *  (c) 2014 networkteam GmbH - all rights reserved
 ***************************************************************/

use Neos\Flow\Tests\UnitTestCase;

class StringToIdSanitizerTest extends UnitTestCase {

	protected $validIdRegex = '([A-Za-z])(A-Za-z0-9)*';

	/**
	 * @test
	 * @dataProvider crazyStringProvider
	 */
	public function stringIsSanitizedAgainstRegex($string) {
		$sanitizer = new \Networkteam\Neos\Util\Sanitizer\StringToIdSanitizer();
		$id = $sanitizer->convertToId($string);
		$this->assertMatchesRegularExpression('/' . $this->validIdRegex . '/', $id);
	}

	/**
	 * @return array
	 */
	public function crazyStringProvider() {
		return array(
			array('0-9 are some fancy numbers'),
			array('This can become a valid Identifier: but don\'t use ß'),
			array('-:?ß'),
			array('This is an ordinary Headline in german with some Umlauts Äöü')
		);
	}
}
