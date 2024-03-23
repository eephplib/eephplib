<?php

namespace Extended
{
    require_once 'BinaryString/IsColorHex.php';
    require_once 'BinaryString/IsEqual.php';
    require_once 'BinaryString/SearchStringAllocator.php';
    require_once 'BinaryString/Split.php';

    /**
     * Class BinaryString Extended
     * Custom User Functions
     */
    class BinaryString
    {
        use \eelib\Functions\BinaryString\Extended\IsColorHex;
        use \eelib\Functions\BinaryString\Extended\IsEqual;
        use \eelib\Functions\BinaryString\Extended\SearchStringAllocator;
        use \eelib\Functions\BinaryString\Extended\Split;
    }
}
