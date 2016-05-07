<?php

$container = $app->getContainer();

$container['view'] = function ($c) {
    $settings = $c->get('settings')['renderer'];

    $view = new \Slim\Views\Twig($settings['template_path'], ['cache' => $settings['cache_path']]);

    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));

    return $view;
};

$container['database'] = function ($c) {
    $manager = new MongoDB\Driver\Manager('mongodb://mongodb');

    return new MongoDB\Database($manager, 'hhpnet');
};

$container['user_factory'] = function ($c) {
    return new HHPnet\Core\Domain\Users\UserFactory();
};

$container['user_repository'] = function ($c) {
    return new HHPnet\Core\Infrastructure\MongoDB\UserRepository(
        $c['database'],
        $c['user_factory']
    );
};

$container['user_signup_service'] = function ($c) {
    return new HHPnet\Core\Application\Services\Users\SignUpUser\SignUpUserService(
        $c['user_repository'],
        $c['user_factory']
    );
};
