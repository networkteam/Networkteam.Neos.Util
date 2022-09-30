<?php

/***************************************************************
 *  (c) 2019 networkteam GmbH - all rights reserved
 ***************************************************************/

namespace Networkteam\Neos\Util\FusionObjects;

use Neos\Flow\Annotations as Flow;
use Neos\Fusion\FusionObjects\AbstractFusionObject;

class WithRequestImplementation extends AbstractFusionObject
{
    public function evaluate()
    {
        $controllerContext = $this->runtime->getControllerContext();
        $request = $controllerContext->getRequest();

        $withFormat = $this->fusionValue('format');
        $originalFormat = null;

        if ($request instanceof \Neos\Flow\Mvc\ActionRequest && !empty($withFormat)) {
            $originalFormat = $request->getFormat();
            $request->setFormat($withFormat);
        }

        try {
            return $this->fusionValue('renderer');
        } finally {
            if ($originalFormat !== null) {
                $request->setFormat($originalFormat);
            }
        }
    }
}
