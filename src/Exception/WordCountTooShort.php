<?php

namespace Minvws\Horsebattery\Exception;

final class WordCountTooShort extends \Exception implements PasswordGenerationException
{
    public static function forMinimum(int $minWordCount): self
    {
        return new static('Word count must be at least ' . $minWordCount);
    }
}