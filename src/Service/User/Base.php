<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\BaseService;
use Respect\Validation\Validator as v;

abstract class Base extends BaseService
{
    protected UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    protected static function validateUserName(string $name): string
    {
        if (! v::alnum('ÁÉÍÓÚÑáéíóúñ.')->length(1, 100)->validate($name)) {
            throw new \App\Exception\User('Invalid name.', 400);
        }

        return $name;
    }

    protected static function validateEmail(string $emailValue): string
    {
        $email = filter_var($emailValue, FILTER_SANITIZE_EMAIL);
        if (! v::email()->validate($email)) {
            throw new \App\Exception\User('Invalid email', 400);
        }

        return (string) $email;
    }

    protected function getUserFromDb(int $userId): User
    {
        return $this->userRepository->getUser($userId);
    }
}
