<?php

namespace App\Http\Services;

abstract class BaseService
{
    public function getById($id)
    {
        return $this->repository->getById($id);
    }

    public function pluck()
    {
        return $this->repository->pluck();
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function get()
    {
        return $this->repository->get();
    }

    public function paginate($perPage = 20)
    {
        return $this->repository->paginate($perPage);
    }

    public function store($request)
    {
        return $this->repository->store($request);
    }

    public  function  edit($id)
    {
        return $this->repository->edit($id);
    }

    public  function  update($request, $id)
    {
        return $this->repository->update($request, $id);
    }
}
