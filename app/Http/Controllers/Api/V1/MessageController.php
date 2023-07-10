<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Message;
use App\Models\Thread;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
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
    public function store(StoreMessageRequest $request)
    {
        $data = $request->validated();
        //return $data;

        $thread = Thread::findOrfail($data['thread_id']);
        $thread->load('User');
        if ($thread->User->pluck('id')->contains(request()->user()->id)) {
            // The request user is part of the thread
            // Add your logic here
            try {
                $response = DB::transaction(function () use ($data, $thread) {
                    $message = Message::create($data);

                    return [
                        'thread' => $thread->load('Message')
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
        } else {
            // The request user is not part of the thread
            // Handle the case when the user is not authorized to access the thread
            return response()->json(['U are Not Authorized. U are not This Conversation  = '], 403);
        }
        //return response('asasasasaa');
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
    public function update(UpdateMessageRequest $request, Message $message)
    {
        $data = $request->validated();
        //return $data;

        // $thread=Thread::findOrfail($data['thread_id']);
        // $thread->load('User');
        if ($message->user_id == $request->user()->id) {
            // The request user is part of the thread
            // Add your logic here
            try {
                $response = DB::transaction(function () use ($data, $message) {
                    $message->update($data);

                    return [
                        'message' => $message
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
        } else {
            // The request user is not part of the thread
            // Handle the case when the user is not authorized to access the thread
            return response()->json(['U are Not Authorized. U disnt send this message  = '], 403);
        }

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Message $message)
    {
        if ($request->user()->id == $message->user_id) {
            $message->delete();
            return response()->make('', 204);
            //return response()->json(['Message Delted'], 500);
            // return  
            // return 
            // return  
            // return 
        } else {
            return response()->json(['U are Not Authorized. U disnt send this message  = '], 403);
        }
        //
    }

    public function vieworcreateThread()
    {
    }
}
