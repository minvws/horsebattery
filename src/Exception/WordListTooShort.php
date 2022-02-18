<?php

namespace Minvws\HorseBattery\Exception;

class WordListTooShort extends \Exception implements PasswordGenerationException
{
    public static function forMinimum(int $minWords): self
    {
        return new self(sprintf(
            'Could not initialize password generator: word list must have at least %d words',
            $minWords
        ));
    }
}
