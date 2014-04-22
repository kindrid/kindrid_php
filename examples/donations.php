<?php

require __DIR__.'/../vendor/autoload.php';

$k = new Kindrid\Kindrid('5134be9ac3dbf561a6667ab6', '6HEcePafzNyX0Z2vWrSgYFUktnDjqC3p');

$donations = $k->donations();
echo count($donations);
var_export($donations[0]->donor);