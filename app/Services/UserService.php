<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use App\Services\BaseService;
use App\WebHooks\FetchUsersWebHook;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * Export users
     *
     * @return object
     */
    public function exportUsers()
    {
        $users = $this->repository->get();

        $path = '/app/public/csv';
        if (!File::exists(storage_path($path))) {
            File::makeDirectory(storage_path($path));
        }

        $filename = storage_path("$path/users.csv");

        $file = fopen($filename, 'w');

        $columns = [
            'Title',
            'First Name',
            'Last Name',
            'Email',
            'Phone Number',
            'Gender',
            'Picture',
            'Street',
            'City',
            'State',
            'Country',
            'Postcode',
        ];

        fputcsv($file, $columns);
        foreach ($users as $user) {
            fputcsv($file, [
                $user->title,
                $user->first_name,
                $user->last_name,
                $user->email,
                $user->phone_number,
                $user->gender,
                $user->image,
                $user->street,
                $user->city,
                $user->state,
                $user->country,
                $user->postcode
            ]);
        }

        fclose($file);
    }
}