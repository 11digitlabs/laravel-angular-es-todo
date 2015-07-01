var app = angular.module('todoTasksApp', [], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%')
    $interpolateProvider.endSymbol('%>')
})

app.controller('todoTasksController', function ($scope, $http) {

    var apiPrefix = '/api/v1/'

    $scope.tasks = []
    $scope.task = ''
    $scope.loading = false
    $scope.loadingSearch = false

    $scope.init = function () {
        $scope.loading = true
        $http.get(apiPrefix + 'tasks').
            success(function (data, status, headers, config) {
                $scope.tasks = data
                $scope.loading = false
                $scope.error = false
            })
    }

    $scope.storeTask = function () {
        $scope.loading = true
        $scope.error = false

        if ($scope.task !== '') {
            $http.post(apiPrefix + 'tasks', {
                name: $scope.task.name,
                is_complete: $scope.task.is_complete
            }).success(function (data, status, headers, config) {
                $scope.tasks.unshift(data) // Put the new tasks in the beginning
                $scope.task = ''
                $scope.loading = false
            })
        } else {
            $scope.task = ''
            $scope.loading = false
            $scope.error = true
        }


    }

    $scope.updateTask = function (task) {
        $scope.loading = true

        $http.put(apiPrefix + 'tasks/' + task.id, {
            name: task.title,
            is_complete: task.is_complete
        }).success(function (data, status, headers, config) {
            task = data
            $scope.loading = false

        })

    }

    $scope.deleteTask = function (index) {
        $scope.loading = true

        var task = $scope.tasks[index]

        $http.delete(apiPrefix + 'tasks/' + task.id)
            .success(function () {
                $scope.tasks.splice(index, 1)
                $scope.loading = false
            })

    }

    $scope.searchTask = function () {
        $scope.loadingSearch = true
        $http.get(apiPrefix + 'tasks/search/' + $scope.search.name).
            success(function (data, status, headers, config) {
                $scope.tasks = data
                $scope.loadingSearch = false
            })
    }

    $scope.init()

})