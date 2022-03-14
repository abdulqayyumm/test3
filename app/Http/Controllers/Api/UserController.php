<?php

namespace App\Http\Controllers\Api;

use App\Services\UserService;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\UserRequest;
use App\Jobs\GenerateUserCsvJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class UserController extends BaseController
{
    /**
     * @var string $labelsingle
     */
    protected $labelsingle = 'User';

    /**
     * @var string $labelplural
     */
    protected $labelplural = 'Users';

    /**
     * @var array $searchAble
     */
    protected $searchAble = ['first_name', 'last_name', 'email', 'phone_number'];

    /**
     * @var UserRequest $validation
     */
    protected $validation = UserRequest::class;

    /**
     * UserController constructor.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        parent::__construct($userService);
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function exportUsers(Request $request)
    {
        GenerateUserCsvJob::dispatch();
        return $this->sendInfo(Lang::get('user.success.exported'));
    }

    /**
     * Fetch user and save in DB
     *
     * @return void
     */
    protected function fetchAndSaveUser()
    {
        $this->service->fetchUser();
        return $this->sendInfo(Lang::get('user.success.fetched'));
    }
}
