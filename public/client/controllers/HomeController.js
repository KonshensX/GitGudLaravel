app.controller('HomeController', function ($scope, $http, $timeout) {
    $scope.posts = [];
    $scope.loading = true;
    $scope.errorLoading = false;

    $scope.posts = $http({
        method: 'GET',
        url: '/Clone/public/post/getPosts'
    })
    .then(function (response) {
        $scope.posts = response.data;
        $scope.loading = false;
    })
    .catch(function (err) {
        $scope.errorLoading = true;
        $scope.loading = true;
    });


    $scope.likePost = function (id) {
        $http({
            method: 'POST',
            url: '/Clone/public/like/like',
            data: {id: id}
        })
        .then(function (response) {
            for(var i = 0; i < $scope.posts.length; i++) {
                var post = $scope.posts[i];
                if (post.id == id) {
                    $scope.posts[i].liked = response.data.liked;
                    $scope.posts[i].likesCount = response.data.likesCount;
                    return;
                }
            }
        })
        .catch(function (error) {
            alert(error);
        });
    }

});