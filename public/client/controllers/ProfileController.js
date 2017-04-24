app.controller('ProfileController', function ($scope, $http) {

    $scope.loading = true;
    $scope.errorLoading = false;
    $scope.posts = [];

    $scope.init = function (id) {
        $http({
            method: 'POST',
            data: {id: id},
            url: '/Clone/public/profile/getUserPosts'
        })
        .then(function (response) {
            $scope.posts = response.data;
            $scope.loading = false;
        })
        .catch(function (err) {
            $scope.errorLoading = true;
        });
    }

    $scope.getUserPosts = function (id) {

    };

});
