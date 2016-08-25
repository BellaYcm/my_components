<?php
use Symfony\Component\HttpFoundation\Request;

#require_once __DIR__.'/init.php';

$r=Request::create('/hello?name=Fabien');
#var_dump($r);exit;
$response->setContent('Goodbye!');
$response->send();