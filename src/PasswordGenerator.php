<?php

namespace Minvws\HorseBattery;

interface PasswordGenerator
{
    public function generate(?int $count = null): string;
}
