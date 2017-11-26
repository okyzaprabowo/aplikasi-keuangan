$(document).ready(function() {
  
	var $gridSections = $('#griddler_iii article');
	
	$gridSections.hover
	(
		function()
		{
			$gridSections.removeClass('selected');
		}
	);
});