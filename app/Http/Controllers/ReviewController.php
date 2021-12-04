<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Services\ReviewService;
use Illuminate\Http\Request;
use App\Http\Resources\ReviewResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ReviewIndexRequest;
use App\Http\Requests\ReviewStoreRequest;
use App\Http\Requests\ReviewUpdateRequest;

class ReviewController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new ReviewService;
    }

    public function index(ReviewIndexRequest $request)
    {
        $reviews = $this->service->indexPaginate($request->validated());

        return response([
            'data' => ReviewResource::collection($reviews),
            'status' => 'success'
        ]);
    }

    public function show($id)
    {
        try {
            $result = $this->service->get($id);
        } catch (\Throwable $th) {
            return response(['status' => 'Not found']);
        }
        return response([
            'data' => new ReviewResource($result),
            'status' => 'success'
        ]);

    }

    public function store(ReviewStoreRequest $request)
    {
        $review = $this->service->store($request->validated());

        return response([
            'data' => $review,
            'status' => 'success'
        ]);
    }

    public function update(ReviewUpdateRequest $request, $id)
    {
        $review = $this->service->update($request->validated(), $id);

        return response([
            'data' => $review,
            'status' => 'success'
        ]);
    }

    public function destroy($id)
    {
        try {
            $review = $this->service->destroy($id);
        } catch (\Throwable $th) {
            return response(['status' => 'Not found']);
        }
        return response([
            'status' => 'success'
        ]);
    }

}
