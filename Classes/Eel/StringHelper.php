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
     * @param String $string
     * @param Boolean $is_xhtml
     * @return String
     * @throws Exception
     */
    public function nl2br(string $string, bool $is_xhtml = true) {

        if (!is_string($string)) {
            throw new Exception(sprintf('String expected by this helper, given: "%s".', gettype($string)), 1520777668);
        }

        $newString = nl2br($string, $is_xhtml);

        return $newString;
    }

    /**
     * @param string $string
     * @param int $times
     * @return string
     */
    public function repeat(string $string, int $times) {
        return str_repeat($string, $times);
    }

    public function isUuid(?string $nodeIdentifier) {
        return preg_match(UuidValidator::PATTERN_MATCH_UUID, $nodeIdentifier) === 1;
    }

    public function allowsCallOfMethod($methodName) {
        return true;
    }

}
