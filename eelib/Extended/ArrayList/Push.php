<?php

namespace eelib\Functions\ArrayList\Extended
{
    use function \func_get_args;
    use function \array_merge;
    use function \unset;

    trait Push
    {
        /**
         * Push one or more elements onto the end of array
         *
         * @link    http://php.net/manual/en/function.array-push.php
         *
         * @param   $array
         * @param   $values
         *
         * @return  array   Returns the updated array with the new element.
         */
        final public static function push($array, $values): array
        {
            $args = func_get_args();

            unset($args[0]);

            return array_merge($array, $args);
        }
    }
}
