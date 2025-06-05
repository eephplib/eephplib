<?php

namespace Extended
{
    require_once 'ArrayList/Push.php';

    use function func_get_args;
    use function is_array;

    /**
     * Class ArrayList Extended
     * Custom User Functions
     */
    class ArrayList
    {
        use \eelib\Functions\ArrayList\Extended\Push;

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
