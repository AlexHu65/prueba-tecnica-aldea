<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\Bill;
use App\Http\Resources\BillResource;
use App\Http\Requests\BillRequest;
use Carbon\Carbon;


class BillController extends BaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $user = auth('api')->user();

            $bills = $user->bills()->get();

            return $this->success('Categories retrieved successfully', BillResource::collection($bills));
            
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
    public function show(Bill $bill)
    {
        try {

            return $this->success('Categories retrieved successfully', new BillResource($bill));
            
        } catch (\Exception $e) {
            return $this->error('Exception', ["error" => $e->getMessage()], $e->getMessage(), 500);
        }
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
    public function update(BillRequest $request, Bill $bill)
    {
        try {
            
            $params = $request->all();

            $bill->update($params);
            
            return $this->success('Cuenta acutalizada correctamente', $bill);

        } catch (\Exception $e) {
            return $this->error('Exception', ["error" => $e->getMessage()], $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
