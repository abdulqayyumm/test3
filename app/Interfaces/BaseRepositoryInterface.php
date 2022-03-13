<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
* Interface BaseRepositoryInterface
* @package App\Interfaces
*/
interface BaseRepositoryInterface
{
    /**
     * @return Collection
     */
    public function get();

    /**
     * @return Model $model
     */
    public function getModel();

    /**
     * @param int $page
     *
     * @return Collection
     */
    public function paginate($page);

    /**
     * @param int $id
     *
     * @return Collection
     */
    public function find($id);

    /**
     * @param string $column
     * @param string $operator
     * @param string $value
     *
     * @return Model
     */
    public function where($column,  $operator, $value);

    /**
     * @param array $conditions
     *
     * @return Model
     */
    public function whereMultiple($conditions);

    /**
     * @param array $input
     *
     * @return Model
     */
    public function store($input);

    /**
     * @param int $id
     * @param array $input
     *
     * @return Model
     */
    public function update($id, $input);

    /**
     * @param int $id
     *
     * @return boolean
     */
    public function destroy($id);
}