<?php

namespace eelib\Functions\ArrayList\Extended
{
    use function \func_get_args;
    use function \is_array;

    trait PushAssociative
    {
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
