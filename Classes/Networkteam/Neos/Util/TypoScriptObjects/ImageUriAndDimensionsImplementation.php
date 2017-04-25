<?php
namespace Networkteam\Neos\Util\TypoScriptObjects;

/***************************************************************
 *  (c) 2014 networkteam GmbH - all rights reserved
 ***************************************************************/

use Neos\Flow\Annotations as Flow;
use Neos\Media\Domain\Model\AssetInterface;
use Neos\Media\Domain\Service\AssetService;

class ImageUriAndDimensionsImplementation extends \Neos\Fusion\FusionObjects\AbstractFusionObject {

	/**
	 * Resource publisher
	 *
	 * @Flow\Inject
	 * @var AssetService
	 */
	protected $assetService;

	/**
	 * Asset
	 *
	 * @return AssetInterface
	 */
	public function getAsset() {
		return $this->tsValue('asset');
	}

	/**
	 * MaximumWidth
	 *
	 * @return integer
	 */
	public function getMaximumWidth() {
		return $this->tsValue('maximumWidth');
	}

	/**
	 * MaximumHeight
	 *
	 * @return integer
	 */
	public function getMaximumHeight() {
		return $this->tsValue('maximumHeight');
	}

	/**
	 * AllowCropping
	 *
	 * @return boolean
	 */
	public function getAllowCropping() {
		return $this->tsValue('allowCropping');
	}

	/**
	 * AllowUpScaling
	 *
	 * @return boolean
	 */
	public function getAllowUpScaling() {
		return $this->tsValue('allowUpScaling');
	}

	/**
	 * Returns the processed image path and dimensions
	 *
	 * @return array Image src and dimensions (keys "src", "width", "height")
	 */
	public function evaluate() {
		$asset = $this->getAsset();

		if (!$asset instanceof AssetInterface) {
			throw new \Exception('No asset given for rendering.', 1435754424);
		}

		$maximumWidth = $this->getMaximumWidth();
		$maximumHeight = $this->getMaximumHeight();
		$allowCropping = $this->getAllowCropping();
		$allowUpScaling = $this->getAllowUpScaling();

		$thumbnailConfiguration = new \Neos\Media\Domain\Model\ThumbnailConfiguration(null, $maximumWidth, null, $maximumHeight, $allowCropping, $allowUpScaling);

		return $this->assetService->getThumbnailUriAndSizeForAsset($asset, $thumbnailConfiguration);
	}
}