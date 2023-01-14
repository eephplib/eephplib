<?php

namespace eelib
{
    /**
     * @link https://www.php.net/manual/en/reserved.variables.globals.php
     */
    final class GlobalObject
    {
        public static function get($object_name)
        {
            $object = false;

            if (isset($GLOBALS))
            {
                $object_name = trim($object_name);

                if (isset($GLOBALS[$object_name]))
                {
                    $object = $GLOBALS[$object_name];
                }
            }

            return $object;
        }

        public static function getAll() : array
        {
            return $GLOBALS;
        }
    }
}
