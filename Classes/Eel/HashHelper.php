<?php
namespace Networkteam\Neos\Util\Eel;

/***************************************************************
 *  (c) 2018 networkteam GmbH - all rights reserved
 ***************************************************************/

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Security\Cryptography\HashService;

class HashHelper implements \Neos\Eel\ProtectedContextAwareInterface
{

    /**
     * @Flow\Inject
     * @var HashService
     */
    protected $hashService;

    /**
     * @param $string
     * @return string The string with appended HMAC
     */
    public function appendHmac($string): string
    {
        return $this->hashService->appendHmac($string);
    }

    /**
     * Builds a associative array with the original value as key, and the HMAC secured string as value.
     *
     * @return array the given array of strings with each element HMAC appended
     * @param mixed[] $array
     */
    public function toHmacSecuredArray(array $array): array
    {
        $result = [];
        foreach ($array as $value) {
            $result[$value] = $this->appendHmac($value);
        }
        return $result;
    }

    public function validate($string): bool
    {
        try {
            $this->hashService->validateAndStripHmac($string);
            return true;
        } catch (\Exception) {
            return false;
        }
    }

    public function validateAndStripHmac($string): string
    {
        try {
            return $this->hashService->validateAndStripHmac($string);
        } catch (\Exception) {
            return '';
        }
    }

    /**
     * {@inheritdoc}
     */
    public function allowsCallOfMethod($methodName): bool
    {
        return true;
    }
}