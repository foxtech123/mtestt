<?php

namespace App\Http\Helper;

use Illuminate\Support\Str;
use DateTime;

class Common
{
      /*
    * @slugify
    * credit to Carlos Delgado
    * original link https://ourcodeworld.com/articles/read/253 creating-url-slugs-properly-in-php-including-transliteration-support-for-utf-8
    */
    public static function slugify($string = null, $length = null)
    {
        if($string) {
            return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
        }

        $time = strtotime(date('Y-m-d H:i:s'));
        return substr($time, 0, 5).Str::random($length ?? 10).substr($time, 6, 11);
    }

    public static function timeElapseString($datetime, $full = false): string
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) {
            $string = array_slice($string, 0, 1);
        }

        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}
