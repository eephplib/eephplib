<?php

namespace Extended
{
    require_once 'ArrayList/Push.php';
    require_once 'ArrayList/PushAssociative.php';


    /**
     * Class ArrayList Extended
     * Custom User Functions
     */
    class ArrayList
    {
        use \eelib\Functions\ArrayList\Extended\Push;
        use \eelib\Functions\ArrayList\Extended\PushAssociative;
    }
}
