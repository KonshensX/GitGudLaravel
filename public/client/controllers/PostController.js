app.controller('PostController', function ($scope, $http) {
    $scope.loading = true;
    $scope.comment_id = null;
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


    $scope.displayConfirmation = function (id) {
        $scope.comment_id = id;
        console.log($scope)
        $('.ui.basic.modal')
          .modal('show')
        ;
    }


    $scope.deleteComment = function () {
        console.log($scope);
        return;
        $http({
            method: 'POST',
            data: {
                id: $scope.commentID
            },
            url: '/Clone/public/comment/remove',
        })
        .then (function (response) {
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

    $scope.$watch ('comments', function () {
        console.log('comments var changed');
    });

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
            $scope.comments.push(response.data);
        })
        .catch (function (error) {
            alert(error);
        });

    }

});