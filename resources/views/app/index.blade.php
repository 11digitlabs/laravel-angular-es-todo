@extends('template')

@section('content')


    <div class="container" ng-app="todoTasksApp" ng-controller="todoTasksController">
        <div class="row">
            <div class="col-md-3">
                <h3>Create your tasks</h3>
                <small>Shhh... just press enter to add</small>

                <input ng-disabled="loading" type="text" ng-model="task.name"
                       ng-keyup="$event.keyCode == 13 && storeTask()">
                <button ng-disabled="loading" class="btn btn-primary btn-md" ng-click="storeTask()">Store</button>
                <i ng-show="loading" class="fa fa-refresh fa-spin"></i>
                <span ng-show="error">Name cannot be empty</span>
            </div>

            <div class="col-md-4">
                <h3>Tasks</h3>
                <small>are shown here</small>
                <table class="table table-striped">
                    <tr ng-repeat='task in tasks'>
                        <td>
                            <label>
                                <input type="checkbox" ng-true-value="1" ng-false-value="'0'"
                                       ng-model="task.is_complete"
                                       ng-change="updateTask(task)" id="task-<% $index %>">
                                <span><% task.name %></span>

                            </label>

                        </td>
                        <td style="text-align: right">
                            <button class="btn btn-danger btn-md" ng-click="deleteTask($index)"><i class="fa fa-times"></i> Delete</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

@endsection