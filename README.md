# HorseBattery password generator

A password generator based on [this XKCD comic](https://xkcd.com/936/). 
Provides a default word list in Dutch and will generate a password based on
the wordlist and a given number of words.

May be expanded to include other locales in the future or configuration to 
allow for other w ord lists.

## Requirements
- PHP >= 8.0

## Installation
1. Install the package via composer:
  ```sh
  composer require minvws/horsebattery
  ```

# Usage

```php

$generator = new HorseBattery();
$password = $generator->generate(4);

// returns for instance: AandeelBijkomendeDereguleringHandelingen
```


# Running tests

You can run the tests by issuing the following command:

    $ composer run test
