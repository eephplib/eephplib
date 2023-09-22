<?php

namespace eelib
{
    require_once 'Extended/StandardClass.php';

    use \RuntimeException;

    use function \property_exists;
    use function \class_parents;
    use function \array_merge;
    use function \class_uses;

    class StandardClass extends \Extended\StandardClass
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
        public static function has_property(object|string $object_or_class, string $property) : bool
        {
            return property_exists($object_or_class, $property);
        }

        /**
         * Returns an array of traits used by the given class,
         *
         * @link    https://www.php.net/manual/en/function.class-uses.php
         *
         * @param   object|string   $object_or_class    An object (class instance) or a string (class name).
         * @param   bool            $autoload           Whether to autoload if not already loaded.
         * @param   bool            $parentClasses      Including those used by parent classes.
         *
         * @return array            The names of the traits that the given object_or_class uses.
         */
        public static function usedTraits(
            object|string   $object_or_class,
            bool            $autoload      = true,
            bool            $parentClasses = false) : array
        {
            $traits = class_uses($object_or_class, $autoload);

            if ($parentClasses)
            {
                $parentClassList = class_parents($object_or_class, $autoload);

                foreach ($parentClassList as $parentClass)  // TODO: can we move this array_merge out of the loop?
                {
                    $traits = array_merge($traits, class_uses($parentClassList, $autoload));
                }
            }

            if (empty($traits))
            {
                throw new RuntimeException('given class doesn\'t exist.');
            }
        }
    }
}
