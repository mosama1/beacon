$(document).ready(function(){

	$('#filer_input').filer({
		addMore: true,
		allowDuplicates: false,
		limit: 3,
		maxSize: 3,
		extensions: ["jpg", "png", "gif"],
		showThumbs: true
	});

});
