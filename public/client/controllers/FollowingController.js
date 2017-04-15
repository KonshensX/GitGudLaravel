app.controller ('FollowingController', function ($scope, $http, $timeout) {
	$scope.loading = true;
	
	$scope.profiles = $http({
		method: 'GET',
		url: '/Clone/public/profile/' + document.querySelector('#name').dataset.name + '/profiles'
	})
	.then (function (response) {
		console.log(response.data);
		$scope.profiles = response.data;
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
	    },100);
	})
	.catch (function (error) {
		$scope.loading = false;
		alert(error);
	});

	$scope.toggleFollow = function (profileID) {
		$http({
			method: 'POST',
			url: '/Clone/public/profile/follow',
			data: {
				'user_id': profileID
			}
		})
		.then (function (response) {
			console.log(response.data);
		})
		.catch (function (error) {
			alert(error);
		})
	}
	
});