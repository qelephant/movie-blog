<?php

namespace App\Http\Controllers;

use App\Http\Requests\Composer\IndexRequest;
use App\Http\Requests\Composer\StoreRequest;
use App\Http\Requests\Composer\UpdateRequest;
use App\Http\Resources\ComposerResource;
use App\Http\Resources\ComposerRespource;
use App\Repositories\ComposerRepository;
use Illuminate\Http\Request;

class ComposerController extends Controller
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new ComposerRepository;
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        $data = $this->repository->indexPaginate($request->validated());

        return response([
            'data' => ComposerResource::collection($data),
            'status' => 'success'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $this->repository->create($request->validated());

        return response([
            'data' => $data,
            'status' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = $this->repository->getById($id);
        } catch (\Throwable $th) {
            return response(['status' => 'Not found']);
        }
        return response([
            'data' => new ComposerResource($data),
            'status' => 'success'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $data = $this->repository->update($request->validated(), $id);
        } catch (\Throwable $th) {
            return response(['status' => 'Not found']);
        }

        return response([
            'data' => new ComposerResource($data),
            'status' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = $this->repository->destroy($id);
        } catch (\Throwable $th) {
            return response(['status' => 'Not found']);
        }
        return response([
            'status' => 'Success delete'
        ]);
    }
}
