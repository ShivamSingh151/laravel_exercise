<?php

namespace App\Http\Repositories;

use App\Models\Router;

class RouterRepository extends BaseRepository
{
    protected $model;

    public function __construct(Router $model)
    {
        $this->model = $model;
    }
    public function paginateWithParams($params, $perPage = 20)
    {
        $query = $this->model->orderBy('created_at', 'DESC');
        $query->where('status', '=', '1');

        if($params['domain'] !='') { $query->where('domain', 'LIKE', '%'.$params['domain'].'%'); }
        if($params['loopback'] !='') { $query->where('loopback', 'LIKE', '%'.$params['loopback'].'%'); }
        if($params['mac'] !='') { $query->where('mac', 'LIKE', '%'.$params['mac'].'%'); }

        return $query->paginate($perPage);
    }
}
