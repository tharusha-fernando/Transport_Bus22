<?php

namespace App\Http\Controllers\Api\V1\StationOperator;

use App\Http\Controllers\Controller;
use App\Http\Requests\StationOperator\GetTripsRequest;
use App\Http\Requests\StationOperator\StoreTripRequest;
use App\Http\Requests\StationOperator\UpdateTripsRequest;
use App\Models\Trip;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetTripsRequest $request)
    {
        $user = $request->user();
        $drivers = Trip::whereHas('BusStation.User', function ($query) use ($user) {
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

        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTripRequest $request)
    {
        $data=$request->validated();

        
        try {
            $response = DB::transaction(function () use ($data) {
                $Trip=Trip::create($data);
              
                return [
                    'Trip' => $Trip
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
    public function update(UpdateTripsRequest $request, Trip $trip)
    {
        $data=$request->validated();
        //return $data;

        
        try {
            $response = DB::transaction(function () use ($data,$trip) {
               $trip->update($data);
              
                return [
                    'Trip' => $trip,
                    'Message'=>'Updated Successfully'
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
