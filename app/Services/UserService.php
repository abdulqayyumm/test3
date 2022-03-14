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
        $response = FetchUsersWebHook::fetchUser()->results;

        $users = [];
        foreach($response as $user){
            array_push($users, [
                'title'        => $user->name->title,
                'first_name'   => $user->name->first,
                'last_name'    => $user->name->last,
                'email'        => $user->email,
                'phone_number' => $user->phone,
                'gender'       => $user->gender,
                'image'        => $user->picture->large,
                'street'       => $user->location->street->name . ', ' . $user->location->street->number,
                'city'         => $user->location->city,
                'state'        => $user->location->state,
                'country'      => $user->location->country,
                'postcode'     => $user->location->postcode,
            ]);
        }
        
        $user = $this->getModel()->insert($users);
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