<?php

namespace App\Http\Controllers;

use App\Task;
use Elasticsearch\Client;
use Illuminate\Support\Collection;
use Request;

use App\Http\Requests;

class TasksController extends Controller
{
    private $elasticsearch;

    public function __construct( Client $client )
    {
        $this->elasticsearch = $client;
    }

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

    public function search( $name = '' )
    {
        if ($name == '') {
            $tasks = $this->index();
        } else {
            $items = $this->searchOnElasticsearch( $name );
            $tasks = $this->buildCollection( $items );
        }

        return $tasks;
    }

    /**
     * @param string $query
     *
     * @result array
     */
    private function searchOnElasticsearch( $query )
    {
        $items = $this->elasticsearch->search( [
            'index' => 'todoapp',
            'type'  => 'tasks',
            'body'  => [
                'query' => [
                    'query_string' => [
                        'default_field' => 'name',
                        'query'         => '*' . $query . '*'
                    ]
                ]
            ]
        ] );

        return $items;
    }

    /**
     * @param array $items the elasticsearch result
     *
     * @return Collection of Eloquent models
     */
    private function buildCollection( $items )
    {
        $result = $items['hits']['hits'];

        return Collection::make( array_map( function ( $r ) {
            $task = new Task();
            $task->newInstance( $r['_source'], true );
            $task->setRawAttributes( $r['_source'], true );
            return $task;
        }, $result ) );
    }
}
