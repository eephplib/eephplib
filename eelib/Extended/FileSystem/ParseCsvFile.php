<?php

namespace eelib\Functions\FileSystem\Extended
{
    use LogicException;
    use RuntimeException;
    use SplFileObject;

    trait ParseCsvFile
    {
        /**
         * @example https://twitter.com/lyrixx/status/1782797491705938032/
         *
         * @throws RuntimeException When the filename cannot be opened
         * @throws LogicException   When the filename is a directory
         */
        final public static function parseCsvFile(string $filename): SplFileObject
        {
            $csvFile = new SplFileObject($filename);
            $csvFile->setFlags(SplFileObject::READ_CSV);

            return $csvFile;
        }

    }
}
