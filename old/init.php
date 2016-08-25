<?php

#创建的目的是让hello.php去require  有了app.php控制 就不需要了
require_once __DIR__ . '/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();
$response = new Response();