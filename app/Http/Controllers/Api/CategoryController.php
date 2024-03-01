<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

//models
use App\Models\Category;
use App\Models\User;
use App\Models\Bill;


//resources
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryStatsResource;


class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            
            $categories = Category::all();

            return $this->success('Categories retrieved successfully', CategoryResource::collection($categories));

        } catch (\Exception $e) {
            return $this->error('Exception', ["error" => $e->getMessage()], $e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    /**
     * Return stats
     */
    public function stats(){

        try {

            $categories = Category::withCount('bills')->get();

            return $this->success('Categories retrieved successfully', CategoryResource::collection($categories));
            
        } catch (\Exception $e) {
            return $this->error('Exception', ["error" => $e->getMessage()], $e->getMessage(), 500);
        }
    }
}
