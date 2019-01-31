<?php

namespace App\Helpers;

class CustomHelper
{
    public static function formataNome($fullname)
    {
        $fullname = explode(' ', trim($fullname));
        $firstname = $fullname[0];
        $lastname = '';
        if (count($fullname) > 1) {
            $lastname = $fullname[count($fullname) - 1];
        }
        return trim($firstname . ' ' . $lastname);
    }
}