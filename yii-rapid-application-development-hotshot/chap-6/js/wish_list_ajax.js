$(document).ready(function() {
    $('.claim').click(function() {
        $.ajax({
            type: 'get',
            url: $(this).attr('url'),
	    data: {"ajax" : "1"},
            success: function(resp) {
		console.log(resp);
		$("ul.authors").append(resp);
            },
            error: function() {
		// FIXME display error message
            }
        });        
    });
});
