 
    function add_new_admin(id)
    {
        if($('#operation_permissions'+id).is(':checked'))
        {
            var total=1;
        }
        else
        {
            var total=0;
        }
        if($('#hr_checkbox'+id).is(':checked'))
        {
            var hr=1;
        }
        else
        {
            var hr=0;
        }
        if($('#lsm_checkbox'+id).is(':checked'))
        {
            var lsm=1;
        }
        else
        {
            var lsm=0;
        }
        if($('#ro_checkbox'+id).is(':checked'))
        {
            var ro=1;
        }
        else
        {
            var ro=0;
        }
        
         $.ajax({
                type: 'post',
                url: 'mcopco_administrator/add_new_admin',
                data: {operator_id: id, username: $('#username'+id).val(), password: $('#password1'+id).val(),
                    password2: $('#password2'+id).val(), firstname: $('#firstname'+id).val(),
                    lastname: $('#lastname'+id).val(), email: $('#email'+id).val(),
                    all_permissions: total, hr_checkbox: hr, lsm_checkbox: lsm, ro_checkbox: ro}, 
                success: function (html) {
                   
                    if(html=='reload_page')
                        {
                            location.reload();
                        }
                        else
                        {
                            $('#new_admin_alert'+id).html(html);
                        }
                }   
              });
    }
    
   function add_new_division_admin(id)
   {
        
         $.ajax({
                type: 'post',
                url: 'mcopco_administrator/add_new_division_admin',
                data: {division_id: id, username: $('#username'+id).val(), password: $('#password1'+id).val(),
                    password2: $('#password2'+id).val(), firstname: $('#firstname'+id).val(),
                    lastname: $('#lastname'+id).val(), email: $('#email'+id).val()}, 
                success: function (html) {
                   
                    if(html=='reload_page')
                        {
                            location.reload();
                        }
                        else
                        {
                            $('#new_admin_alert'+id).html(html);
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
                url: ' mcopco_administrator/update_permission',
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
        $('#'+field).prop('checked', checked);
        update_permission(field);

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
                url: 'mcopco_administrator/update_admin_info',
                data: { username: $('#username'+id).val(), firstname: $('#firstname'+id).val(), 
                    lastname: $('#lastname'+id).val(), email: $('#email'+id).val(), adminid: id}, 
                success: function (html) {      
                        $('#info_alert'+id).html(html);
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
    
    function admin_delete_from_region(adminid, regionid)
    {
        
            if (confirm('Are you sure you wish to delete this user from this McOpCo Region?')) {
               $.ajax({
                         type: 'post',
                         url: 'mcopco_administrator/delete_admin_from_region',
                         data: {adminid: adminid, regionid: regionid}, 
                         success: function (html) {
                             location.reload();
                         }
                         });
            }

    }

    function admin_delete_from_division(adminid, divisionid)
    {
        
            if (confirm('Are you sure you wish to delete this user from this McOpCo Division?')) {
               $.ajax({
                         type: 'post',
                         url: 'mcopco_administrator/delete_admin_from_division',
                         data: {adminid: adminid, division: divisionid}, 
                         success: function (html) {
                             location.reload();
                         }
                         });
            }

    }
