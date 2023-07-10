<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRegularUserAccountRequest;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function storeRegularuserAccount(CreateRegularUserAccountRequest $request)
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
                $user->addRole('regular_user');

                // $bus_station = BusStation::create([
                //     'name' => $data['name_of_station'],
                //     'address' => $data['address'],
                //     'latitude' => $data['latitude'],
                //     'longitude' => $data['longitude'],
                //     'user_id' => $user->id
                // ]);
                return [
                    'user' => $user,
                    'token' => $token,
                    // 'bus_station' => $bus_station
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
