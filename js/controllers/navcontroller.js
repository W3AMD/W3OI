
(function() {
	'use strict';

	myApp.controller('NavigationController', NavigationController);

	NavigationController.$inject = ['$scope', '$location'];

	function NavigationController($scope, $location) {

		$scope.menuClass = function(page) {
			var current = $location.path().substring(1);
			// console.log('Path: ' + $location.path())
			return page === current ? "active" : "";
		};

		$scope.topmenuClass = function(page) {
			var current = $location.path().substring(1);
			// console.log('Top Path: ' + page)
			// console.log('Current Path: ' + $location.path())
			switch(page) {
				case 'home':
					if ( current === 'home' ) {
						return "active";
					}
					break;
				case 'clubinfo':
					if ( current === 'members' || current === 'joinrenew' || current === 'newsletter' || 
						 current === 'calendar' || current === 'location' || current === 'repeaters' || 
						 current === 'documents' || current === 'moprogs' || current === 'pictures' ) {
						
						return "active";
					}
					break;
				case 'ares':
					if ( current === 'net-controls' || current === 'net-roster' || current === 'aresinfo' ) {
						return "active";
					}
					break;
				case 'license':
					if ( current === 'VEData' ) {
						return "active";
					}
					break;
				case 'misc':
					if ( current === 'el101' || current === 'hamlinks' ) {
						return "active";
					}
					break;
				default:
					return "";
			}
		};

	}

}())
