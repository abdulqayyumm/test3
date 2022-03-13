<?php

namespace App\Services;

use Illuminate\Http\Request;

class BaseService
{
    /**
     * @var repository
     */
    protected $repository;

    /**
     * BaseService constructor.
     *
     * @param object $repository
     */
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Collection
     */
    public function get()
    {
        return $this->repository->get();
    }

    /**
     * @return Model $model
     */
    public function getModel()
    {
        return $this->repository->getModel();
    }

    /**
     * @return Collection
     */
    public function paginate($page = 10)
    {
        return $this->repository->paginate($page);
    }

    /**
     * @param int $id
     *
     * @return Collection
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param string $column
     * @param string $operator
     * @param string $value
     *
     * @return Model
     */
    public function where($column, $operator, $value)
    {
        return $this->repository->where($column, $operator, $value);
    }

    /**
     * @param array $conditions
     *
     * @return Model
     */
    public function whereMultiple(array $cinditions)
    {
        return $this->repository->whereMultiple([$cinditions]);
    }

    /**
     * @param array $input
     *
     * @return Model
     */
    public function store($input)
    {
        return $this->repository->store($input);
    }

    /**
     * @param int $id
     * @param array $input
     *
     * @return Model
     */
    public function update($input, $id)
    {
        return $this->repository->update($id, $input);
    }

    /**
     * @param int $id
     *
     * @return boolean
     */
    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}