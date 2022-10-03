<?php

declare(strict_types=1);

use App\Controller\Location;
use App\Controller\Transaction;
use App\Controller\User;
use App\Middleware\Auth;

/** @var \Slim\App $app */

$app->get('/', 'App\Controller\DefaultController:getHelp');
$app->get('/status', 'App\Controller\DefaultController:getStatus');
$app->post('/login', \App\Controller\User\Login::class);

$app->group('/api/v1', function () use ($app): void {
    $app->group('/transactions', function () use ($app): void {
        $app->get('', Transaction\GetAll::class);
        $app->post('', Transaction\Create::class);
        $app->get('/{id}', Transaction\GetOne::class);
        $app->put('/{id}', Transaction\Update::class);
        $app->delete('/{id}', Transaction\Delete::class);
    })->add(new Auth());

    $app->group('/users', function () use ($app): void {
        $app->get('', User\GetAll::class)->add(new Auth());
        $app->post('', User\Create::class);
        $app->get('/{id}', User\GetOne::class)->add(new Auth());
        $app->put('/{id}', User\Update::class)->add(new Auth());
        $app->delete('/{id}', User\Delete::class)->add(new Auth());
    });

    $app->group('/locations', function () use ($app): void {
        $app->get('', Location\GetAll::class);
        $app->post('', Location\Create::class);
        $app->get('/{id}', Location\GetOne::class);
        $app->put('/{id}', Location\Update::class);
        $app->delete('/{id}', Location\Delete::class);
    });
});
