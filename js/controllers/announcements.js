myApp.controller('AnnouncementsController', 
	function($scope, $rootScope, $http) {

		$rootScope.pagetitle = "W3OI - Home";
		$rootScope.navtitle = "home";
		document.title = "W3OI - Home"; 

		$('.nav li.home').addClass('active');

		var req = {
			method: 'POST',
			url: 'app/queryannounce.php'
		};

		$http(req).success(function(data){
			$('#announcements').html(data);
			//console.log(data);
		})
		.error(function(error){
			$('#announcements').html(error);
			//console.log(error);
		});

		var req = {
			method: 'POST',
			url: 'app/w3oinetmessage.php'
		};

		$http(req).success(function(data){
			$('#mondaynet').html(data);
			//console.log(data);
		})
		.error(function(error){
			$('#mondaynet').html(error);
			//console.log(error);
		});

}); //AnnouncementsController
