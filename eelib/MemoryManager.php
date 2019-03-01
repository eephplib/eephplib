<?php

namespace eelib
{
    /**
     * Class MemoryManager
     *
     * @package eelib
     * @version 2019.03.01
     */
    class MemoryManager
    {
        /**
         * Returns the amount of memory, in bytes, that's currently being allocated to your PHP script.
         *
         * @link    http://php.net/manual/en/function.memory-get-usage.php
         * @since   PHP 5.2.1
         *
         * @param bool  $real_usage     Set this to TRUE to get total memory allocated from system,
         *                              including unused pages.
         *                              If not set or FALSE only the used memory is reported.
         *
         * @return int  Returns the memory amount in bytes.
         */
        public static function get_allocated_amount(bool $real_usage = FALSE) : int
        {
            return \memory_get_usage($real_usage);
        }
    }
}

