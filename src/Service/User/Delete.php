<?php

declare(strict_types=1);

namespace App\Service\User;

final class Delete extends Base
{
    public function delete(int $userId): void
    {
        $this->getUserFromDb($userId);
        $this->userRepository->deleteUserTransactions($userId);
        $this->userRepository->delete($userId);
    }
}
