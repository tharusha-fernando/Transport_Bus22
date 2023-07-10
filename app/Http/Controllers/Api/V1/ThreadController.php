<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
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
    public function show(Request $request,User $user)
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




    public function create_show(Request $request,User $user){
        $Thread = Thread::whereHas('User', function ($query) use ($user,$request) {
            $query->where('users.id', $request->user()->id);
        })
            ->whereHas('User', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })->with('Message')
            ->get();


        //return $Thread;    

        //dd($Thread);
        if ($Thread->isEmpty()) {
            //return response("asasasas");
            $Thread = Thread::create();
            $Thread->User()->attach($user);
            $Thread->User()->attach($request->user()->id);
            $Thread->load('Message');
            return $Thread;
        } else {
            //return response("asasasas");
            //dd($Thread); 
            //$Thread->load('Message');
            return $Thread;
        }
    }
}
