<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;

class Alpha extends AbstractRule
{

    public $additionalChars = '';
    public $stringFormat = '/^\s*[a-zA-Z]+([a-zA-Z]|\s)*$/';

    public function __construct($additionalChars='')
    {
        if (!is_string($additionalChars))
            throw new ComponentException(
                'Invalid list of additional characters to be loaded'
            );
        $this->additionalChars = $additionalChars;
    }

    public function validate($input)
    {
        if (!is_scalar($input))
            return false;
        $cleanInput = str_replace(str_split($this->additionalChars), '', $input);
        return ($cleanInput !== $input && $cleanInput === '')
        || preg_match($this->stringFormat, $cleanInput);
    }

}