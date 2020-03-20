$("#userAction").submit(function(e){
    e.preventDefault();
    var post_url = "/admin/action";
    var form_data = $(this).serialize();
    var btn = $(this).find("input[type=submit]:focus").attr('name');
    form_data += "&button=" + btn;
    $.post(
        post_url,
        form_data,
	    function(data, status){
		    alert("success");
        }
    );
});