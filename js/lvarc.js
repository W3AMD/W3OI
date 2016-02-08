
$(function() {

	"use strict";

	$('#sidenav').affix({
		offset: {
			top: function () {
				return (this.top = $('.jumbotron').outerHeight(true) - 20)
			},
			bottom: 0
		}
	})

})
