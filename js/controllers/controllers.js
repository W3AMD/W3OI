myApp.controller('MembershipController', function($scope, $rootScope, $http) {

	$rootScope.pagetitle = "W3OI - Membership List";
	document.title = "W3OI - Membership List";
	//$scope.rulesactive = "active";
	rulesactive = "active";
	//alert(window.location.href.toString().split(window.location.host)[1]);
	$scope.$on('$viewContentLoaded' , function() {
		//var navItem = document.getElementById("rules");
		//console.log(navItem.className);
		//navItem.className = navItem.className + " active";
	});
	//var content = $(".nav li.rules").class();
	//console.log(content);

		var req = {
			method: 'GET',
			//url: 'http://cors.io/?u=http://w3oi.dyndns.org:1091/w3oi/members.php'
			url: 'app/getmemberslist.php'
		};

		$http(req).success(function(data){
			$('#membership').html(data);
			//console.log(data);
		})
		.error(function(error){
			$('#membership').html(error);
			//console.log(error);
		});

}); //MembershipController

myApp.controller('MembershipControllerByCall', function($scope, $rootScope, $http) {

	$rootScope.pagetitle = "W3OI - Membership List";
	document.title = "W3OI - Membership List";
	//$scope.rulesactive = "active";
	rulesactive = "active";
	//alert(window.location.href.toString().split(window.location.host)[1]);
	$scope.$on('$viewContentLoaded' , function() {
		//var navItem = document.getElementById("rules");
		//console.log(navItem.className);
		//navItem.className = navItem.className + " active";
	});
	//var content = $(".nav li.rules").class();
	//console.log(content);

		var req = {
			method: 'GET',
			url: 'app/getmemberslist.php?sort=1'
		};

		$http(req).success(function(data){
			$('#membershipbycall').html(data);
			//console.log(data);
		})
		.error(function(error){
			$('#membershipbycall').html(error);
			//console.log(error);
		});

}); //MembershipController

myApp.controller('CalendarController', function($scope, $rootScope) {

		$rootScope.pagetitle = "W3OI - Calendar";
		document.title = "W3OI - Calendar";

}); //CalendarController

myApp.controller('NewsletterController',
	function($scope, $rootScope, $http) {

		$rootScope.pagetitle = "W3OI - Newsletter";
		$rootScope.navtitle = "newsletter";
		document.title = "W3OI - Newsletter";

		$('.nav li.home').addClass('active');

		var req = {
			method: 'POST',
			url: 'app/getnewsletters.php'
		};

		$http(req).success(function(data){
			$('#newsletters').html(data);
			//console.log(data);
		})
		.error(function(error){
			$('#newsletters').html(error);
			//console.log(error);
		});

}); //NewsletterController

myApp.controller('LocationController', function($scope, $rootScope) {

		$rootScope.pagetitle = "W3OI - Directions";
		document.title = "W3OI - Directions";

}); //LocationController

myApp.controller('RepeaterController', function($scope, $rootScope) {

		$rootScope.pagetitle = "W3OI - Repeater Info";
		document.title = "W3OI - Repeater Info";
		// uiGmapGoogleMapApi.then(function(maps) {

  //  		});
		$scope.map94 = { address: "St Lukes, Bethlehem, PA", zoom: 13 };
		$scope.map135 = { address: "WFMZ-TV Channel 69, East Rock Road, Allentown, PA", zoom: 13 };

}); //RepeaterController

myApp.controller('DocumentsController', function($scope, $rootScope, $http) {

		$rootScope.pagetitle = "W3OI - Documents";
		document.title = "W3OI - Documents";

		var req = {
			method: 'POST',
			url: 'app/getdocuments.php'
		};

		$http(req).success(function(data){
			$('#clubdocuments').html(data);
			//console.log(data);
		})
		.error(function(error){
			$('#clubdocuments').html(error);
			//console.log(error);
		});

}); //DocumentsController

myApp.controller('NetControlsController', function($scope, $rootScope) {

		$rootScope.pagetitle = "W3OI - Net Controls";
		document.title = "W3OI - Net Controls";

}); //NetControlsController

myApp.controller('NetRosterController', function($scope, $rootScope) {

		$rootScope.pagetitle = "W3OI - Net Roster";
		document.title = "W3OI - Net Roster";

}); //NetRosterController

myApp.controller('DstarController', function($scope, $rootScope) {

		$rootScope.pagetitle = "W3OI - Dstar";
		document.title = "W3OI - Dstar";

}); //DstarController

myApp.controller('VEDataController', function($scope, $rootScope) {

		$rootScope.pagetitle = "W3OI - VEData";
		document.title = "W3OI - VEData";

}); //VEDataController

myApp.controller('MoprogsController', function($scope, $rootScope) {

		$rootScope.pagetitle = "W3OI - Past Presentations";
		document.title = "W3OI - Past Presentations";

}); //MoprogsController

myApp.controller('ElmerController', function($scope, $rootScope) {

		$rootScope.pagetitle = "W3OI - Elmer 101";
		document.title = "W3OI - Elmer 101";

}); //ElmerController

myApp.controller('HamlinksController', function($scope, $rootScope) {

		$rootScope.pagetitle = "W3OI - Ham Links";
		document.title = "W3OI - Ham Links";

}); //HamlinksController

myApp.controller('PicturesController', function($scope, $rootScope) {

		$rootScope.pagetitle = "W3OI - Club pictures";
		document.title = "W3OI - Club pictures";

}); //HamlinksController
