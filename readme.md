# Configer

This library loads/saves php array from/to a configuration file.

## Installation

```shell
$ composer require piotrpress/configer
```

## Usage

```php
require __DIR__ . '/vendor/autoload.php';

use PiotrPress\Configer;

$config = new Configer( '.config', [
    'key' => 'value'
] );

echo $config[ 'key' ]; 
$config[ 'key' ] = 'new_value';

$config->save();
```

## Requirements

* Branch `2.x` supports PHP >= `8.0` version.
* Branch `1.x` supports PHP ^`7.4` version.

## License

[MIT](license.txt)