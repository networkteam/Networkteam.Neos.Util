<?php
namespace Networkteam\Neos\Util\FusionObjects;

/***************************************************************
 *  (c) 2024 networkteam GmbH - all rights reserved
 ***************************************************************/

use GuzzleHttp\Psr7\Uri;
use Neos\Flow\Annotations as Flow;

class UriImplementation extends \Neos\Fusion\FusionObjects\AbstractFusionObject
{

    public function evaluate(): string
    {
        $uri = $this->getUri();

        // append path
        if (!empty($this->getPath())) {
            $path = $this->isAppendPath() ? $uri->getPath() . '/' . $this->getPath() : $this->getPath();
            $uri = $uri->withPath($path);
        }

        if (!empty($this->getQueryValues())) {
            $uri = Uri::withQueryValues($uri, $this->getQueryValues());
        }

        // query rules over queryValues
        if (!empty($this->getQuery())) {
            $uri = $uri->withQuery($this->getQuery());
        }

        if (!empty($this->getFragment())) {
            $uri = $uri->withFragment($this->getFragment());
        }

        return (string)$uri;
    }

    public function getUri(): Uri
    {
        return new Uri((string)$this->fusionValue('uri'));
    }

    public function getPath(): string
    {
        return trim((string)$this->fusionValue('path'), '/');
    }

    public function getQuery(): string
    {
        return $this->fusionValue('query');
    }

    public function getQueryValues(): array
    {
        $queryValues = $this->fusionValue('queryValues');
        return !is_array($queryValues) ? [] : $queryValues;
    }

    public function getFragment(): string
    {
        return (string)$this->fusionValue('fragment');
    }

    public function isAppendPath(): bool
    {
        return (bool)$this->fusionValue('appendPath');
    }
}