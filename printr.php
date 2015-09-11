<?php

/**
 * Plugin Name: Printr
 * Plugin URI: https://github.com/johansatge/printr
 * Description: A lightweight, simple var_dump replacement
 * Version: 1.0.0
 * Author: Johan Satgé
 * Author URI: http://johansatge.com
 * License: MIT
 */

if (!class_exists('Printr'))
{
    class Printr
    {

        public static function p($var, $echo = true, $show_context = true)
        {
            $html = '<pre style="' . self::styles() . '">' . ($show_context ? self::getContext() : '') . self::dumpVariable($var) . '</pre>';
            if ($echo)
            {
                echo $html;
            }
            return $html;
        }

        private static function dumpVariable($var, $depth = 0)
        {
            $type = strtolower(gettype($var));
            $html = self::wrap($type, '#999999') . ' ';
            switch ($type)
            {
                case 'boolean':
                    $html .= self::wrap($var ? 'true' : 'false', 'red');
                    break;
                case 'integer':
                case 'double':
                    $html .= self::wrap($var, 'blue');
                    break;
                case 'string':
                    $html .= self::wrap($var, 'green');
                    break;
                case 'array':
                case 'object':
                    $html .= '<br>' . self::indent($depth) . '(<br>';
                    foreach ($var as $key => $value)
                    {
                        $readable_key = $type === 'array' ? '["' . $key . '"] =&gt; ' : $key . ' -&gt; ';
                        $html .= self::indent($depth + 1) . $readable_key . self::dumpVariable($value, $depth + 1) . '<br>';
                    }
                    $html .= self::indent($depth) . ')';
                    break;
                case 'resource':
                    $html .= self::wrap('Resource', 'purple');
                    break;
                case 'null':
                    $html .= self::wrap('NULL', 'black');
                    break;
                default:
                    $html .= self::wrap($var, 'orange');
                    break;
            };
            return $html;
        }

        private static function indent($depth)
        {
            return str_repeat('&nbsp;', 4 * $depth);
        }

        private static function wrap($thing, $color)
        {
            return '<span style="color: ' . $color . '">' . $thing . '</span>';
        }

        private static function getContext()
        {
            $trace = debug_backtrace();
            $info  = !empty($trace[2]['file']) ? str_replace($_SERVER['DOCUMENT_ROOT'], '', $trace[2]['file']) : '';
            $info .= !empty($trace[2]['line']) ? ':' . $trace[2]['line'] : '';
            return !empty($info) ? $info . '<br>' : '';
        }

        private static function styles()
        {
            return implode(';', array(
                'z-index: 999',
                'margin: 10px',
                'display: block',
                'background: #efefef',
                'color: black',
                'font-family: Courier',
                'border: 1px solid #cccccc',
                'padding: 10px',
                'font-size: 12px',
                'line-height: 15px',
                'border-radius: 3px'
            ));
        }

    }

    if (!function_exists('printr'))
    {
        function printr($var, $echo = true)
        {
            return Printr::p($var, $echo);
        }
    }
}
