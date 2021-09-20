# PHP Cache Guard Trait

## What is it?

This is a small piece of code what implements caching functionality to your application.

## Donate

Find this project useful? You can support me on Patreon

https://www.patreon.com/pixsil

## Installation

Put the trait somewhere into your application and make sure the file is loaded.

Laravel users can use the following script to download the trait into the right place.
```bash
mkdir -p app/traits
wget -O app/traits/CacheTrait.php https://raw.githubusercontent.com/pixsil/php-cache-guard-trait/e49442bee7754ca13b8be6c6b3f46d058faeb7f0/Traits/CacheTrait.php
```

## Usage

Add the trait to your class.

```php
<?php

use App\Traits\StorageTrait;

class MyModel
{
    use CacheTrait;
}
```

And use the following snipped on the begin of your function.

```php
// cache guard
if ($this->cache(__FUNCTION__, func_get_args())) {
    return $this->cache[__FUNCTION__ .'('.implode(',', func_get_args()).')'];
}
```

The snipped checks if it has an cached version in the cache array of the trait. This is based on the function name and the parameters. If there isnt a cached version it will automaticly run the function and stores the output in the cache array.



## Example

An full Laravel example. Not realy an heavy function, but you get the point.

```php
<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Traits\CacheTrait;

    class Car extends Model
    {
        protected function getColorDescription()
        {
          // cache guard
          if ($this->cache(__FUNCTION__, func_get_args())) {
              return $this->cache[__FUNCTION__ .'('.implode(',', func_get_args()).')'];
          }
          
          return 'The color of the car is:'. $this->color;
        }
    }

```
