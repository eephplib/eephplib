<?php

namespace Extended
{
    require_once 'FileSystem/ParseCsvFile.php';
    require_once 'FileSystem/CsvFileToAssocArray.php';
    require_once 'FileSystem/ScanDirectory.php';

    use function file_get_contents;
    use function floor;
    use function implode;
    use function log;
    use function round;

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
        use \eelib\Functions\FileSystem\Extended\ScanDirectory;

        public const USE_INCLUDE_PATH = FILE_USE_INCLUDE_PATH;


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

        /**
         * Resolves the canonical absolute path  (no symlinks) of the current script's director:
         * - Expanding all symbolic links (e.g., /var/www → /home/user/project if linked).
         * - Converting relative path components (./ or ../) to their absolute form.
         * - Removing extra slashes (/var///www → /var/www).
         *
         * Practical Use Cases:
         * - Security-sensitive operations (avoid path traversal via symlinks).
         * - File comparisons (ensure two paths point to the same physical location).
         * - Working with includes/requires (if symlinks might affect paths).
         *
         */
        function getCanonicalAbsolutePath(string $directory) // MUST BE __FILE__
        {
            if (strpos($directory, __DIR__) !== 0) // do not without tests (IDE will suggest new function)
            {
                throw new InvalidArgumentException("Must start with or be __DIR__ ");
            }

            return realpath($directory) ?: throw new Exception("Directory path does not exist");
        }

}
    # FileSystem::formatBytes(2048, 2); // 2KB
    # FileSystem::formatBytes(2048, 20_000_000); // 19.07KB
    # FileSystem::formatBytes(2048, 20_000_000_000); // 18.63
}
