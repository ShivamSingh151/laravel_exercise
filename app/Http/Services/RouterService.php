<?php

namespace App\Http\Services;

use App\Http\Repositories\RouterRepository;

class RouterService extends BaseService
{
    protected $repository;

    public function __construct(RouterRepository $repository)
    {
        $this->repository  = $repository;
    }
     public function paginateWithParams($params, $perPage = 10)
    {
        return $this->repository->paginateWithParams($params, $perPage);
    }
}
