<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetReviewsRequest;
use App\Http\Requests\StoreReviewsRequest;
use App\Models\Review;
use App\Models\Reviews;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetReviewsRequest $request)
    {
        $reviews=Review::with('Trip.Bus.Driver')
        ->when($request->trip, function ($query) use ($request) {
            $query->where('trip_id', 'like', '%' . $request->trip . '%');
        })
        ->when($request->bus, function ($query) use ($request) {
            $query->whereHas('Trip.Bus', function ($query1) use ($request) {
                $query1->where('license_plate', $request->bus);
            });
        })
        ->when($request->driver, function ($query) use ($request) {
            $query->whereHas('Trip.Bus.Driver', function ($query1) use ($request) {
                $query1->where('name', $request->driver);
                $query1->orWhere('nic', $request->driver);
            });
        })
        ->paginate();

        return $reviews;
        
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewsRequest $request)
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
