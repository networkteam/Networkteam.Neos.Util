<?php

namespace Networkteam\Neos\Util\Eel;

use Neos\Flow\Annotations as Flow;
use Neos\Eel\ProtectedContextAwareInterface;
use Neos\Flow\Validation\Validator\UuidValidator;
use Neos\Neos\Exception;

/**
 * Custom String helper
 */
class StringHelper implements ProtectedContextAwareInterface
{
    /**
     * @throws Exception
     */
    public function nl2br(string $string, bool $is_xhtml = true): string
    {

        if (!is_string($string)) {
            throw new Exception(sprintf('String expected by this helper, given: "%s".', gettype($string)), 1520777668);
        }

        return nl2br($string, $is_xhtml);
    }

    public function isUuid(?string $nodeIdentifier): bool
    {
        return preg_match(UuidValidator::PATTERN_MATCH_UUID, $nodeIdentifier) === 1;
    }

    public function allowsCallOfMethod($methodName): bool
    {
        return true;
    }
}
