var myApp = angular.module('LVARC', ['ngRoute', 'appControllers', 'ui.bootstrap', 'uiGmapgoogle-maps', 'bootstrapLightbox', 'ngTouch'])

var appControllers = angular.module('appControllers', ['uiGmapgoogle-maps']);

// myApp.config(function(uiGmapGoogleMapApiProvider) {
//     uiGmapGoogleMapApiProvider.configure({
//         //    key: 'your api key',
//         v: '3.20', //defaults to latest 3.X anyhow
//         libraries: 'weather,geometry,visualization'
//     });
// })

myApp.config(['$routeProvider', function($routeProvider) {
	$routeProvider.
		when('/home', {
			templateUrl: 'views/home.html',
			controller: 'AnnouncementsController'
		}).
		when('/members', {
			templateUrl: 'views/members.html',
			controller: 'MembershipController'
		}).
		when('/membersbycall', {
			templateUrl: 'views/membersbycallsuffix.html',
			controller: 'MembershipControllerByCall'
		}).
		when('/joinrenew', {
			templateUrl: 'views/membership.html',
			controller: 'JoinRenewController'
		}).
		when('/calendar', {
			templateUrl: 'views/calendar.html',
			controller: 'CalendarController'
		}).
		when('/newsletter', {
			templateUrl: 'views/newsletter.html',
			controller: 'NewsletterController'
		}).
		when('/location', {
			templateUrl: 'views/location.html',
			controller: 'LocationController'
		}).
		when('/repeaters', {
			templateUrl: 'views/repeaters.html',
			controller: 'RepeaterController'
		}).
		when('/documents', {
			templateUrl: 'views/documents.html',
			controller: 'DocumentsController'
		}).
		when('/net-controls', {
			templateUrl: 'views/net-controls.html',
			controller: 'NetControlsController'
		}).
		when('/net-roster', {
			templateUrl: 'views/net-roster.html',
			controller: 'NetRosterController'
		}).
		when('/dstarinfo', {
			templateUrl: 'views/dstarinfo.html',
			controller: 'DstarController'
		}).
		when('/VEData', {
			templateUrl: 'views/VEData.html',
			controller: 'VEDataController'
		}).
		when('/moprogs', {
			templateUrl: 'views/moprogs.html',
			controller: 'MoprogsController'
		}).
		when('/el101', {
			templateUrl: 'views/el101.html',
			controller: 'ElmerController'
		}).
		when('/hamlinks', {
			templateUrl: 'views/hamlinks.html',
			controller: 'HamlinksController'
		}).
		when('/pictures', {
			templateUrl: 'views/pictures.html',
			controller: 'PicturesController'
		}).
		otherwise({
			redirectTo: '/home'
		});
}]);
