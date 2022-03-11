<?php

if(!function_exists('shorten_string')) {
    function shorten_string($string, $length) {
        if (strlen($string)>$length) {
            $var =  substr($string,0,$length).'...';
        } else {
           $var = $string;
        }
        return $var; 
    }
}   


if(!function_exists('naira')) {
    function naira() {  return '&#8358;';  }
}


if(!function_exists('js_alert')) {
    function js_alert($msg) { echo '<script> alert("'.$msg.'") </script>'; return null; }
}    