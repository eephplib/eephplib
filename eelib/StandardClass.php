<?php

namespace eelib
{
    class StandardClass
    {
        /**
         * Checks if the object or class has a property.
         *
         * @link    https://php.net/manual/en/function.property-exists.php
         *
         * @param   object|string   $object_or_class    The class name or an object of the class to test for
         * @param   string          $property           The name of the property

         * @return  bool                                Return true if the property exists,
         *                                              else false if it doesn't exist
         *                                              or null in case of an error.
         */
        public static function has_property($object_or_class, string $property) : bool
        {
            return property_exists($object_or_class, $property);
        }
    }
}
