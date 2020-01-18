(function($) {
    "use strict"; // Start of use strict

$(document).ready(function () {
	$(".alert").delay(500).show(10, function() {
	      $(this).delay(3000).hide(10, function() {
	        $(this).remove();
	      });
	    }); // /.alert
});

})(jQuery); // End of use strict
