<?php

namespace App\Repositories;

use App\Models\Actor;
use Illuminate\Support\Facades\DB;

class ActorRepository {

    public function indexPaginate($params)
    {
        $per_page = $params['per_page'] ?? 10;
        $reviews = $this->prepareQuery($params)->paginate($per_page);
        return $reviews;
    }

    public function index($params)
    {
        return $this->prepareQuery($params)->get();
    }

    public function getById($id)
    {
        return Actor::findOrFail($id);
    }

    public function create($params)
    {
       return Actor::create($params);

    }

    public function update($params, $id)
    {
        $review = $this->getById($id);
        $review->fill($params);
        $review->save();
        return $review;
    }

    public function destroy($id)
    {
        $review = Actor::destroy($id);
        return $review;
    }
    public function prepareQuery($params)
    {
        $query = DB::table('actors');
        $query = $this->queryApplyFilter($query, $params);
        $query = $this->queryApplyOrder($query, $params);
        return $query;
    }

    public function queryApplyFilter($query, $params)
    {
        // Фильтр по автору
        if (isset($params['name'])) {
            is_array($params['name'])
                ? $query->whereIn('first_name', $params['name'])
                : $query->where('last_name', $params['name']);
        }

        // Фильтр по полу
        if (isset($params['sex'])) {
            is_array($params['sex'])
                ? $query->whereIn('sex', $params['sex'])
                : $query->where('sex', $params['sex']);
        }
        return $query;
    }

    public function queryApplyOrder($query, $params)
    {
        $params['sort_way'] = $params['sort_way'] ?? 'asc';
        if (isset($params['sort'])) {
            $query->orderBy($params['sort'], $params['sort_way']);
        }
        return $query;
    }


}
