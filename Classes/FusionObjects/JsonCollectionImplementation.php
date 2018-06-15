<?php
namespace Networkteam\Neos\Util\FusionObjects;

/***************************************************************
 *  (c) 2015 networkteam GmbH - all rights reserved
 ***************************************************************/

use Neos\Flow\Annotations as Flow;

class JsonCollectionImplementation extends \Neos\Fusion\FusionObjects\AbstractCollectionImplementation {

	/**
	 * @return array
	 */
	public function evaluate() {
		$collection = $this->getCollection();

		$output = array();
		if ($collection === NULL) {
			return array();
		}
		$this->numberOfRenderedNodes = 0;
		$itemName = $this->getItemName();
		if ($itemName === NULL) {
			throw new \Neos\Fusion\Exception('The Collection needs an itemName to be set.', 1344325771);
		}
		$iterationName = $this->getIterationName();
		$collectionTotalCount = count($collection);
		foreach ($collection as $collectionElement) {
			$context = $this->runtime->getCurrentContext();
			$context[$itemName] = $collectionElement;
			if ($iterationName !== NULL) {
				$context[$iterationName] = $this->prepareIterationInformation($collectionTotalCount);
			}

			$this->runtime->pushContextArray($context);
			$output[] = $this->runtime->render($this->path . '/itemRenderer');
			$this->runtime->popContext();
			$this->numberOfRenderedNodes++;
		}

		return $output;
	}
}