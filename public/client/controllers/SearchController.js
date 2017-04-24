app.controller ('SearchController', function ($scope, $http, $timeout) {
	$scope.loading = true;

	$scope.results = $http ({
		method: 'GET',
		url: '/Clone/public/profile/search/' + document.querySelector('#query').dataset.name
	})
	.then (function (response) {
		$scope.results = response.data;
		$scope.loading = false;
		$timeout(function(){
	        $('.special.card .image').dimmer({
                    on: 'hover'
                });
                $('.star.rating')
                        .rating()
                ;
                $('.card .dimmer')
                        .dimmer({
                            on: 'hover'
                        })
                ;
	    }, 100);
	})
	.catch (function (error) {
		alert(error)
		$scope.loading = false;
	});

	$scope.toggleFollow = function (profileID) {
		$http ({
			method: 'POST',
			url: '/Clone/public/profile/follow',
			data: {
				'user_id': profileID
			}
		})
		.then (function (response) {
			// I need to go throught the profiles list and update the profile object
			for (var i = 0 ; i < $scope.profiles.length ; i++) {
				var profile = $scope.profiles[i];
				if (profile.id === profileID) {
					if (response.data.message === "unfollowed") {
						// Match was found here will update the profile object
						$scope.profiles[i].isFollowed = false;
					} else if (response.data.message === "followed") {
						$scope.profiles[i].isFollowed = true;
					}
				}
			}
			
		})
		.catch (function (error) {
			alert(error);
		})
	}
})