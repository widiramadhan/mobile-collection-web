<?php
//sql injection
function filter_str($string)
{
$filter = ereg_replace('[^a-zA-Z0-9_.]', '', $string); 
return $filter;
} 
?>