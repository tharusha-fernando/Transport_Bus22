<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBusStationRequest;
use App\Models\BusStation;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @group User Management
 * 
 * This Consists All User Accounbt Creations.
 * Mainly Bus StationUser Accounts
 * 
 **/

class UserController extends Controller
{
    /**
     * @group User Management
     * 
     * Create a new bus station user.
     *
     * This endpoint allows you to create a new bus station user.
     * only accessible by administrators or above
     * @authenticated
     *
     * @bodyParam name string required The name of the user.
     * @bodyParam email string required The email of the user.
     * @bodyParam password string required The password of the user.
     * @bodyParam name_of_station string required The name of the bus station.
     * @bodyParam address string required The address of the bus station.
     * @bodyParam latitude numeric required The latitude of the bus station.
     * @bodyParam longitude numeric required The longitude of the bus station.
     *
     * @response {
     *     "user": {
     *         "id": 1,
     *         "name": "John Doe",
     *         "email": "johndoe@example.com",
     *         "created_at": "2022-01-01 00:00:00",
     *         "updated_at": "2022-01-01 00:00:00"
     *     },
     *     "token": "xxxxxxxxxx",
     *     "bus_station": {
     *         "id": 1,
     *         "name": "Bus Station Name",
     *         "address": "123 Main St",
     *         "latitude": 40.7128,
     *         "longitude": -74.0060,
     *         "user_id": 1,
     *         "created_at": "2022-01-01 00:00:00",
     *         "updated_at": "2022-01-01 00:00:00"
     *     }
     * }
     *
     * @response 500 {
     *     "error": "Internal Server Error",
     *     "message": "General Exception"
     * }
     *
     * @response 500 {
     *     "error": "Internal Server Error",
     *     "message": "General Error"
     * }
     *
     * @response 500 {
     *     "error": "Internal Server Error",
     *     "message": "General Exception"
     * }
     *
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     * @throws \Error
     * @throws \Illuminate\Database\QueryException
     */
    public function Create_Bus_Staton_user(CreateBusStationRequest $request)
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
                $user->addRole('station_operator');

                $bus_station = BusStation::create([
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
    //
}
