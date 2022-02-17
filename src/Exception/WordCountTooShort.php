<?php

namespace Minvws\HorseBattery\Exception;

class WordCountTooShort extends \Exception implements PasswordGenerationException
{
    public static function forMinimum(int $minWordCount): self
    {
        return new self('Word count must be at least ' . $minWordCount);
    }
}
