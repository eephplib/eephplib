<?php

print_r((new \eelib\ArrayList())->sort::ascending_sort([5,10,8]));
// print_r(\eelib\AArraySort::ascending_sort([5,10,8]));

?>
### EXPECTED ###

Array
(
[0] => 5
[1] => 8
[1] => 10
)