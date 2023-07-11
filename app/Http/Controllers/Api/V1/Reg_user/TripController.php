<?php

namespace App\Http\Controllers\Api\V1\Reg_user;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reg_user\GetTripsRequest;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    // }

    public function index(GetTripsRequest $request)
    {
        // return response('sassasasa');
        // $driver = $request->user()->Driver->id;
        $user = $request->user()->Driver;
        //return $user;
        //return $user->BusStation;
        $drivers = Trip::with('Booking','Location')       
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', 'like', '%' . $request->search . '%');
            })
            ->when($request->route, function ($query) use ($request) {
                $query->whereHas('Route', function ($query1) use ($request) {
                    $query1->where('number', $request->route);
                });
            })
            
            ->when($request->search_start, function ($query) use ($request) {
                $query->where('start', 'like', '%' . $request->search_start . '%');
            })
            ->when($request->search_start, function ($query) use ($request) {
                $query->where('start', 'like', '%' . $request->search_start . '%');
            })
            ->paginate();

        return $drivers;

        
        // ->whereHas('Bus.Driver', function ($query) use ($driver) {
        //     $query->where('id', $driver);
        // })
        // ->when($request->order_by, function ($query) use ($request) {
        //     $query->orderBy('created_at', $request->order_by);
        // })
        // ->when($request->day, function ($query) use ($request) {
        //     $query->orderBy('day', $request->day);
        // })
        // ->when($request->search_route_id, function ($query) use ($request) {
        //     $query->where('end', 'like', '%' . $request->search_route_id . '%');
        // })
        // ->when($request->search_route_id, function ($query) use ($request) {
        //     $query->where('route_id', 'like', '%' . $request->search_route_id . '%');
        // })
        // ->when($request->search_status, function ($query) use ($request) {
        //     $query->where('status', 'like', '%' . $request->search_status . '%');
        // })
        // ->when($request->search_from, function ($query) use ($request) {
        //     $query->where('from', 'like', '%' . $request->search_from . '%');
        // })
        // ->when($request->search_to, function ($query) use ($request) {
        //     $query->where('to', 'like', '%' . $request->search_to . '%');
        // })
        //return response('asaasasasa');
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
}
