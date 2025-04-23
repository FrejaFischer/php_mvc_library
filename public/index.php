<?php

/**
 * Front controller
 */
session_start();

/**
 * It requires all class files instead of loading them one by one
 */
 spl_autoload_register(function ($class) {
    $root = dirname(__DIR__);
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_readable($file)) {
        require $file;
    }
 });

 /**
  * Custom error and exception handling
  */
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/**
 * Routing
 */
$router = new Core\Router();
$router->add('',[
    'controller' => 'Home',
    'action' => 'index'
]);
$router->add('books',[
    'controller' => 'Books',
    'action' => 'index'
]);
$router->add('books/new', [
    'controller' => 'Books',
    'action' => 'new'
]);
$router->add('books/create', [
    'controller' => 'Books',
    'action' => 'create',
    'method' => 'POST'
]);
$router->add('books/delete', [
    'controller' => 'Books',
    'action' => 'delete',
    'method' => 'POST'
]);
$router->add('authors', [
    'controller' => 'Authors',
    'action' => 'index'
]);
$router->add('authors/new', [
    'controller' => 'Authors',
    'action'     => 'new'
]);
$router->add('authors/create', [
    'controller' => 'Authors',
    'action'     => 'create',
    'method'     => 'POST'
]);
$router->add('authors/delete', [
    'controller' => 'Authors',
    'action'     => 'delete',
    'method'     => 'POST'
]);

/**
 * Route dispatch
 */
$url = $_SERVER['QUERY_STRING'];

// Another solution for getting the url (maybe nessesary when building an API?)
// // Extract the route from the URI, stripping off base path and query string
// $requestUri = $_SERVER['REQUEST_URI'];
// $scriptName = $_SERVER['SCRIPT_NAME'];
// $basePath   = dirname($scriptName); // e.g. /php_mvc_library/public

// // Remove base path from URI
// $relativeUrl = preg_replace('#^' . preg_quote($basePath) . '/?#', '', $requestUri);

// // Remove query string
// $url = strtok($relativeUrl, '?');

//// DEBUGGING WITH LOGGING ////
// $log = dirname(__DIR__) . '/logs/' . date('Y-m-d') . '.html';
// // Format the log entry (you can customize this)
// $entry = date('H:i:s') . " - " . htmlspecialchars($url) . "<br>\n";
// // Append to the log file
// file_put_contents($log, $entry, FILE_APPEND);

$method = $_SERVER['REQUEST_METHOD'];
$router->dispatch($url, $method);
