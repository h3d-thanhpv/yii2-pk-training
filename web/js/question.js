var projectApp = angular.module('questionApp', ['ngFileUpload']);

projectApp.controller('newController', ['$scope', '$http', '$filter', '$q', '$window', 'Upload', function($scope, $http, $filter, $q, $window, Upload) {
    $scope.questionInfo = {
        "question":"",
        "answers":[{
            "content":"",
            "isTrue": true
        }],
        "image":""
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
    };

    // upload later on form submit or something similar
    $scope.submit = function() {
        if ($scope.form.file.$valid && $scope.file) {
            $scope.upload($scope.file);
        }
    };

    // upload on file select or drop
    $scope.upload = function (file) {
        Upload.upload({
            url: 'upload-image',
            data: {file: file, 'username': $scope.username}
        }).then(function (resp) {
            console.log('Success ' + resp.config.data.file.name + ' uploaded. Response: ' + resp.data);
            $scope.questionInfo.image = resp.data;
        }, function (resp) {
            console.log('Error status: ' + resp.status);
        }, function (evt) {
            $scope.progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
            console.log('progress: ' + $scope.progressPercentage + '% ' + evt.config.data.file.name);
        });
    };
}]).config(['$httpProvider', function ($httpProvider) {
    $httpProvider.defaults.headers.post['X-CSRF-Token'] = $('meta[name="csrf-token"]').attr("content");
    $httpProvider.defaults.headers.common['Accept'] = 'application/json, text/javascript';
    $httpProvider.defaults.headers.common['Content-Type'] = 'application/json; charset=utf-8';
}]);