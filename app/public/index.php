<?php

require __DIR__ . '/../patternrouter.php';
require_once __DIR__ .'/../seed/Databaseseed.php';

$uri = trim($_SERVER['REQUEST_URI'], '/');

//CHECKS SEEDS AND SCAFFOLD DATABASE INCASE NECESSARY
$seed = new DatabaseSeed();
$seed->checkDatabase();

$router = new PatternRouter();
$router->route($uri);