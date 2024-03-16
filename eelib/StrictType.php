<?php


namespace eelib
{
    use function \empty;
    use function \is_string;
    use function \is_float;
    use function \is_int;
    use function \is_bool;
    use function \is_object;
    use function \is_array;

    class ExtendedStrictType
    {
        public static function isStdClass(mixed $arg): bool
        {
            return $arg instanceof \stdClass;
        }


        public static function isObjectOfClass(object $object, string $class): bool
        {
            return $object instanceof $class;
        }

        public static function isObjectOfClassList(object $object, array $classList): bool
        {
            foreach ($classList as $className)
            {
                \assert(
                    assertion:   \is_string($className),
                    description: 'Element within $classList array is not a class name string.'
                );

                if ($object instanceof $className)
                {
                    return true;
                }
            }

            return false;
        }
        // Test
        // if (!isObjectOfClassList($entity, ['User','Order','Product']));

        public static function validateNotString(mixed  $value): void
        {
            if (is_string( $value)) {
                throw new \Exception('value type is not a string');
            }
        }

        public static function validateNotNull(mixed $value): void
        {
            if ($value === null) {
                throw new \Exception('value type is not a null');
            }
        }
    }

    /**
     * Type-checking functions #
    is_array()
    is_bool()
    is_callable()
    is_float() / is_double() / is_real()
    is_int() / is_integer() / is_long()
    is_numeric()
    is_iterable()
    is_null()
    is_object()
    is_resource()
    is_scalar()
    is_string()
    is_subclass_of()
    is_a()
     */
    class StrictType extends ExtendedStrictType
    {
        /**
         * Determine whether a variable is considered to be empty.
         * A variable is considered empty if it does not exist
         * or if its value equals false.
         *
         * @link    https://php.net/manual/en/function.empty
         * @example https://www.php.net/manual/en/function.empty.php#114267
         *
         * @param   mixed   $var    Variable to be checked.
         *
         * @return  bool            Returns true if var does not exist or
         *                          has a value that is empty or equal to zero,
         *                          known as false-like; see conversion to boolean.
         *                          Otherwise, returns false.
         */
        public static function isEmpty($var) : bool
        {
            return empty($var);
        }

        /**
         * Finds whether the type of the given variable is string.
         *
         * https://www.php.net/manual/en/function.is-string.php
         *
         * @param mixed $value  The variable being evaluated.
         *
         * @return bool         Returns true if value is of type string, false otherwise.

         */
        public static function isString($value) : bool
        {
            return is_string($value);
        }

        /**
         * https://www.php.net/manual/en/function.is-float.php
         *
         * @param $value
         *
         * @return bool
         */
        public static function isFloat($value) : bool
        {
            return is_float($value);
        }

        /**
         * https://www.php.net/manual/en/function.is-int.php
         *
         * @param $value
         *
         * @return bool
         */
        public static function isInteger($value) : bool
        {
            return is_int($value);
        }

        /**
         * https://www.php.net/manual/en/function.is-bool.php
         *
         * @param $value
         *
         * @return bool
         */
        public static function isBoolean($value) : bool
        {
            return is_bool($value);
        }

        /**
         * https://www.php.net/manual/en/function.is-object.php
         *
         * @param $value
         *
         * @return bool
         */
        public static function isObject($value) : bool
        {
            return is_object($value);
        }

        /**
         * https://www.php.net/manual/en/function.is-array.php

         *
         * @param $value
         *
         * @return bool
         */
        public static function isArray($value) : bool
        {
            return is_array($value);
        }
    }
}
