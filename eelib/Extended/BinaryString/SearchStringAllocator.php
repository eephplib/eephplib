<?php

namespace eelib\Functions\BinaryString\Extended
{
    use function \array_filter;
    use function \explode;
    use function \str_replace;
    use function \strlen;
    use function \strtolower;
    use function \trim;

    // TODO: This needs to be tested.
    trait SearchStringAllocator
    {

        private static int $safe_length = 0;

        final public static function searchStringAllocator(
            string  $search_string,
            int     $safe_length = 3
        ) : array
        {
            // $safe_length cannot be below 0 throwargument

            $search_string = strtolower(trim($search_string));
            $keywords      = []; // is this a list or array?

            if (strlen($search_string) >= $safe_length)
            {
                self::$safe_length = $safe_length;
                $removals          = [
                    '~', '~', '@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '_', '+', '=',
                    ',', '.', '?', '/', ':', ";", '"', '\'', '[', '{', ']', '}', '|', '\\'
                ];

                $search_string   = str_replace($removals, ' ', $search_string);
                $search_keywords = explode(' ', $search_string);
                $keywords        = array_filter( // perhapos this should be an function entirely?
                                    array:    $search_keywords,
                                    callback: [__CLASS__, '_callbackKeywords']
                                   );

                /*
                $keywords        = array_filter(array:    $search_keywords,
                                                callback: static function ($data)
                                                          use             ($safe_length)
                {
                    if (strlen($data) >= $safe_length)
                    {
                        return $data;
                    }
                    // TODO: what is teh default return (avoid null)?
                });

                */
            }

            return array_values($keywords);

        }

        private static function _callbackKeywords(string $data)
        {
            if (strlen($data) >= self::$safe_length)
            {
                return $data;
            }
            // TODO: what is teh default return (avoid null)?
        }

// ?q=this%20is%20my%20name.is%20cool%20-%20name-caller

        /*
        Array
        (
            [0] => this
            [1] => name
            [2] => cool
            [3] => name
            [4] => caller
        )
        */

    }
}