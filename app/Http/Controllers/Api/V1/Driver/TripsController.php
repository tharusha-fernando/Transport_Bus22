<?php

namespace App\Http\Controllers\Api\V1\Driver;

use App\Http\Controllers\Controller;
use App\Http\Requests\Driver\GetTripsRequest;
use App\Http\Requests\Driver\UpdateTripStatusRequest;
use App\Models\Trip;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TripsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetTripsRequest $request)
    {
       // return response('sassasasa');
        $driver = $request->user()->Driver->id;
        $user = $request->user()->Driver;
        //return $user;
        //return $user->BusStation;
        $drivers = Trip::whereHas('Bus.Driver', function ($query) use ($driver) {
            $query->where('id', $driver);
        })
        ->when($request->search , function ($query) use ($request) {
            $query->where('id', 'like', '%' . $request->search . '%');
        })
        ->when($request->search_busid , function ($query) use ($request) {
            $query->where('bus_id', 'like', '%' . $request->search_busid . '%');
        })
        ->when($request->search_start , function ($query) use ($request) {
            $query->where('start', 'like', '%' . $request->search_start . '%');
        })
        ->when($request->search_route_id , function ($query) use ($request) {
            $query->where('end', 'like', '%' . $request->search_route_id . '%');
        })
        ->when($request->search_route_id , function ($query) use ($request) {
            $query->where('route_id', 'like', '%' . $request->search_route_id . '%');
        })
        ->when($request->search_status , function ($query) use ($request) {
            $query->where('status', 'like', '%' . $request->search_status . '%');
        })
        ->when($request->search_from , function ($query) use ($request) {
            $query->where('from', 'like', '%' . $request->search_from . '%');
        })
        ->when($request->search_to , function ($query) use ($request) {
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
    public function show(Trip $trip)
    {
        return $trip;
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTripStatusRequest $request, string $id)
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

    public function update_status_(UpdateTripStatusRequest $request,Trip $trip){
       // $data=$request->validated();
       // $trip->update($data);
       // return response('sasasasasasasa');
        //$message=$data['status'];

        $data=$request->validated();
        $message=$data['status'];
        //return $trip;

        try {
            $response = DB::transaction(function () use ($data,$trip,$message) {
                $trip->update($data);
                
                return [
                    'trip' => $trip,
                    'Message'=>'Trip Status Is Now '.strval($message),
                ];
            });
            return response($response);
        } catch (\Exception $ex) {
            return response()->json(['General Exeption = ', $ex->getMessage()], 500);
        } catch (\Error $er) {
            return response()->json(['General Error = ', $er->getMessage()], 500);
        } catch (QueryException $qr) {
            return response()->json(['General Exeption = ', $qr->getMessage()], 500);
        }
    }
}
