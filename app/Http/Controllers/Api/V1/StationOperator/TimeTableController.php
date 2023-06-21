<?php

namespace App\Http\Controllers\Api\V1\StationOperator;

use App\Http\Controllers\Controller;
use App\Http\Requests\StationOperator\StoreTimeTableRequest;
use App\Models\TimeTable;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimeTableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $TimeTable = TimeTable::whereHas('BusStation.User', function ($query) use ($user) {
            $query->where('id', $user->id);
        })->get();
        return $TimeTable;
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTimeTableRequest $request)
    {
        $data=$request->validated();
        try {
            $response = DB::transaction(function () use ($data) {
                
               return TimeTable::create($data);
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
