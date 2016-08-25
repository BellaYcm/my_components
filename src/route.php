<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/23
 * Time: 14:23
 */
use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;

$routes = new Routing\RouteCollection();
$routes->add('hello', new Routing\Route('/hello/{name}', array(
    'name' => 'World',
    '_controller' => function ($request) {
        return render_template($request);
        // $foo将在模板里可见
//        $request->attributes->set('foo', 'bar');
//        $response = render_template($request);
//        // 改变一些头信息
//        $response->headers->set('Content-Type', 'text/plain');
//        return $response;
    }
)));
$routes->add('bye', new Routing\Route('/bye'), array(
    'name' => 'World',
    '_controller' => 'render_template'
));

$routes->add('leap_year', new Routing\Route('/is_leap_year/{year}', array(
    'year' => null,
    '_controller' => function ($request) {
        if (is_leap_year($request->attributes->get('year'))) {
            return new Response('Yep, this is a leap year!');
        }

        return new Response('Nope, this is not a leap year.');
    }
)));

$routes->add('leap_year_new', new Routing\Route('/is_leap_year_new/{year}', array(
    'year' => null,
    '_controller' => 'Calendar\\Controller\\LeapYearController::indexAction',
)));


function is_leap_year($year = null)
{
    if (null === $year) {
        $year = date('Y');
    }

    return 0 == $year % 400 || (0 == $year % 4 && 0 != $year % 100);
}

return $routes;