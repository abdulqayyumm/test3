<?php

namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function get()
    {
        return $this->model->all();
    }

    /**
     * @return Model $model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param int $page
     *
     * @return Collection
     */
    public function paginate($page)
    {
        return $this->model->paginate($page);
    }

    /**
     * @param int $id
     *
     * @return Collection
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param string $column
     * @param string $operator
     * @param string $value
     *
     * @return Model
     */
    public function where($column,  $operator, $value)
    {
        return $this->model->where($column, $operator, $value);
    }

    /**
     * @param array $conditions
     *
     * @return Model
     */
    public function whereMultiple($conditions)
    {
        return $this->model->where([$conditions]);
    }

    /**
     * @param array $input
     *
     * @return Model
     */
    public function store($input)
    {
        return $this->model->create($input);
    }

    /**
     * @param int $id
     * @param array $input
     *
     * @return Model
     */
    public function update($id, $input)
    {
        return $this->find($id)->update($input);
    }

    /**
     * @param int $id
     *
     * @return boolean
     */
    public function destroy($id)
    {
        return $this->find($id)->delete();
    }
}