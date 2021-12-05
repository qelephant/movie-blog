<?php

namespace App\Repositories;

use App\Models\Movie;

class MovieRepository {

    public function indexPaginate($params)
    {
        $per_page = $params['per_page'] ?? 10;
        $Movies = $this->prepareQuery($params)->paginate($per_page);
        return $Movies;
    }

    public function index($params)
    {
        return $this->prepareQuery($params)->get();
    }

    public function getById($id)
    {
        return Movie::withAllRelations()->findOrFail($id);
    }

    public function create($params)
    {
        $movie = Movie::create($params);
        $movie->countries()->sync($params['country_id']);
        $movie->composers()->sync($params['composer_id']);
        $movie->directors()->sync($params['director_id']);
        $movie->actors()->sync($params['actor_id']);
        return $movie;

    }

    public function update($params, $id)
    {
        $Movie = Movie::find($id);
        $Movie->fill($params);
        $Movie->save();
        return $Movie;
    }

    public function destroy($id)
    {
        $Movie = Movie::destroy($id);
        return $Movie;
    }
    public function prepareQuery($params)
    {
        $query = Movie::withAllRelations();
        $query = $this->queryApplyFilter($query, $params);
        $query = $this->queryApplyOrder($query, $params);
        return $query;
    }

    public function queryApplyFilter($query, $params)
    {
        // Поиск по тексту
        if (isset($params['q'])) {
            $query->where(function ($subQuery) use ($params) {
                $subQuery->where('title', 'LIKE', '%' . $params['q'] . '%')
                    ->orWhere('text', 'LIKE', '%' . $params['q'] . '%');
            });
        }
        // Фильтр по автору
        if (isset($params['author'])) {
            is_array($params['author'])
                ? $query->whereIn('user_id', $params['author'])
                : $query->where('user_id', $params['author']);
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
