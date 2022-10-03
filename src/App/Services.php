<?php

declare(strict_types=1);

use App\Service\Location;
use App\Service\Transaction\TransactionService;
use App\Service\User;
use Psr\Container\ContainerInterface;

$container['find_user_service'] = static fn (ContainerInterface $container): User\Find => new User\Find(
    $container->get('user_repository'),
);

$container['create_user_service'] = static fn (ContainerInterface $container): User\Create => new User\Create(
    $container->get('user_repository'),
);

$container['update_user_service'] = static fn (ContainerInterface $container): User\Update => new User\Update(
    $container->get('user_repository'),
);

$container['delete_user_service'] = static fn (ContainerInterface $container): User\Delete => new User\Delete(
    $container->get('user_repository'),
);

$container['login_user_service'] = static fn (ContainerInterface $container): User\Login => new User\Login(
    $container->get('user_repository'),
);

$container['transaction_service'] = static fn (ContainerInterface $container): TransactionService => new TransactionService(
    $container->get('transaction_repository'),
);

$container['find_location_service'] = static fn (ContainerInterface $container): Location\Find => new Location\Find(
    $container->get('location_repository'),
);

$container['create_location_service'] = static fn (ContainerInterface $container): Location\Create => new Location\Create(
    $container->get('location_repository'),
);

$container['update_location_service'] = static fn (ContainerInterface $container): Location\Update => new Location\Update(
    $container->get('location_repository'),
);

$container['delete_location_service'] = static fn (ContainerInterface $container): Location\Delete => new Location\Delete(
    $container->get('location_repository'),
);
