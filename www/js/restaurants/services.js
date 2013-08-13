
function update_service(field) {
        if($('#'+field).is(':checked'))
        {
            var x=1;
        }
        else
        {
            var x=0;
        }
	// figure out value
	//var ajax = new Ajax.Request('update_service.php', { method: 'post', parameters: { field : field, value : x }});
         $.ajax({
                type: 'post',
                url: 'update_service',
                data: { field_name: field, value: x}, 
                success: function (html) {
                }
              });
}

  function check_all(restaurantid)
    {
        var field = 'archcard_' + restaurantid;	
        $('#'+field).prop('checked', true);
	update_service(field);
	
	var field = 'cashless_' + restaurantid;
	$('#'+field).prop('checked', true);
	update_service(field);
	
	var field = 'wifi_' + restaurantid;
	$('#'+field).prop('checked', true);
	update_service(field);
	
	var field = 'redbox_' + restaurantid;
	$('#'+field).prop('checked', true);
	update_service(field);
	
	var field = 'rvbus_' + restaurantid;
	$('#'+field).prop('checked', true);
	update_service(field);
	
	var field = 'playplace_' + restaurantid;
	$('#'+field).prop('checked', true);
	update_service(field);
	
	var field = 'drivethru_' + restaurantid;
	$('#'+field).prop('checked', true);
	update_service(field);
	
	var field = 'walmart_' + restaurantid;
	$('#'+field).prop('checked', true);
	update_service(field);
	
	var field = 'mccafe_' + restaurantid;
	$('#'+field).prop('checked', true);
	update_service(field);
    }
