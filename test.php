<?php

require_once 'printr.php';

$samples     = array(
    $array = array('foo', 'bar'),
    $int = 10,
    $float = 10.5,
    $string = 'Sample string',
    $object = new stdClass()
);
$object->foo = $array;
$object->bar = $string;

foreach ($samples as $sample)
{
    printr($sample);
}