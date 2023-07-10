<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reg_user\GetBookingsRequest;
use App\Http\Requests\Reg_user\StoreBookingsRequest;
use App\Models\Booking;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetBookingsRequest $request)
    {
        $Booking = Booking::query()
            ->where('user_id', $request->user()->id)

            ->paginate();


        return $Booking;


        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingsRequest $request)
    {
        $data = $request->validated();
        //return $data;
        //$booking=Booking::create($data);
        // return $booking;

        try {
            $response = DB::transaction(function () use ($data) {
                $booking = Booking::create($data);

                return [
                    'booking' => $booking
                ];
            });
            return response($response); //B
        } catch (\Exception $ex) {
            return response()->json(['General Exeption = ', $ex->getMessage()], 500);
        } catch (\Error $er) {
            return response()->json(['General Error = ', $er->getMessage()], 500);
        } catch (QueryException $qr) {
            return response()->json(['General Exeption = ', $qr->getMessage()], 500);
        }
        // BBBB
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
