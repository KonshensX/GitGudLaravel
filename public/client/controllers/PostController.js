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
        $('.ui.basic.modal')
          .modal('show')
        ;
    }


    $scope.deleteComment = function () {
        $http({
            method: 'POST',
            data: {
                id: $scope.comment_id
            },
            url: '/Clone/public/comment/remove',
        })
        .then (function (response) {
            if (response.data.message === "comment_deleted") {
                for(var i = 0; i < $scope.comments.length; i++) {
                    var comment = $scope.comments[i];
                    if (comment.id == $scope.comment_id) {
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
            $scope.comments.push(response.data);
            console.log($scope);
        })
        .catch (function (error) {
            alert(error);
        });

    }

});