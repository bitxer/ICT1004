<?php
function get(&$val, $default=null){
    return isset($val) ? $val : $default;
}
?>