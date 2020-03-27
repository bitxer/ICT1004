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
            alert("Successfully performed requested action");
            location.reload();
        }
    );
});

$("#contactAction").submit(function(e){
    e.preventDefault();
    var post_url = "/admin/delete";
    var form_data = $(this).serialize();
    var btn = $(this).find("input[type=submit]:focus").attr('name');
    form_data += "&button=" + btn;
    $.post(
        post_url,
        form_data,
        function(data, status){
		    alert("Successfully delete contact request");
            location.reload();
        }
    );
});
