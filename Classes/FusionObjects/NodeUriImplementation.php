<?php
namespace Networkteam\Neos\Util\FusionObjects;

/***************************************************************
 *  (c) 2018 networkteam GmbH - all rights reserved
 ***************************************************************/

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Security\Context;

class NodeUriImplementation extends \Neos\Neos\Fusion\NodeUriImplementation
{

    /**
     * @Flow\Inject
     * @var Context
     */
    protected $securityContext;

    /**
     * If true, authorization checks (CSRF token, policies, content security, ...) for getNode() will be switched off
     *
     * @return boolean
     */
    public function getDisableAuthorizationChecks()
    {
        return (boolean)$this->fusionValue('disableAuthorizationChecks');
    }

    public function evaluate()
    {
        $result = '';

        if ($this->getDisableAuthorizationChecks()) {
            // Build context explicitly without authorization checks
            $this->securityContext->withoutAuthorizationChecks(function () use (&$result) {
                $result = $this->originalEvaluate();
            });
        } else {
            $result = $this->originalEvaluate();
        }

        return $result;
    }

    public function originalEvaluate() {
        return parent::evaluate();
    }

}