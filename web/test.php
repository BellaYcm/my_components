<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/25
 * Time: 16:42
 */
// framework/bye.php
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();

$response = new Response('Goodbye!');#setContent
$input=$request->get('name');
//ENT_COMPAT - 默认。仅编码双引号。
//ENT_QUOTES - 编码双引号和单引号。
//ENT_NOQUOTES - 不编码任何引号。
$response->setContent(sprintf('Hello %s', htmlspecialchars($input, ENT_QUOTES, 'UTF-8')));
$response->send();
$response->send();#sendContent