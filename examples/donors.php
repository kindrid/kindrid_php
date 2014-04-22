<?php

require __DIR__.'/../vendor/autoload.php';

$k = new Kindrid\Kindrid('5134be9ac3dbf561a6667ab6', '6HEcePafzNyX0Z2vWrSgYFUktnDjqC3p');

$donors = $k->donors();
echo count($donors);
var_export($donors[0]->tags);