<?php

namespace eelib
{
    use function file_exists;

    /**
     * Class FileSystem
     *
     * @package eelib
     * @version 2023.06.14
     */
    class FileSystem extends \Extended\FileSystem implements \eelib\CollectiveContract\Exists
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
            return file_exists($filename);
        }
    }
}
