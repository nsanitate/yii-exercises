$(document).ready(function() {
    $('.delete').click(function() {
	var author = "#author-" + $(this).attr('author_id');
        $.ajax({
            type: 'get',
            url: $(this).attr('url'),
            success: function() {
		$('li').remove(author);
            },
            error: function() {
            }
        });        
    });
    $('.add').click(function() {
	// get the object that our form provides
	obj = $(this).attr('obj');
	// initialize data object - it's ajax
	data = {
		"ajax" : "1"
	};
	// add form values to data object
	$("input[name^=" + obj + "]").each(
		function() {
			data[this.name] = this.value;
		}
	);
        $.ajax({
            type: 'get',
            url: $(this).attr('url'),
	    data: data,
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
