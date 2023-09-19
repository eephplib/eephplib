<?php


namespace Extended
{
    /**
     * TODO: turn methods into traits
     *
     * Class FileSystem Extended
     * Custom User Functions
     */
    class FileSystem
    {
        public static function getFiles($path, &$files = array())
        {
            if (!is_dir($path))
            {
                return null; // TODO: no nullpointing -> throw exception
            }

            $handle = opendir($path);

            while (($file = readdir($handle)) !== false)
            {
                if ($file !== '.' && $file !== '..')
                {
                    // TODO: add proper concatenation
                    $path2 = $path.'/'.$file;

                    if (is_dir($path2))
                    {
                        self::{__FUNCTION__}($path2, $files);
                    }
                    elseif ( preg_match( "/\.(php|php5)$/i" , $file ) )
                    {
                        $files[] = $path2;
                    }
                }
            }

            return $files;
        }
    }
}
