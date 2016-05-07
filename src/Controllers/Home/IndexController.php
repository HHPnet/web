<?php

namespace HHPnet\Web\Home;

use Interop\Container\ContainerInterface;

class IndexController
{
    protected $ci;

    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }

    public function home($request, $response)
    {
        return $this->ci->view->render($response, 'index.twig');
    }
}
