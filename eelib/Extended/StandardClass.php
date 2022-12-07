<?php

namespace Extended
{
    use \ArrayIterator;

    /**
     * Class StandardClass Extended
     *
     * @package eelib
     * @version 2022.12.06
     *
     */
    class StandardClass
    {

        /**
         * Count a stdClass or object.
         *
         * @param   object  $object_or_class
         *
         * @return  int     Return the count of objects found.
         */
        public static function count(object $object_or_class) : int
        {
            return (new ArrayIterator($object_or_class))->count();
        }
    }
}