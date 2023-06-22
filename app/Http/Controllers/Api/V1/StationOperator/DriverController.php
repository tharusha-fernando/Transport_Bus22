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
        ->when($request->order_by,function($query)use($request){
            $query->orderBy('created_at',$request->order_by);
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
