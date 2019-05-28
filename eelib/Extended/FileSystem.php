<?php


namespace Extended
{
    /**
     * Class FileSystem Extended
     * Custom User Functions
     */
    class FileSystem
    {
        public static function getfiles($path, &$files = array())
        {
            if ( !is_dir( $path ) ) return null;
            $handle = opendir( $path );

            while ( false !== ( $file = readdir( $handle ) ) )
            {
                if ( $file != '.' && $file != '..' )
                {
                    $path2 = $path . '/' . $file;
                    if ( is_dir( $path2 ) ) {
                        self::{__FUNCTION__}( $path2 , $files );
                    } else {
                        if ( preg_match( "/\.(php|php5)$/i" , $file ) ) {
                            $files[] = $path2;
                        }
                    }
                }
            }

            return $files;
        }
    }
}
