<?php

namespace App\Http\Controllers;

use App\Task;
use Request;

use App\Http\Requests;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tasks = Task::orderBy( 'created_at', 'desc' )->get();
        return $tasks;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $task = Task::create( Request::all() );
        return $task;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update( $id )
    {
        $task              = Task::find( $id );
        $task->is_complete = Request::input( 'is_complete' );
        $task->save();

        return $task;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy( $id )
    {
        Task::destroy( $id );
    }
}
