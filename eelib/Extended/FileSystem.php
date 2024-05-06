<?php

namespace Extended
{
    require_once 'FileSystem/ParseCsvFile.php';

    use eelib\Exception\PathNotFoundException;

    use function file_get_contents;
    use function floor;
    use function implode;
    use function is_dir;
    use function log;
    use function opendir;
    use function preg_match;
    use function readdir;
    use function round;

    use const __FUNCTION__;
    use const FILE_USE_INCLUDE_PATH;

    /**
     * TODO: turn methods into traits
     *
     * Class FileSystem Extended
     * Custom User Functions
     */
    class FileSystem
    {
        use \eelib\Functions\FileSystem\Extended\ParseCsvFile;

        public const USE_INCLUDE_PATH = FILE_USE_INCLUDE_PATH;

        public static function listFiles($path, &$files = []): array
        {
            if (!is_dir($path))
            {
                throw new PathNotFoundException($path.' Path not found.');
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

            return implode(' ', [$calculation, $unitSuffixList[$exponent]]);
        }


        public static function getContents(
            string $filename,
            bool   $use_include_path = self::USE_INCLUDE_PATH,
            int    $offset           = 0,
            int    $length           = null
        ):  string
        {
            return file_get_contents(
                filename:         $filename,
                use_include_path: $use_include_path,
                offset:           $offset,
                length:           $length
            ) ?? '';
        }

        // public static function putContents() { file_put_contents(); }

}
    # FileSystem::formatBytes(2048, 2); // 2KB
    # FileSystem::formatBytes(2048, 20_000_000); // 19.07KB
    # FileSystem::formatBytes(2048, 20_000_000_000); // 18.63
}
