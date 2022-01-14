<?php

namespace Minvws\Horsebattery;

interface PasswordGenerator
{
    public function generate(int $count): string;
}