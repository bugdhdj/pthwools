<?php
require_once("src/Constant/Constant.php");
require_once("src/Interface/Collectable.php");
require_once("src/Interface/ThreadedInterface.php");
require_once("src/Threaded.php");

$safe = new Threaded();
$safe['666'] = 233;
while (count($safe) < 10) {
    $safe[] = count($safe);
}

var_dump($safe->chunk(5));
var_dump($safe->chunk(6));
var_dump($safe->chunk(5));