<?php

namespace App\Http\Controllers\Api\V1\StationOperator;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDriverstRequest;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DriverController extends Controller
{
    

    public function Create_driver_st_user(CreateDriverstRequest $request)
    {
        $data = $request->validated();

        /** @var \App\Models\User $user */
        try {
            $response = DB::transaction(function () use ($data) {
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password'])
                ]);
                $token = $user->createToken('main')->plainTextToken;

                $bus_station = Driver::create([
                    'name' => $data['name_of_station'],
                    'address' => $data['address'],
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude'],
                    'user_id' => $user->id
                ]);
                return [
                    'user' => $user,
                    'token' => $token,
                    'bus_station' => $bus_station
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


    /**
     * Display a listing of the resource.
     */
    public function index()
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
