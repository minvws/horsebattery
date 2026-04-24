<?php

namespace Minvws\HorseBattery\Tests;

use Minvws\HorseBattery\Exception\WordCountTooShort;
use Minvws\HorseBattery\Exception\WordListFileNotFound;
use Minvws\HorseBattery\Exception\WordListTooShort;
use Minvws\HorseBattery\HorseBattery;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class HorseBatteryTest extends TestCase
{
    #[DataProvider('expectedResultProvider')]
    public function testGeneratesExpectedResult(int $wordCount): void
    {
        $hb = new HorseBattery();
        $result = $hb->generate($wordCount);

        $words = array_filter(preg_split('/(?=[A-Z])/', $result), null);
        $this->assertCount($wordCount, $words);
    }

    public static function expectedResultProvider(): array
    {
        return [
            [1], [2], [3], [4], [20]
        ];
    }

    public function testFailsForWordListNotFound(): void
    {
        $this->expectException(WordListFileNotFound::class);
        new HorseBattery('wakanda');
    }

    public function testFailsForWordListTooShort(): void
    {
        $this->expectException(WordListTooShort::class);
        new HorseBattery(null, [ 'lorem', 'ipsum', 'donut', 'sith', 'amen' ]);
    }

    public function testFailsForWordCountTooShort(): void
    {
        $this->expectException(WordCountTooShort::class);
        $hb = new HorseBattery();
        $hb->generate(0);
    }

    public function testGeneratesPasswordsWithSeparators(): void
    {
        $wordlist = [];
        for ($i = 0; $i != 10000; $i++) {
            $wordlist[] = "foo";
        }
        $hb = new HorseBattery('NL', $wordlist);

        $this->assertEquals('Foo-Foo-Foo', $hb->generate(3, '-'));
        $this->assertEquals('Foo-x--Foo-x--Foo', $hb->generate(3, '-x--'));
    }

    public function testDirectoryTraversalIssue(): void
    {
        $this->expectException(WordListFileNotFound::class);
        $this->expectExceptionMessage("Default wordlist detected out of config directory");
        $hb = new HorseBattery("../tests");
        $hb->generate(2);
    }
}
