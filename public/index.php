<?php
// Iniciar errores
ini_set('display_errors', 1);
ini_set('display_starup_error', 1);
error_reporting(E_ALL);

// Cargar todos los archivos
require_once '../vendor/autoload.php';

// Eloquent 
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'cursophp',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();


// Show info
$route = $_GET['route'] ?? '/';

if($route == '/'){
  require '../index.php';
}elseif($route == 'addJob'){
  require '../addJob.php';
}