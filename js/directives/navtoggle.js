myApp.directive('navToggle', function() {

	$filter('addclass',function(){
		return function(activeValue,value){
			if(activeValue==value)
				return "active";
			else
				return "";
		}
	});

}); //navToggle