app.controller ('FollowersController', function ($scope, $http) {

	$scope.loading = true;

	$scope.init = function () {
		$http ({
			method: 'GET',
			url: '/Clone/public/profile/'+ document.querySelector('#name').dataset.name +'/getFollowers',
		})
		.then (function (response) {
			$scope.profiles = response.data;
			$scope.loading = false;
		})
		.catch (function (error) {
			$scope.loading = false;
			alert(error);
		});
	}

})