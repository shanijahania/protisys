
/* sorting of listings */
$('#sort_list').change(function(){
	var ptype = $(this).val();
	var vars = getUrlVars();
	delete vars["per_page"];

	vars['order'] = ptype;
	var url = 'http://' + window.location.hostname + window.location.pathname;
	var str = '';
	for(key in vars) {
		if(vars[key] != ''){
			str += key + '=' + vars[key] + '&';
		}
	}
	str = str.slice(0, str.length - 1); 
	redirect = url+'?'+str;
	window.location = redirect;

});


function getUrlVars()
{
	var pairs = location.search.slice(1).split('&');
	
	var result = {};
	pairs.forEach(function(pair) {
		pair = pair.split('=');
		result[pair[0]] = decodeURIComponent(pair[1] || '');
	});

	return JSON.parse(JSON.stringify(result));

}

