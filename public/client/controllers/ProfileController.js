app.controller('ProfileController', function ($scope, $http) {

    $scope.loading = true;
    $scope.posts = [];

    $scope.init = function (id) {
        $http({
            method: 'POST',
            data: {id: id},
            url: '/Akkar/public/profile/getUserPosts'
        })
        .then(function (response) {
            $scope.posts = response.data;
            $scope.loading = false;
        })
        .catch(function (err) {
            console.log(err);
        });
    }

    $scope.getUserPosts = function (id) {

    };

});
