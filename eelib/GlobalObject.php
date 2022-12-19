<?php

namespace eelib
{
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
    }
}
