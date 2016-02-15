myApp.controller('GalleryController', [ '$scope', '$rootScope', '$http', 'Lightbox', function($scope, $rootScope, $http, Lightbox) {

		var req = {
			method: 'POST',
			url: 'app/getimages.php'
		};

		$http(req).success(function(data){
			$scope.images = data;
			// $scope.images = [
			// 					{'url': 'clubphotos/Field Day 2015/DSCN2353.JPG', 'thumbUrl': 'clubphotos/Field Day 2015/PREVIEWS/DSCN2353.JPG'},
			// 					{'url': 'clubphotos/Field Day 2015/DSCN2355.JPG', 'thumbUrl': 'clubphotos/Field Day 2015/PREVIEWS/DSCN2355.JPG'},
			// 					{'url': 'clubphotos/Field Day 2015/DSCN2356.JPG', 'thumbUrl': 'clubphotos/Field Day 2015/PREVIEWS/DSCN2356.JPG'},
			// 					{'url': 'clubphotos/Field Day 2015/DSCN2358.JPG', 'thumbUrl': 'clubphotos/Field Day 2015/PREVIEWS/DSCN2358.JPG'}
			// 				];
			//console.log(data);
			$scope.openLightboxModal = function (index) {
				Lightbox.openModal($scope.images, index);
			};

		})
		.error(function(error){
			$('#errormsg').html(error);
			//console.log(error);
		});

}]); //GalleryController
