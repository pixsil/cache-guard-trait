<?php

// version 1

namespace App\Traits;

trait CacheTrait
{
    private $cache = [];
    private $filling_cache = [];

    public function cache($func, $args)
    {
        // guard get name
        if (!$full_func_name = $func .'('.implode(',', $args).')') {
            return false;
        }
        // guard if is filling run the original function
        if (isset($this->filling_cache[$full_func_name])) {
            return false;
        }
        // guard already in cache
        if (isset($this->cache[$full_func_name])) {
            return true;
        }

        // set filling_cache so we know that we skip the second cache function call
        $this->filling_cache[$full_func_name] = true;

        // run the original function and skip the cache function
        $this->cache[$full_func_name] = $this->$func(...$args);

        // make sure we get through the next time we call the cache function
        unset($this->filling_cache[$full_func_name]);

        return true;
    }
}
