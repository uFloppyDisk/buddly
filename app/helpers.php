<?php

if (!function_exists('get_names_from_string')) {
    function get_names_from_string($name) {

        $split = explode(" ", $name);
    
        $amount = count($split);
    
        $first = $split[0];
        $middles = [""];
        $last = "";
    
        if ($amount > 1) {
            $last = end($split);
        
            if ($amount > 2) {
                $middles = array_slice($split, 1, $amount - 1);
            }
        }
    
        return [$first, $middles, $last];
    }
}