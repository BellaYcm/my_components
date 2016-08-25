<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;

$request = Request::createFromGlobals();

$routes = include __DIR__ . '/../src/route.php';

$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
$resolver = new HttpKernel\Controller\ControllerResolver();

try {
    //match方法接受请求路径为参数，然后返回相关的路由属性数组（注意路由的名字已经自动赋值给_route属性了）：
    $request->attributes->add($matcher->match($request->getPathInfo()));
    $controller = $resolver->getController($request);
    $arguments = $resolver->getArguments($request, $controller);
    $response = call_user_func_array($controller, $arguments);
    // $response = call_user_func($request->attributes->get('_controller'), $request);
} catch (Routing\Exception\ResourceNotFoundException $e) {
    $response = new Response('Not Found', 404);
} catch (Exception $e) {
    echo $e->getMessage();
    $response = new Response('An error occurred', 500);
}
//$generator = new Routing\Generator\UrlGenerator($routes, $context);
//echo $generator->generate('hello', array('name' => 'Fabien'),true);
//echo "<br>";
//
//$dumper = new Routing\Matcher\Dumper\PhpMatcherDumper($routes);
//var_dump($dumper);exit;

$response->send();

function render_template($request)
{
    extract($request->attributes->all(), EXTR_SKIP);
    ob_start();
    include sprintf(__DIR__ . '/../src/pages/%s.php', $_route);

    return new Response(ob_get_clean());
}

class LeapYearController
{
    public function indexAction($year)
    {
        if (is_leap_year($year)) {
            return new Response('Yep, this is a leap year!');
        }

        return new Response('Nope, this is not a leap year.');
    }
}
