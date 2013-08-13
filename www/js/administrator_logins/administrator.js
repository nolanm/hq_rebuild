


    $("#new_admin_button").button('toggle');
    $("#existing_admin_button").button('toggle');
    
    
    function admin_search()
    {
        $.ajax({
                type: 'post',
                url: 'administrator/admin_search',
                data: { username: $('#search_admin_username').val(), firstname: $('#search_admin_first').val(), 
                    lastname: $('#search_admin_last').val(), email: $('#search_admin_email').val()}, 
                success: function (html) {  
                        if(html!='')
                        {   
                            $('#existing_permissions').show();
                            $('#add_existing_button').button ("enable");
                        }
                        else
                        {
                            $('#existing_permissions').hide();
                            $('#add_existing_button').attr("disabled","disabled");
                        }
                        $('#admin_results').html(html);
                }
              });
    }
    
    function add_new_admin()
    {
        if($('#operation_permissions').is(':checked'))
        {
            var total=1;
        }
        else
        {
            var total=0;
        }
        if($('#hr_checkbox').is(':checked'))
        {
            var hr=1;
        }
        else
        {
            var hr=0;
        }
        if($('#lsm_checkbox').is(':checked'))
        {
            var lsm=1;
        }
        else
        {
            var lsm=0;
        }
        if($('#ro_checkbox').is(':checked'))
        {
            var ro=1;
        }
        else
        {
            var ro=0;
        }
        
         $.ajax({
                type: 'post',
                url: 'administrator/add_new_admin',
                data: { username: $('#username').val(), password: $('#password1').val(),
                    password2: $('#password2').val(), firstname: $('#firstname').val(),
                    lastname: $('#lastname').val(), email: $('#email').val(), 
                    hr_restaurants: $('#hr_selector').val(), lsm_restaurants: $('#lsm_selector').val(),
                    ro_restaurants: $('#ro_selector').val(), all_permissions: total, hr_checkbox: hr, 
                    lsm_checkbox: lsm, ro_checkbox: ro}, 
                success: function (html) {
                    if(html=='')
                        {
                            location.reload();
                        }
                        else
                        {
                            $('#new_admin_alert').html(html);
                        }
                }   
              });
    }
    
    function add_request()
    {
        if($('#total_permissions_existing').is(':checked'))
        {
            var total=1;
        }
        else
        {
            var total=0;
        }
        if($('#hr_checkbox_existing').is(':checked'))
        {
            var hr=1;
        }
        else
        {
            var hr=0;
        }
        if($('#lsm_checkbox_existing').is(':checked'))
        {
            var lsm=1;
        }
        else
        {
            var lsm=0;
        }
        if($('#ro_checkbox_existing').is(':checked'))
        {
            var ro=1;
        }
        else
        {
            var ro=0;
        }
         $.ajax({
                type: 'post',
                url: 'administrator/add_request',
                data: { adminid: $('#existing_adminid').val(),hr_restaurants: $('#hr_selector_existing').val(), lsm_restaurants: $('#lsm_selector_existing').val(),
                    ro_restaurants: $('#ro_selector_existing').val(), all_permissions: total, hr_checkbox: hr, 
                    lsm_checkbox: lsm, ro_checkbox: ro}, 
                success: function (html) {
                    if(html=='')
                    {
                        location.reload();
                    }
                    else
                    {
                        $('#existing_admin_alert').html(html);
                    }
                        
                }   
              });
    }
    
    function update_permission(field)
    {
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
                url: 'administrator/update_permission',
                data: { field_name: field, value: x}, 
                success: function (html) {
                       
                }
              });
    }

    function check_all_hr(id, checked)
    {
        var field = 'jobs_crew-' + id;	
        $('#'+field).prop('checked', checked);
        update_permission(field);
        
        var field = 'jobs_mgmt-' + id;	
        if($('#'+field).length>0)
        {
            $('#'+field).prop('checked', checked);
            update_permission(field);
        }

        var field = 'benefits-' + id;
        $('#'+field).prop('checked', checked);
        update_permission(field);
        
        var field = 'application_settings-' + id;
        $('#'+field).prop('checked', checked);
        update_permission(field);

        var field = 'ray_kroc-' + id;
        $('#'+field).prop('checked', checked);
        update_permission(field);

        var field = 'hiring_day-' + id;
        $('#'+field).prop('checked', checked);
        update_permission(field);
    }

    function check_all_lsm(id, checked)
    {
        var field = 'content-' + id;	
        $('#'+field).prop('checked', checked);
        update_permission(field);

        var field = 'mcteachers_night-' + id;
        $('#'+field).prop('checked', checked);
        update_permission(field);

        var field = 'donation_request-' + id;
        $('#'+field).prop('checked', checked);
        update_permission(field);

        var field = 'grand_opening-' + id;
        $('#'+field).prop('checked', checked);
        update_permission(field);

        var field = 'calendar_of_events-' + id;
        $('#'+field).prop('checked', checked);
        update_permission(field);

        var field = 'tours-' + id;	
        $('#'+field).prop('checked', checked);
        update_permission(field);

        var field = 'orange_bowl-' + id;
        $('#'+field).prop('checked', checked);
        update_permission(field);

        var field = 'power_bowl-' + id;
        $('#'+field).prop('checked', checked);
        update_permission(field);

        var field = 'birthday_party_to_go-' + id;
        $('#'+field).prop('checked', checked);
        update_permission(field);

        var field = 'birthday_party_reservation-' + id;
        $('#'+field).prop('checked', checked);
        update_permission(field);

        var field = 'brand_trust-' + id;
        $('#'+field).prop('checked', checked);
        update_permission(field);
    }

    function check_all_operations(id, checked)
    {
        var field = 'restaurant_settings-' + id;	
        $('#'+field).prop('checked', checked);
        update_permission(field);

        var field = 'hours-' + id;
        $('#'+field).prop('checked', checked);
        update_permission(field);

        var field = 'services-' + id;
        $('#'+field).prop('checked', checked);
        update_permission(field);

    }
    
    function update_admin_info(id)
    {
        
       $.ajax({
                type: 'post',
                url: 'administrator/update_admin_info',
                data: { username: $('#username'+id).val(), firstname: $('#firstname'+id).val(), 
                    lastname: $('#lastname'+id).val(), email: $('#email'+id).val(), adminid: id}, 
                success: function (html) {      
                        $('#info_alert'+id).html(html);
                }
              });
    }
    
    function add_restaurants(id)
    {
        if($('#all_rest_'+id).is(':checked'))
        {
            var all=1;
        }
        else
        {
            var all=0;
        }
        $.ajax({
                type: 'post',
                url: 'administrator/add_restaurants_to_admin',
                data: { all: all, restaurants: $('#restaurant_selector'+id).val(), adminid: id}, 
                success: function (html) {
                    window.location.href = "administrator";
                }
                });
        
    }
    
    function uncheck_all_permissions(id)
    {
        check_all_hr(id,false);
        check_all_lsm(id,false);
        check_all_operations(id,false);
            $('#alert_'+id).html('<p class="alert alert-error fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>This administrator\'s permissions for this restaurant have been cleared!</strong></p>');
    }
    
    function check_all_permissions(id)
    {
        check_all_hr(id,true);
        check_all_lsm(id,true);
        check_all_operations(id,true);
        $('#alert_'+id).html('<p class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>This administrator now has all permissions for this restaurant!</strong></p>');
    }
    
    function admin_delete(id)
    {
        
   if (confirm('Are you sure you wish to delete this user from your Operations?')) {
      $.ajax({
                type: 'post',
                url: 'administrator/delete_admin',
                data: {adminid: id}, 
                success: function (html) {
                   location.reload();
                }
                });
   }

}