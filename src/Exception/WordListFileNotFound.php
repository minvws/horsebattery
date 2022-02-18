<?php

namespace Minvws\HorseBattery\Exception;

class WordListFileNotFound extends \Exception implements PasswordGenerationException
{
    public static function forLocale(string $locale): self
    {
        return new self(sprintf('Default world list for locale %s not found', $locale));
    }

    public static function notAllowedOutOfConfigDir(): self
    {
        return new self('Default wordlist detected out of config directory');
    }
}
