<?php

namespace Minvws\HorseBattery;

use Minvws\HorseBattery\Exception\PasswordGenerationException;
use Minvws\HorseBattery\Exception\WordCountTooShort;
use Minvws\HorseBattery\Exception\WordListFileNotFound;
use Minvws\HorseBattery\Exception\WordListTooShort;

class HorseBattery implements PasswordGenerator
{
    /** @var array<string> */
    private $wordlist;

    private const DEFAULT_LOCALE = 'nl';
    private const DEFAULT_WORD_LIST_PATH = '%s/config/%s/word-list.txt';
    private const DEFAULT_WORD_COUNT = 4;
    private const MIN_WORD_LIST_COUNT = 9000;
    private const MIN_WORD_COUNT = 1;

    /**
     * @throws PasswordGenerationException
     */
    public function __construct(?string $locale = self::DEFAULT_LOCALE, array $wordlist = null)
    {
        $this->wordlist = $wordlist ?? $this->getDefaultWordList($locale ?? "");

        if (count($this->wordlist) < self::MIN_WORD_LIST_COUNT) {
            throw WordListTooShort::forMinimum(self::MIN_WORD_LIST_COUNT);
        }
    }

    public function generate(?int $wordCount = self::DEFAULT_WORD_COUNT, string $separator = null): string
    {
        if ($wordCount < self::MIN_WORD_COUNT) {
            throw WordCountTooShort::forMinimum(self::MIN_WORD_COUNT);
        }

        $length = count($this->wordlist);

        $pw = [];
        for ($i = 1; $i <= $wordCount; $i++) {
            $plain = false;
            while (!$plain) {
                $key = random_int(0, $length - 1);
                if ((preg_match("/^[a-zA-Z0-9\-]+$/", $this->wordlist[$key]) == 1)) {
                    $plain = true;
                    $pw[] = ucwords($this->wordlist[$key]);
                }
            }
        }

        return join($separator ?? "", $pw);
    }

    /**
     * @throws PasswordGenerationException
     */
    protected function getDefaultWordList(string $locale): array
    {
        $parentDir = dirname(__DIR__, 1);
        $path = realpath(sprintf(self::DEFAULT_WORD_LIST_PATH, $parentDir, $locale));

        if (!$path || !$wordlist = file($path, FILE_IGNORE_NEW_LINES)) {
            throw WordListFileNotFound::forLocale(self::DEFAULT_LOCALE);
        }

        return $wordlist;
    }
}
