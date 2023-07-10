<?php

namespace App\Http\Controllers\Api\V1\StationOperator;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDriverstRequest;
use App\Http\Requests\GetDriversRequest;
use App\Models\BusStation;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


/**
 * @group Driver Management
 * 
 * This Consists All operations related to managing drivers and their accounts.
 * 
 * 
 **/

class DriverController extends Controller
{

    /**
     * @group Driver Management
     * 
     * Create a new driver user for a bus station.
     *
     * This endpoint allows you to create a new driver user for a specific bus station.
     * Only Accessible by Station Operators or above
     * @authenticated
     *
     * @bodyParam name string required The name of the user.
     * @bodyParam email string required The email of the user.
     * @bodyParam password string required The password of the user.
     * @bodyParam name_of_driver string required The name of the driver.
     * @bodyParam nic string required The NIC (National Identity Card) of the driver.
     * @bodyParam age integer required The age of the driver.
     * @bodyParam dob date required The date of birth of the driver.
     * @bodyParam reg_number string required The registration number of the driver.
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
     *     "driver": {
     *         "id": 1,
     *         "name": "Driver Name",
     *         "nic": "123456789",
     *         "age": 30,
     *         "dob": "1992-01-01",
     *         "reg_number": "ABC123",
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
                $user->addRole('driver');

                $driver = Driver::create([
                    'name' => $data['name_of_driver'],
                    'nic' => $data['nic'],
                    'age' => $data['age'],
                    'dob' => $data['dob'],
                    'reg_number' => $data['reg_number'],
                    'user_id' => $user->id
                ]);
                $bussstation = BusStation::where('user_id', Auth::id())->get()->first();
                $driver->BusStation()->attach($bussstation->id);
                return [
                    'user' => $user,
                    'token' => $token,
                    'driver' => $driver
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

    /**
     * @group Driver Management
     *
     * Get a list of drivers.
     *
     * This endpoint allows you to retrieve a list of drivers associated with the authenticated user's bus station.
     *
     * @authenticated
     *
     * @queryParam search string The search query. (e.g., "John")
     * @queryParam search_by string The field to search by. Possible values: "nic", "name".
     * @queryParam order_by string The field to order by. Possible values: "asc", "desc".
     *
     * @response {
     *     "current_page": 1,
     *     "data": [
     *         {
     *             "id": 1,
     *             "name": "Driver Name",
     *             "nic": "123456789",
     *             "age": 30,
     *             "dob": "1992-01-01",
     *             "reg_number": "ABC123",
     *             "user_id": 1,
     *             "created_at": "2022-01-01 00:00:00",
     *             "updated_at": "2022-01-01 00:00:00"
     *         },
     *         ...
     *     ],
     *     "first_page_url": "...",
     *     "from": 1,
     *     "last_page": 1,
     *     "last_page_url": "...",
     *     "next_page_url": null,
     *     "path": "...",
     *     "per_page": 15,
     *     "prev_page_url": null,
     *     "to": 3,
     *     "total": 3
     * }
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function index(GetDriversRequest $request)
    {
        $user = $request->user();
        $drivers = Driver::whereHas('BusStation.User', function ($query) use ($user) {
            $query->where('id', $user->id);
        })
            ->when($request->search && $request->search_by, function ($query) use ($request) {
                if ($request->search_by === 'nic') {
                    $query->where('nic', 'like', '%' . $request->search . '%');
                } elseif ($request->search_by === 'name') {
                    $query->where('name', 'like', '%' . $request->search . '%');
                }
            })
            ->when($request->order_by, function ($query) use ($request) {
                $query->orderBy('created_at', $request->order_by);
            })
            ->paginate();

        return $drivers;

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
