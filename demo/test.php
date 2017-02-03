<?php
// after command  'composer install'

require __DIR__."/../src/FizzTernary.php";

use Fizzday\FizzTernary\FizzTernary;

$id = 19;
$res = FizzTernary::getLayers($id);
print_r($res); // 4

