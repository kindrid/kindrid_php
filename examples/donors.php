<?php

require __DIR__.'/../vendor/autoload.php';

$k = new Kindrid\Kindrid(YOUR_KEY, YOUR_SECRET);

$donors = $k->donors();
echo count($donors);
var_export($donors[0]->tags);