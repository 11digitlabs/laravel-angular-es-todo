<?php namespace App\Observers;

use App\Task;
use Elasticsearch\Client;

class ElasticsearchTaskObserver
{
    private $elasticsearch;

    public function __construct( Client $elasticsearch )
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function created( Task $task )
    {
        $this->elasticsearch->index( [
            'index' => 'todoapp',
            'type'  => 'tasks',
            'id'    => $task->id,
            'body'  => $task->toArray()
        ] );
    }

    public function updated( Task $task )
    {
        $this->elasticsearch->index( [
            'index' => 'todoapp',
            'type'  => 'tasks',
            'id'    => $task->id,
            'body'  => $task->toArray()
        ] );
    }

    public function deleted( Task $task )
    {
        $this->elasticsearch->delete( [
            'index' => 'todoapp',
            'type'  => 'tasks',
            'id'    => $task->id
        ] );
    }
}