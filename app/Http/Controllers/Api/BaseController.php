<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ControllerHelper;
use Illuminate\Support\Facades\Lang;

class BaseController extends Controller
{
    use ControllerHelper;

    /**
     * @var object
     */
    protected $service;

    /**
     * BaseController constructor.
     *
     * @param object $service
     */
    public function __construct($service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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

        return $this->sendResponse($data, Lang::get('general.success.retrieved', ['entity' => $this->labelplural]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = $this->getRequest();
        $this->service->store($request->all());
        return $this->sendInfo(Lang::get('general.success.created', ['entity' => $this->labelsingle]));
    }

    /**
     * Display the specified resource.
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->service->find($id);
        if(!$data)
            return $this->sendError(Lang::get('general.error.not_found'));

        return $this->sendResponse($data, Lang::get('general.success.retrieved', ['entity' => $this->labelsingle]));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->service->find($id);
        if(!$data)
            return $this->sendError(Lang::get('general.error.not_found'));

        return $this->sendResponse($data, Lang::get('general.success.retrieved', ['entity' => $this->labelsingle]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request  $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request = $this->getRequest();

        $data = $this->service->find($id);
        if(!$data)
            return $this->sendError(Lang::get('general.error.not_found'));

        $this->service->update($request->all(), $id);

        return $this->sendInfo(Lang::get('general.success.updated', ['entity' => $this->labelsingle]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->service->find($id);
        if(!$data)
            return $this->sendError(Lang::get('general.error.not_found'));

        $data->delete();
        return $this->sendInfo(Lang::get('general.success.deleted', ['entity' => $this->labelsingle]));
    }
}
