<?php

namespace Minvws\Horsebattery\Exception;

final class WordListFileNotFound extends \Exception implements PasswordGenerationException
{
    public static function forLocale(string $locale): self
    {
        return new static(sprintf('Default world list for locale %s not found', $locale));
    }
}