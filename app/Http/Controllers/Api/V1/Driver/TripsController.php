<?php

namespace App\Http\Controllers\Api\V1\Driver;

use App\Http\Controllers\Controller;
use App\Http\Requests\Driver\GetTripsRequest;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetTripsRequest $request)
    {
        $user = $request->user()->Driver;
        $drivers = Trip::whereHas('Bus.Driver', function ($query) use ($user) {
            $query->where('id', $user->id);
        })
        ->orWhere('from',$user->BusStation->id)
        ->orWhere('to',$user->BusStation->id)
        ->when($request->search && in_array('trip_id', $request->search_by), function ($query) use ($request) {
            $query->where('id', 'like', '%' . $request->search . '%');
        })
        ->when($request->search_busid && in_array('bus_id', $request->search_by), function ($query) use ($request) {
            $query->where('bus_id', 'like', '%' . $request->search_busid . '%');
        })
        ->when($request->search_start && in_array('start', $request->search_by), function ($query) use ($request) {
            $query->where('start', 'like', '%' . $request->search_start . '%');
        })
        ->when($request->search_route_id && in_array('end', $request->search_by), function ($query) use ($request) {
            $query->where('end', 'like', '%' . $request->search_route_id . '%');
        })
        ->when($request->search_route_id && in_array('route_id', $request->search_by), function ($query) use ($request) {
            $query->where('route_id', 'like', '%' . $request->search_route_id . '%');
        })
        ->when($request->search_status && in_array('status', $request->search_by), function ($query) use ($request) {
            $query->where('status', 'like', '%' . $request->search_status . '%');
        })
        ->when($request->search_from && in_array('from', $request->search_by), function ($query) use ($request) {
            $query->where('from', 'like', '%' . $request->search_from . '%');
        })
        ->when($request->search_to && in_array('to', $request->search_by), function ($query) use ($request) {
            $query->where('to', 'like', '%' . $request->search_to . '%');
        })
        
        ->when($request->order_by,function($query)use($request){
            $query->orderBy('created_at',$request->order_by);
        })
        ->when($request->day,function($query)use($request){
            $query->orderBy('day',$request->day);
        })
            ->paginate();

        return $drivers;

        return response('asaasasasa');
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
