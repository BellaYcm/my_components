<?php
/**
 * http://fabien.potencier.org/create-your-own-framework-on-top-of-the-symfony2-components-part-1.html
 */
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpCache\HttpCache;
use Symfony\Component\HttpKernel\HttpCache\Store;

//Creates a new request with values from PHP's super globals.
$request = Request::createFromGlobals();

$routes = include __DIR__ . '/../src/route.php';


$framework = new Simplex\Framework($routes);
$framework = new HttpCache($framework, new Store(__DIR__ . '/../cache'));

$response = $framework->handle($request);
$response->send();





