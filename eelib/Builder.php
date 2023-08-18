<?php

namespace eelib;

class SubjectDataValue
{
    protected string $subjectDataValue;

    private function __construct($subjectDataValue)
    {
        $this->subjectDataValue = $subjectDataValue;
    }
}

class Builder
{
    public static function String(string $dataValue): object
    {
        return new class($dataValue) extends SubjectDataValue {

            public function regular_expression_split(string  $pattern,
                                                     int     $limit = -1): string
            {
                return BinaryString::regular_expression_split($this->subjectDataValue, $pattern, $limit);
            }

            // length
            // indexOf
            // toUpperCase
            // toLowerCase
            // replace
        };
    }

    public static function Math(mixed $dataValue): object
    {
        // round
        // random
        // floor
        // ceil
        // sqrt
        // sin
    }

    public static function Array(array $dataValue): object
    {
        // length
        // sort
        // filter
        // map
        // reduce
    }

    public static function Date(string $dataValue): object
    {
        // now
        // toLocateDateString
        // toISOString
        // toGetTime
    }
}


Builder::String('test')->regular_expression_split();