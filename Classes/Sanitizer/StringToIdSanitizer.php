<?php

namespace Networkteam\Neos\Util\Sanitizer;

/***************************************************************
 *  (c) 2014 networkteam GmbH - all rights reserved
 ***************************************************************/

class StringToIdSanitizer implements \Neos\Eel\ProtectedContextAwareInterface
{
    /**
     * @var string
     */
    protected $validFirstCharacters = '/[a-zA-Z]/';

    /**
     * @var string
     */
    protected $validCharacters = '/[a-zA-Z0-9\-]/';

    public function convertToId(string $string): string
    {
        $idString = '';
        $isFirst = true;
        $stringArr = str_split($string);
        foreach ($stringArr as $character) {
            if ($isFirst && !preg_match($this->validFirstCharacters, $character)) {
                continue;
            }
            $isFirst = false;
            if (!preg_match($this->validCharacters, $character)) {
                $character = '-';
            }
            if (str_ends_with($idString, '-') && $character === '-') {
                continue;
            }
            $idString .= $character;
        }

        if ($idString === '') {
            while (strlen($idString) < 10) {
                $character = chr(random_int(97, 122));
                $idString .= $character;
            }
            $idString .= '-generated-no-valid-characters';
        }
        return trim($idString, '-');
    }

    /**
     * @param string $methodName
     */
    public function allowsCallOfMethod($methodName): bool
    {
        return true;
    }
}
