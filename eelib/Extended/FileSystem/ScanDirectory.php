<?php

namespace eelib\Functions\FileSystem\Extended
{
    use function closedir;
    use function opendir;
    use function preg_match;
    use function readdir;
    use function is_dir;

    use eelib\Exception\PathNotFoundException;
    use LogicException;
    use RuntimeException;
    use SplFileObject;

    use const __FUNCTION__;

    trait ScanDirectory
    {

        final public static function scanDirectory($path, &$files = []): array
        {
            if (!is_dir($path))
            {
                throw new PathNotFoundException($path.' Path not found.');
            }

            $handle = opendir($path);

            if ($handle === false)
            {
                throw new RuntimeException($path.' could not be opened.');
            }

            try
            {
                while (($file = readdir($handle)) !== FALSE)
                {
                    if ($file !== '.' && $file !== '..')
                    {
                        // TODO: add proper concatenation
                        $path2 = $path.'/'.$file;

                        if (is_dir($path2))
                        {
                            self::{__FUNCTION__}($path2, $files);
                        }
                        elseif (preg_match("/\.(php|php5)$/i" , $file))
                        {
                            $files[] = $path2;
                        }
                    }
                }
            }
            finally
            {
                closedir($handle);
            }

            return $files;
        }
    }
}
