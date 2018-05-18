<?php

namespace App;

use Sober\Controller\Controller;

class Contacts1 extends Controller
{
    public static function location()
    {
        $style = get_field('style');
        //var_dump($style);
        return (object) array(
            'lat' => get_field('lat'),
            'lng' => get_field('lng'),
            'animation' => get_field('animation'),
            'marker' => get_field('marker'),
            'style' => $style 
        );
    }

}