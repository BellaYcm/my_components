<?php
/**
 * http://fabien.potencier.org/create-your-own-framework-on-top-of-the-symfony2-components-part-1.html
 */
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\HttpCache\HttpCache;
use Symfony\Component\HttpKernel\HttpCache\Store;
use Symfony\Component\HttpFoundation\Response;


$request = Request::createFromGlobals();
$routes = include __DIR__ . '/../src/route.php';

$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
$resolver = new HttpKernel\Controller\ControllerResolver();

$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new HttpKernel\EventListener\RouterListener($matcher));
$dispatcher->addListener('response', array(new Simplex\ContentLengthListener(), 'onResponse'), -255);
$dispatcher->addSubscriber(new Simplex\GoogleListener());
$dispatcher->addListener('responseT', function (Simplex\ResponseEvent $event) {
    $response = $event->getResponse();
    $response->setContent($response->getContent() . '\\nADD_T');
});

$framework = new Simplex\Framework($dispatcher, $matcher, $resolver);
$framework = new HttpCache($framework, new Store(__DIR__ . '/../cache'));

$response = $framework->handle($request);
$response->send();





