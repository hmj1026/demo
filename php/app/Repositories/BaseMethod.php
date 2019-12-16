<?php

namespace App\Repositories;

trait BaseMethod
{
    public function create($params)
    {
        return $this->model->insert($params);
    }

    public function createGetId($params)
    {
        return $this->model->insertGetId($params);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getActive()
    {
        return $this->model->active()->get();
    }

    public function getData(int $id, array $with = [], string $key = 'id')
    {
        $with = !empty($with) ? $with : false;

        return $this->model
            ->when($with, function($query, $with) {
                return $query->with($with);
            }, function($query) {
                return $query;
            })
            ->where($key, $id)
            ->first();
    }

    public function getDatas(int $id, array $with = [], string $key = 'id')
    {
        $with = !empty($with) ? $with : false;

        return $this->model
            ->when($with, function($query, $with) {
                return $query->with($with);
            }, function($query) {
                return $query;
            })
            ->where($key, $id)
            ->get();
    }

    public function update(int $id, array $params, string $key = 'id')
    {
        return $this->model->where($key, $id)->update($params);
    }

    public function delete(int $id, string $key = 'id')
    {
        return $this->model->where($key, $id)->delete();
    }
}