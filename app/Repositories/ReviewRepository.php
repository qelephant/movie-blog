<?php

namespace App\Repositories;

use App\Models\Review;

class ReviewRepository {

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
        return Review::findOrFail($id);
    }

    public function create($params)
    {
       return Review::create($params);

    }

    public function update($params, $id)
    {
        $review = Review::find($id);
        $review->fill($params);
        $review->save();
        return $review;
    }

    public function destroy($id)
    {
        $review = Review::destroy($id);
        return $review;
    }
    public function prepareQuery($params)
    {
        $query = Review::with('author');
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
