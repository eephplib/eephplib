<?php

namespace Extended
{
    use function array_map;
    use function array_merge;
    use function func_get_args;
    use function is_array;

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
        public static function push($array, $values): array
        {
            $args = func_get_args();

            unset($args[0]);

            return array_merge($array, $args);
        }

        /**
         * Push one or more elements onto the end of array with the associated key.
         * TODO: remove reference argument
         * TODO: Needs testing
         *
         * @param   $arr
         *
         * @return  int
         */
        public static function pushAssociative(&$arr): int
        {
            $args = func_get_args();
            $ret  = 0;

            foreach ($args as $arg)
            {
                if (is_array($arg))
                {
                    //self::pushAssociative($arg);

                    foreach ($arg as $key => $value)
                    {
                        $arr[$key] = $value;
                        $ret++;
                    }

                    continue;
                }

                $arr[$arg] = '';
            }

            return $ret;
        }
    }
}
