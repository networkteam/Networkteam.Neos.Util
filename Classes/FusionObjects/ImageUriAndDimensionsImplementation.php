<?php

namespace Networkteam\Neos\Util\FusionObjects;

/***************************************************************
 *  (c) 2014 networkteam GmbH - all rights reserved
 ***************************************************************/

use Neos\Flow\Annotations as Flow;
use Neos\Media\Domain\Model\AssetInterface;
use Neos\Media\Domain\Service\AssetService;

class ImageUriAndDimensionsImplementation extends \Neos\Fusion\FusionObjects\AbstractFusionObject
{

    /**
     * Resource publisher
     *
     * @Flow\Inject
     * @var AssetService
     */
    protected $assetService;

    /**
     * Asset
     */
    public function getAsset(): AssetInterface
    {
        return $this->fusionValue('asset');
    }

    /**
     * Width
     */
    public function getWidth(): int
    {
        return $this->fusionValue('maximumWidth');
    }

    /**
     * Height
     */
    public function getHeight(): int
    {
        return $this->fusionValue('maximumHeight');
    }

    /**
     * MaximumWidth
     */
    public function getMaximumWidth(): int
    {
        return $this->fusionValue('maximumWidth');
    }

    /**
     * MaximumHeight
     */
    public function getMaximumHeight(): int
    {
        return $this->fusionValue('maximumHeight');
    }

    /**
     * AllowCropping
     */
    public function getAllowCropping(): bool
    {
        return $this->fusionValue('allowCropping');
    }

    /**
     * AllowUpScaling
     */
    public function getAllowUpScaling(): bool
    {
        return $this->fusionValue('allowUpScaling');
    }

    /**
     * Returns the processed image path and dimensions
     *
     * @return mixed[]|null Image src and dimensions (keys "src", "width", "height")
     */
    public function evaluate(): ?array
    {
        $asset = $this->getAsset();

        if (!$asset instanceof AssetInterface) {
            throw new \Exception('No asset given for rendering.', 1435754424);
        }

        $width = $this->getWidth();
        $height = $this->getHeight();
        $maximumWidth = $this->getMaximumWidth();
        $maximumHeight = $this->getMaximumHeight();
        $allowCropping = $this->getAllowCropping();
        $allowUpScaling = $this->getAllowUpScaling();

        $thumbnailConfiguration = new \Neos\Media\Domain\Model\ThumbnailConfiguration($width, $maximumWidth, $height, $maximumHeight, $allowCropping, $allowUpScaling);

        return $this->assetService->getThumbnailUriAndSizeForAsset($asset, $thumbnailConfiguration);
    }
}