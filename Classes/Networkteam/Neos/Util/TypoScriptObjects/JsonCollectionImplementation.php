<?php
namespace Networkteam\Neos\Util\TypoScriptObjects;

/***************************************************************
 *  (c) 2015 networkteam GmbH - all rights reserved
 ***************************************************************/

use Neos\Flow\Annotations as Flow;

class JsonCollectionImplementation extends \TYPO3\TypoScript\TypoScriptObjects\AbstractCollectionImplementation {

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
			throw new \TYPO3\TypoScript\Exception('The Collection needs an itemName to be set.', 1344325771);
		}
		$iterationName = $this->getIterationName();
		$collectionTotalCount = count($collection);
		foreach ($collection as $collectionElement) {
			$context = $this->tsRuntime->getCurrentContext();
			$context[$itemName] = $collectionElement;
			if ($iterationName !== NULL) {
				$context[$iterationName] = $this->prepareIterationInformation($collectionTotalCount);
			}

			$this->tsRuntime->pushContextArray($context);
			$output[] = $this->tsRuntime->render($this->path . '/itemRenderer');
			$this->tsRuntime->popContext();
			$this->numberOfRenderedNodes++;
		}

		return $output;
	}
}