<?php declare(strict_types = 1);

$load = new \Twig\Loader\FilesystemLoader( __DIR__ . '/Views/');
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => '',
    'username'  => 't',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$rules = [ 
	'Twig\Environment' => [
		'shared' => true,
		'constructParams'   =>  [$load, [ 'cache' => false, 'debug' => 'true']]
	],

];

$dice = new \Dice\Dice;
$dice = $dice->addRules($rules);

