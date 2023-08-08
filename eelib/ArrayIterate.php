<?php

declare(strict_types=1);

namespace eelib
{
    class ArrayIterate
    {
        public ArrayCollection $collection;

        public function __construct()
        {
            $this->collection = new ArrayCollection;
        }

        // array_walk  https://www.php.net/manual/en/function.array-walk.php
        // array_map    https://www.php.net/manual/en/function.array-map.php
        //              https://www.geeksforgeeks.org/php-array_map-function/
        // array_filter   https://www.php.net/manual/en/function.array-filter.php
    }
}
