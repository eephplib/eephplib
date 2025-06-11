<?php

namespace eelib
{
    use function \file_exists;

    require_once 'Extended/FileSystem.php';

    /**
     * Class FileSystem
     *
     * @package eelib
     * @version 2023.06.14
     */
    class FileSystem extends \Extended\FileSystem implements \eelib\CollectiveContract\Exists
    {

        /**
         * @throws \Exception
         */
        function getCurrentWorkingDirectory()
        {
            // this might need to be a parameter (requires testing for confirmation)
            return getcwd() ?: throw new \Exception("getcwd() returned false and NOT <string>");
        }

        /**
         * Checks whether a file or directory exists.
         *
         * @link    http://php.net/manual/en/function.file-exists.php
         * @since   PHP 4
         *
         * @param   string  $filename Path to the file or directory.
         *
         * @return  bool    Returns TRUE if the file or directory specified by filename exists; FALSE otherwise.
         */
        public static function exists(string $filename) : bool
        {
            return file_exists($filename);
        }
    }
}
