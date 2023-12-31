<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

class Helper
{
    public static function format_numbers($my_number)
    {
        $number_decimals = 2;
        $dec_separator = ".";
        $thousands_separator = ",";
        return number_format($my_number, $number_decimals, $dec_separator, $thousands_separator);

    }

    public static function format_number_db($my_number)
    {
      
        return (float) str_replace(',', '', $my_number);

    }
}