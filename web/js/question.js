var projectApp = angular.module('questionApp', []);

projectApp.controller('newController', ['$scope', '$http', '$filter', '$q', '$window', function($scope, $http, $filter, $q, $window) {
    $scope.questionInfo = {
        "question":"",
        "answers":[{
            "content":"",
            "isTrue": true
        }]
    };
    $scope.addAnswer = function () {
        $scope.questionInfo.answers.push({
            "content":"",
            "isTrue": false
        });
    };

    $scope.createQuestion = function () {
        $http.post('create-question', $scope.questionInfo).success(function() {
            $window.location.href = 'index';
        });
    }
}]).config(['$httpProvider', function ($httpProvider) {
    $httpProvider.defaults.headers.post['X-CSRF-Token'] = $('meta[name="csrf-token"]').attr("content");
    $httpProvider.defaults.headers.common['Accept'] = 'application/json, text/javascript';
    $httpProvider.defaults.headers.common['Content-Type'] = 'application/json; charset=utf-8';
}]);