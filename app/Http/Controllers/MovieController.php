<?php

namespace App\Http\Controllers;

use App\Http\Requests\Movie\IndexRequest;
use App\Http\Requests\Movie\StoreRequest;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Repositories\MovieRepository;

class MovieController extends Controller
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new MovieRepository;
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
            'data' => $data,
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
            'data' => $data,
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
    public function update(Request $request, $id)
    {
        //
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
            $review = $this->repository->destroy($id);
        } catch (\Throwable $th) {
            return response(['status' => 'Not found']);
        }
        return response([
            'status' => 'success'
        ]);
    }


}
