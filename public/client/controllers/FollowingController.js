app.controller ('FollowingController', function ($scope, $http) {
	$scope.loading = true;
	
	$scope.profiles = $http({
		method: 'GET',
		url: '/Clone/public/profile/' + document.querySelector('#name').dataset.name + '/profiles'
	})
	.then (function (response) {
		console.log(response.data);
		$scope.profiles = response.data;
		$scope.loading = false;
	})
	.catch (function (error) {
		$scope.loading = false;
		alert(error);
	});
	
});