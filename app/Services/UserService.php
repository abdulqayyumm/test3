<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use App\Services\BaseService;
use App\WebHooks\FetchUsersWebHook;

class UserService extends BaseService
{
    /**
     * UserService constructor.
     *
     * @param User $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        parent::__construct($userRepository);
    }

    /**
     * Fetch users from randomuser.me
     *
     * @return object
     */
    public function fetchUser()
    {
        return FetchUsersWebHook::fetchUser()->results[0];
    }
}