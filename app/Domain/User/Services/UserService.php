<?php
namespace App\Domain\User\Services;

use App\Domain\User\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function getByEmail($email)
    {
        return $this->userRepository->getByEmail($email);
    }
}
