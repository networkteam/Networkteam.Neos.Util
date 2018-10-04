<?php
namespace Networkteam\Neos\Util\Eel;

/***************************************************************
 *  (c) 2018 networkteam GmbH - all rights reserved
 ***************************************************************/

use TYPO3\Eel\ProtectedContextAwareInterface;
use TYPO3\Flow\Validation\Validator\UuidValidator;

class StringHelper implements ProtectedContextAwareInterface
{

    /**
     * @param string $nodeIdentifier
     * @return bool
     */
    public function isUuid(?string $nodeIdentifier)
    {
        return preg_match(UuidValidator::PATTERN_MATCH_UUID, $nodeIdentifier) === 1;
    }

    /**
     * @param string $methodName
     * @return boolean
     */
    public function allowsCallOfMethod($methodName)
    {
        return true;
    }
}