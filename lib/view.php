<?php namespace Roots\Sage;

class View
{
    public static function render( $file, $params = [] )
    {
        extract( $params );
        ob_start();
        include( locate_template($file) );
        return ob_get_clean();
    }
}