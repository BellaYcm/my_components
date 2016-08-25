<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/23
 * Time: 17:56
 */


namespace Simplex;

use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;
use Symfony\Component\EventDispatcher\EventDispatcher;

class Framework extends HttpKernel\HttpKernel
{

    public function __construct($routes) {
        $context = new Routing\RequestContext();
        $matcher = new Routing\Matcher\UrlMatcher($routes, $context);
        $resolver = new HttpKernel\Controller\ControllerResolver();

        $dispatcher = new EventDispatcher();
        $dispatcher->addSubscriber(new HttpKernel\EventListener\RouterListener($matcher));
        $dispatcher->addSubscriber(new HttpKernel\EventListener\ResponseListener('UTF-8'));
        $dispatcher->addListener('response', array(new ContentLengthListener(), 'onResponse'), -255);
        $dispatcher->addSubscriber(new GoogleListener());
        $dispatcher->addListener('responseT', function (ResponseEvent $event) {
            $response = $event->getResponse();
            $response->setContent($response->getContent() . '\\nADD_T');
        });

        parent::__construct($dispatcher, $resolver);
    }


}