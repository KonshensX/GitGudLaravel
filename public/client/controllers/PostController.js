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

    $scope.deleteComment = function (id) {
        $http({
            method: 'POST',
            data: {
                id
            },
            url: '/Clone/public/comment/remove',
        })
        .then (function (response) {
            //Delete the comment from the list when the comment is deleted from the database
            if (response.data.message === "comment_deleted") {
                for(var i = 0; i < $scope.comments.length; i++) {
                    var post = $scope.comments[i];
                    if (post.id == id) {
                        $scope.comments.splice(i, 1);
                        break;
                    }
                }
            }
        })
        .catch (function (error) {
            alert(error);
        });
    }

    $scope.postComment = function (id) {
        var data = {
            'id' : id,
            'comment': $scope.comment.content
        };

        $http({
            method: 'POST', 
            url: '/Clone/public/comment/create',
            data: data 
        })
        .then (function (response) {
            console.log($scope.comments);
            $scope.comments.push(response.data);
            console.log($scope.comments);
        })
        .catch (function (error) {
            alert(error);
        });

    }

});