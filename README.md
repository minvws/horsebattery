# HorseBattery password generator

A password generator based on [this XKCD comic](https://xkcd.com/936/). 
Provides a default word list in Dutch and will generate a password based on
the wordlist and a given number of words.

May be expanded to include other locales in the future or configuration to 
allow for other word lists.

## Requirements
- PHP >= 8.1
- Composer

## Installation
1. Install the package via composer:
  ```sh
  composer require minvws/horsebattery
  ```

# Usage

Generic usage
```php
$generator = new HorseBattery();
$password = $generator->generate(4);

// returns for instance: AandeelBijkomendeDereguleringHandelingen
```


# Running tests
You can run the tests by issuing the following command:

```Bash
$ composer run test
```

# Contributing
If you encounter any issues or have suggestions for improvements, please feel free to open an issue or submit a pull request on the GitHub repository of this package.

# License
This package is open-source and released under the European Union Public License version 1.2. You are free to use, modify, and distribute the package in accordance with the terms of the license.
