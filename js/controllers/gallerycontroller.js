myApp.controller('GalleryController', [ '$scope', '$rootScope', '$http', 'Lightbox', function($scope, $rootScope, $http, Lightbox) {

		var req = {
			method: 'POST',
			url: 'app/getimages.php'
		};

		$http(req).success(function(data){
			$scope.images = data;
			$scope.openLightboxModal = function (index) {
				Lightbox.openModal($scope.images, index);
			};

		})
		.error(function(error){
			$('#errormsg').html(error);
			//console.log(error);
		});

}]); //GalleryController
