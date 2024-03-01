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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            
            $params = $request->all();

            $date = Carbon::parse($params['date']);

            $params['date'] = $date->toDateTimeString();

            $bill = Bill::create($params);

            $user = auth('api')->user();

            $user->bills()->attach($bill);
            
            return $this->success('Cuenta creada correctamente', $bill);

        } catch (\Exception $e) {
            return $this->error('Exception', ["error" => $e->getMessage()], $e->getMessage(), 500);
        }
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
     * Update the specified resource in storage.
     */
    public function update(BillRequest $request, Bill $bill)
    {
        try {
            
            $params = $request->all();

            $date = Carbon::parse($params['date']);

            $params['date'] = $date->toDateTimeString();

            $bill->update($params);
            
            return $this->success('Cuenta acutalizada correctamente', $bill);

        } catch (\Exception $e) {
            return $this->error('Exception', ["error" => $e->getMessage()], $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        try {
            
            $bill->user()->detach();
            
            $bill->delete();
            
            return $this->success('Cuenta eliminada correctamente', $bill);

        } catch (\Exception $e) {
            return $this->error('Exception', ["error" => $e->getMessage()], $e->getMessage(), 500);
        }
        
    }
}
