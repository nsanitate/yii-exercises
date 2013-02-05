function get_param_array() {
	var param_array = {};
	if (window.location.search.length > 0) {
		var query_string = window.location.search.substring(1);
		var params = query_string.split("&");
		for (var count = 0; count < params.length; count++) {
			var param_pair = params[count].split("=");
			param_array[param_pair[0]] = param_pair[1];
		}
	}
	return param_array;
}

function build_query_string(param_array) {
	var query_string = "";
	console.log(param_array);
	for (key in param_array) {
		query_string += key + "=" + param_array[key];	
	}
	if (query_string.length > 0) {
		query_string = "?" + query_string;
	}
	return query_string;
}

function get_base_uri() {
	var base_uri = document.location.protocol + "//" + document.location.hostname;
	if (document.location.port.length > 0) {
		base_uri += ":" + document.location.port;
	}
	base_uri += document.location.pathname;
	return base_uri;
}
