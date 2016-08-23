var projectApp = angular.module('pkTrainApp', []);

projectApp.controller('loadBookCtrl', ['$scope', '$http', '$filter', function($scope, $http, $filter) {
    $scope.bookInfo = {};
    $scope.baseUrl = "http://localhost/yii2-training/api/v1/books/";
    $scope.$watch('bookId', function (bookId) {
        if (angular.isDefined(bookId)) {

        }
    });
    function getBookInfo(url) {
        $http({
            method: 'GET',
            url: url
        }).success(function (data) {
            $scope.sequenceId = data;
        }).error(function (data, status, headers, config) {
        });
    }
}]);