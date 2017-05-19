<?php
namespace Networkteam\Neos\Util\TypoScriptObjects;

/***************************************************************
 *  (c) 2017 networkteam GmbH - all rights reserved
 ***************************************************************/

use TYPO3\Flow\Mvc\ActionRequest;
use TYPO3\Flow\Resource\Resource;
use TYPO3\TypoScript\Exception as TypoScriptException;

class ResourceUriImplementation extends \TYPO3\TypoScript\TypoScriptObjects\ResourceUriImplementation {

    /**
     * @return bool
     */
    public function isCacheBuster() {
        return (boolean)$this->tsValue('cacheBuster');
    }

    /**
     * Returns the absolute URL of a resource including cacheBuster parameter
     *
     * @return string
     * @throws TypoScriptException
     */
    public function evaluate()
    {
        $cacheBuster = '';
        $resource = $this->getResource();
        if ($resource !== null) {
            $uri = false;
            if ($resource instanceof Resource) {
                $uri = $this->resourceManager->getPublicPersistentResourceUri($resource);
            }
            if ($uri === false) {
                throw new TypoScriptException('The specified resource is invalid', 1386458728);
            }
            return $uri;
        }
        $path = $this->getPath();
        if ($path === null) {
            throw new TypoScriptException('Neither "resource" nor "path" were specified', 1386458763);
        }
        if (strpos($path, 'resource://') === 0) {
            $matches = array();
            if (preg_match('#^resource://([^/]+)/Public/(.*)#', $path, $matches) !== 1) {
                throw new TypoScriptException(sprintf('The specified path "%s" does not point to a public resource.', $path), 1386458851);
            }
            $package = $matches[1];
            $path = $matches[2];
        } else {
            $package = $this->getPackage();
            if ($package === null) {
                $controllerContext = $this->tsRuntime->getControllerContext();
                /** @var $actionRequest ActionRequest */
                $actionRequest = $controllerContext->getRequest();
                $package = $actionRequest->getControllerPackageKey();
            }
        }
        $localize = $this->isLocalize();
        if ($localize === true) {
            $resourcePath = 'resource://' . $package . '/Public/' . $path;
            $localizedResourcePathData = $this->i18nService->getLocalizedFilename($resourcePath);
            $matches = array();
            if (preg_match('#resource://([^/]+)/Public/(.*)#', current($localizedResourcePathData), $matches) === 1) {
                $package = $matches[1];
                $path = $matches[2];
            }
        }

        if ($this->isCacheBuster() === TRUE) {
            $resourcePath = 'resource://' . $package . '/Public/' . $path;
            if (is_file($resourcePath)) {
                $resourceModificationTimestamp = filemtime($resourcePath);
                if ($resourceModificationTimestamp !== FALSE) {
                    $cacheBuster = '?' . $resourceModificationTimestamp;
                }
            }
        }

        return $this->resourceManager->getPublicPackageResourceUri($package, $path) . $cacheBuster;
    }

}