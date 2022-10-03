<?php

declare(strict_types=1);

use App\Repository\LocationRepository;
use App\Repository\TransactionRepository;
use App\Repository\UserRepository;
use Psr\Container\ContainerInterface;

$container['user_repository'] = static fn (ContainerInterface $container): UserRepository => new UserRepository($container->get('db'));

$container['transaction_repository'] = static fn (ContainerInterface $container): TransactionRepository => new TransactionRepository($container->get('db'));

$container['location_repository'] = static fn (ContainerInterface $container): LocationRepository => new LocationRepository($container->get('db'));
