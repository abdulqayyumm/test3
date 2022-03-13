<?php

namespace App\Http\Controllers\Api;

use App\Services\UserService;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\UserRequest;
use App\Jobs\GenerateUserCsvJob;
use Illuminate\Http\Request;

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
    public function index(Request $request)
    {
        $this->fetchAndSaveUser();

        $query = $this->service->getModel()->orderBy('id', 'desc');
        if (count($this->searchAble)) {
            foreach ($this->searchAble as $attribute) {
                foreach ($request->all() as $key => $value) {
                    if (in_array($key, $this->searchAble)) {
                        $query = $query->where($attribute, $value);
                    }
                }
            }
        }
        if ($request->page) {
            $data = $query->paginate();
        } else {
            $data = $query->get();
        }

        return $this->sendResponse($data, $this->labelplural . ' retrieved successfully');
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
        return $this->sendInfo('user exported successfully');
    }

    /**
     * Fetch user and save in DB
     *
     * @return void
     */
    protected function fetchAndSaveUser()
    {
        $user = $this->service->fetchUser();
        $this->service->store([
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
}
