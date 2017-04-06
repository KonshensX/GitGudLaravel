app.controller('HomeController', function ($scope, $http, $timeout) {
    $scope.posts = [];
    $scope.loading = true;

    $scope.posts = $http({
        method: 'GET',
        url: '/Akkar/public/post/getPosts'
    })
        .then(function (response) {
            $scope.posts = response.data;
            $scope.loading = false;
        })
        .catch(function (err) {
            console.log(err);
        });

});