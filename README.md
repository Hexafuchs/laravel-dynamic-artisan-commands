# Moved to https://codeberg.org/Hexafuchs/laravel-dynamic-artisan-commands

# Library for dynamic replacement of artisan commands

[![Latest Version on Packagist](https://img.shields.io/packagist/v/hexafuchs/laravel-dynamic-artisan-commands.svg?style=flat-square)](https://packagist.org/packages/hexafuchs/laravel-dynamic-artisan-commands)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/hexafuchs/laravel-dynamic-artisan-commands/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/hexafuchs/laravel-dynamic-artisan-commands/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/hexafuchs/laravel-dynamic-artisan-commands/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/hexafuchs/laravel-dynamic-artisan-commands/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/hexafuchs/laravel-dynamic-artisan-commands.svg?style=flat-square)](https://packagist.org/packages/hexafuchs/laravel-dynamic-artisan-commands)

This package aims to deliver a universal interface to replace artisan commands. Sadly, the original package leaves not 
much possibility to do this. I wanted to create something that does not crash when others want to overwrite these 
commands as well and is reusable. 

> [!WARNING]
> Please note that this library is in an early alpha stage. Any feedback is welcome. Currently, I am primarily worried 
> if the order of the providers could prevent the commands from being registered. Please feel free to open issues or 
> create discussions.

## Installation

You can install the package via composer:

```bash
composer require hexafuchs/laravel-dynamic-artisan-commands
```

## Usage

Within your `register()` method, add the following snippet. (If you use the spatie package helper, overwrite the 
`registeringPackage()` function)

```php
DynamicArtisanServiceProvider::registerCommand('CommandName', CommandNameCommand::class, NewCommandNameCommand::class, false);
```

The first argument is the name of the command. If your command goes like `command:name`, you should write this in 
UpperCamelCase notation, i.e. `CommandName`. Have a look at `\Illuminate\Foundation\Providers\ArtisanServiceProvider`
for a list of all existing command names. 

If you want to overwrite an existing command, the second argument is the original command class and the third argument
is either your new command class that extends the original command class, or a closure that initializes an object of 
your new command class.

If you want to create a new command instead, the second argument is your command class, and the third argument is 
either null or a closure that initializes an object of your command class. 

The fourth argument is used to define a dev command instead of a normal command. I left this possibility in here, note
that there seems to be no functional difference between these types. Most likely they are only used for semantic
separation of commands.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
