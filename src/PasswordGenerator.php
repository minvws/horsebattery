<?php

namespace Minvws\HorseBattery;

interface PasswordGenerator
{
    public function generate(?int $wordCount = null, string $separator = null): string;
}
