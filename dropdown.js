$(document).ready(function() {
	$(document).on('change', '.type-selector', function() {
	    var visible = $('#levelDiv').is(':visible');
	    if ($(this).val() == 'RESEARCH INSTITUTION' && visible){
	    	$('#levelDiv').slideToggle();
	    } else if ($(this).val() == 'INFORMAL RESEARCH' && visible) {
	    	$('#levelDiv').slideToggle();
	    } else if ($(this).val() == 'SCHOOL' && !visible){
	    	$('#levelDiv').slideToggle();
	    }
	});
});