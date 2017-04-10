app.controller('PostController', function ($scope, $http) {
    $scope.loading = true;

    //Get the comments from the database
    $scope.comments = $http({
        url: '/Clone/public/comment/getPostComments/' + document.querySelector('#id').dataset.id
    })
    .then(function (response) {
        $scope.comments = response.data;
        $scope.loading  = false;
    })
    .catch (function (err) {
        console.error(err);
        $scope.loading  = false;
    });

});