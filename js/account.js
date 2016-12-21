jQuery(document).ready(function(){
	jQuery.noConflict();
	var linkItem = jQuery('#sideMenu li a');

	linkItem.on('click', function(event) {
		event.preventDefault();
		var myLink = jQuery(this).attr('href');

		console.log(myLink);
		jQuery('#accountContainer').load(myLink);
		jQuery('.page-loader').remove();


		/* Act on the event */
	});
});