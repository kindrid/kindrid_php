<?php

require __DIR__.'/../vendor/autoload.php';

$k = new Kindrid\Kindrid(YOUR_KEY, YOUR_SECRET);

$donations = $k->donations();
echo count($donations);
var_export($donations[0]->donor);