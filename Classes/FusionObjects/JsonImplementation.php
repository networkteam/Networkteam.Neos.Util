<?php
namespace Networkteam\Neos\Util\FusionObjects;

/***************************************************************
 *  (c) 2015 networkteam GmbH - all rights reserved
 ***************************************************************/

use Neos\Flow\Annotations as Flow;

class JsonImplementation extends \Neos\Fusion\FusionObjects\AbstractFusionObject {

	/**
	 * @return mixed
	 */
	public function getValue() {
		return $this->fusionValue('value');
	}

	/**
	 * @return string An encoded JSON string
	 */
	public function evaluate() {
		$value = $this->getValue();
		return json_encode($value);
	}
}