<?php

namespace eelib
{
    /**
     * Class FileSystem
     *
     * @package eelib
     * @version 2019.03.04
     */
    class FileSystem
    {
        public static function cvs_file_to_assoc_array(string $filename, string $delimiter = ',') : array
        {}

        /**
         * Checks whether a file or directory exists.
         *
         * @link    http://php.net/manual/en/function.file-exists.php
         * @since   PHP 4
         *
         * @param   string  $filename   Path to the file or directory.
         *
         * @return  bool    Returns TRUE if the file or directory specified by filename exists; FALSE otherwise.
         */
        public static function exists(string $filename) : bool
        {
            return \file_exists($filename);
        }
    }
}
