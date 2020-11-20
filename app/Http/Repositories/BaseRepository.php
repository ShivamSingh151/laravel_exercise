<?php

namespace App\Http\Repositories;

use Carbon\Carbon;

abstract class BaseRepository
{
    public function pluck()
    {
        return $this->model->where('status', 1)->pluck('name', 'id');
    }

    public function find($id)
    {
        return $this->model->findorFail($id);
    }

    public function get()
    {
        return $this->model->where('is_deleted', 0)->get();
    }

    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function getPublished()
    {
        return $this->model->where('published', 1)->where('is_deleted', 0)->get();
    }

    public function paginate($perPage = 20)
    {
        return $this->model->orderBy('created_at', 'DESC')->paginate($perPage);
    }

    public function store($request)
    {
        $row = new $this->model($request);
        $row->save();

        return $row;
    }

    public  function  edit($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($request, $id)
    {
        $record = $this->model->findOrFail($id);
        return $record->update($request);
    }

    public function destroy($id)
    {
        $request['is_deleted'] = 1;

        $record = $this->model->findOrFail($id);
        return $record->update($request);
    }

    public function getCurrentMonth()
    {
        $start = new Carbon('first day of this month');
        $start->startOfMonth();
        $end = new Carbon('last day of this month');
        $end->endOfMonth();

        return [$start, $end];
    }

    public function getCurrentWeek()
    {
        $start = new Carbon();
        $start->startOfWeek();
        $end = new Carbon();
        $end->endOfWeek();

        return [$start, $end];
    }
}
