<?php

namespace App\Services;

use App\Models\Character;
use App\Services\BaseService;
use App\Http\Requests\CharacterRequest;
use Illuminate\Support\Facades\Storage;
use App\Repositories\ReviewRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReviewService
{
    protected $repo;

    public function __construct()
    {
        $this->repo = new ReviewRepository;
    }

    public function indexPaginate($params)
    {
        return $this->repo->indexPaginate($params);
    }

    public function get($params)
    {
        return $this->repo->getById($params);
    }

    public function store($params)
    {
        return $this->repo->create($params);
    }

    public function update($params, $id)
    {
        $review = $this->get($id);

        if (is_null($review)) {
            return response(['status' => 'Не найден персонаж для обновления']);
        }

        return $this->repo->update($params, $id);
    }

    public function destroy($id)
    {
        $review = $this->get($id);

        if (is_null($review)) {
            return response(['status' => 'Не найден персонаж для удаления']);
        }

        return $this->repo->destroy($id);
    }
}
