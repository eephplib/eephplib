<?php

namespace Extended
{
    /**
     * Class ArrayList Extended
     * Custom User Functions
     */
    class ArrayList
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
        public static function push($array, $values)
        {
            $args = \func_get_args();

            unset($args[0]);

            $args = \array_merge($array, $args);

            return $args;
        }

        /**
         * Push one or more elements onto the end of array with the associated key.
         * TODO: remove reference argument
         *
         * @param   $arr
         *
         * @return  int
         */
        public static function push_associative(&$arr)
        {
            $args = \func_get_args();
            $ret  = 0;

            foreach ($args as $arg)
            {
                if (\is_array($arg))
                {
                    foreach ($arg as $key => $value)
                    {
                        $arr[$key] = $value;
                        $ret++;
                    }
                }
                else
                {
                    $arr[$arg] = '';
                }
            }

            return $ret;
        }
    }
}
