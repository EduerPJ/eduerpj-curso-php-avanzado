<?php
// Iniciar errores
ini_set('display_errors', 1);
ini_set('display_starup_error', 1);
error_reporting(E_ALL);

// Cargar todos los archivos
require_once '../vendor/autoload.php';
session_start();
// Eloquent
use Illuminate\Database\Capsule\Manager as Capsule;
// Aura Router
use Aura\Router\RouterContainer;

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

// Requuest
$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

// Iniciar contenedor de rutas
$routerContainer = new RouterContainer();
// Obtener mapa de rutas
$map = $routerContainer->getMap();
// Podemos agregarle cosas a estas rutas
// Definir ruta
$map->get('index', '/platzi_php/', [
  'controller' => 'App\Controllers\IndexController',
  'action' => 'IndexAction'
]);

$map->get('addJobs', '/platzi_php/jobs/add', [
  'controller' => 'App\Controllers\JobsController',
  'action' => 'getAddJobAction',
  'auth' => true
]);

$map->post('saveJobs', '/platzi_php/jobs/add', [
  'controller' => 'App\Controllers\JobsController',
  'action' => 'getAddJobAction',
  'auth' => true
]);

$map->get('addUser', '/platzi_php/user/create', [
  'controller' => 'App\Controllers\UserController',
  'action' => 'create',
  'auth' => true
]);

$map->post('saveUser', '/platzi_php/user/save', [
  'controller' => 'App\Controllers\UserController',
  'action' => 'save',
  'auth' => true
]);

$map->get('login', '/platzi_php/login', [
  'controller' => 'App\Controllers\AuthController',
  'action' => 'getLogin'
]);

$map->get('logout', '/platzi_php/logout', [
  'controller' => 'App\Controllers\AuthController',
  'action' => 'getLogout'
]);

$map->post('auth', '/platzi_php/auth', [
  'controller' => 'App\Controllers\AuthController',
  'action' => 'postLogin'
]);

$map->get('admin', '/platzi_php/admin', [
  'controller' => 'App\Controllers\AdminController',
  'action' => 'getIndex',
  'auth' => true
]);


// Verificamos si existe o no una ruta
$matcher = $routerContainer->getMatcher();

// Hacemos un match hacia esa ruta | prueba final
$route = $matcher->match($request);

if (!$route) {
    echo 'No route';
} else {
    $handlerData = $route->handler;
    $controllerName = $handlerData['controller'];
    $actionName = $handlerData['action'];
    $needsAuth = $handlerData['auth'] ?? false;

    $sessionUserId = $_SESSION['userId'] ?? false;

    if ($needsAuth && !$sessionUserId) {
        echo 'Protected route';
        die;
    }
    
    $controller = new $controllerName;
    $response = $controller->$actionName($request);
}
    foreach ($response->getHeaders() as $name => $values) {
        foreach ($values as $value) {
            header(sprintf('%s: %s', $name, $value), false);
        }
    }
    
    http_response_code($response->getStatusCode());
    echo $response->getBody();

// Ver URL
// var_dump($request->getUri()->getPath());
