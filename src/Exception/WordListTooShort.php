<?php

namespace Minvws\HorseBattery\Exception;

final class WordListTooShort extends \Exception implements PasswordGenerationException
{
    public static function forMinimum(int $minWords): self
    {
        return new static(sprintf(
            'Could not initialize password generator: word list must have at least %d words',
            $minWords
        ));
    }
}