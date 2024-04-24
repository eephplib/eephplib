<?php


namespace Extended
{

    use eelib\Exception\PathNotFoundException;

    /**
     * TODO: turn methods into traits
     *
     * Class FileSystem Extended
     * Custom User Functions
     */
    class FileSystem
    {
        public static function listFiles($path, &$files = []): array
        {
            if (!is_dir($path))
            {
                throw new PathNotFoundException($path.' Path not found.')
            }

            $handle = opendir($path);

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

            return $files;
        }

        /**
         * Convert file sizes to a human-readable string format.
         *
         * @link    https://stackoverflow.com/questions/15188033/human-readable-file-size/28047922#28047922
         * @param   int $size
         * @param   int $precision
         *
         * @return string
         */
        public static function formatBytes(int $size, int $precision = 1): string
        {
            $unitSuffixList = ['', 'KB', 'MB', 'GB', 'TB'];
            $exponent       = floor(log($size, 1024));
            $calculation    = round($size / (1024 ** $exponent), $precision);

            return \implode(' ', [$calculation, $unitSuffixList[$exponent]]);
        }
    }

    # FileSystem::formatBytes(2048, 2); // 2KB
    # FileSystem::formatBytes(2048, 20_000_000); // 19.07KB
    # FileSystem::formatBytes(2048, 20_000_000_000); // 18.63
}
