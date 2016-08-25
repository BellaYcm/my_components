<?php
#演示一些方法
require_once __DIR__ . '/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();

$input = $request->get('name', 'World');
$response = new Response(sprintf(
    'Hello %s',
    htmlspecialchars($input, ENT_QUOTES, 'UTF-8')
));

$response->send();


function responseDemo()
{
    $response = new Response();

    $response->setContent('Hello world!');
    $response->setStatusCode(200);
    $response->headers->set('Content-Type', 'text/html');

// configure the HTTP cache headers
    $response->setMaxAge(10);
}

function requestDemo()
{
    $request = Request::createFromGlobals();

    //请求的URI (e.g. /about)
    $request->getPathInfo();

// 分别得到GET参数或POST参数
    $request->query->get('foo'); // GET
    $request->request->get('bar', '如何没有bar的默认值'); // POST

// 得到服务器变量
    $request->server->get('HTTP_HOST');

// 得到上传文件对象
    $request->files->get('foo');

// 得到cookie值
    $request->cookies->get('PHPSESSID');

// 得到http请求头信息
    $request->headers->get('host');
    $request->headers->get('content_type');

    $request->getMethod();    // GET, POST, PUT, DELETE, HEAD
    $request->getLanguages(); // 得到客户端接收语言数组

    $request->getClientIp();
//模拟一个请求：
    $request = Request::create('/index.php?name=Fabien');
}

?>