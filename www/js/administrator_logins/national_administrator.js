     
   function add_new_division_admin(id)
   {
        
         $.ajax({
                type: 'post',
                url: 'national_administrator/add_new_admin',
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
   
   function add_new_region_admin(id)
   {
        
         $.ajax({
                type: 'post',
                url: 'national_administrator/add_new_admin',
                data: {region_id: id, username: $('#username'+id).val(), password: $('#password1'+id).val(),
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
   
   function add_new_coop_admin(id)
   {
        
         $.ajax({
                type: 'post',
                url: 'national_administrator/add_new_admin',
                data: {coop_id: id, username: $('#username'+id).val(), password: $('#password1'+id).val(),
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
                url: ' national_administrator/update_permission',
                data: { field_name: field, value: x}, 
                success: function (html) {

                }
              });
    }
 
    function update_admin_info(id)
    {
        
       $.ajax({
                type: 'post',
                url: 'national_administrator/update_admin_info',
                data: { username: $('#username'+id).val(), firstname: $('#firstname'+id).val(), 
                    lastname: $('#lastname'+id).val(), email: $('#email'+id).val(), adminid: id}, 
                success: function (html) {      
                        $('#info_alert'+id).html(html);
                }
              });
    }
    
    
    function admin_delete_from_coop(adminid, coopid)
    {
        
            if (confirm('Are you sure you wish to delete this user from this Coop?')) {
               $.ajax({
                         type: 'post',
                         url: 'national_administrator/delete_admin',
                         data: {adminid: adminid, coop_id: coopid}, 
                         success: function (html) {
                             location.reload();
                         }
                         });
            }

    }
    
    function admin_delete_from_region(adminid, regionid)
    {
        
            if (confirm('Are you sure you wish to delete this user from this Region?')) {
               $.ajax({
                         type: 'post',
                         url: 'national_administrator/delete_admin',
                         data: {adminid: adminid, region_id: regionid}, 
                         success: function (html) {
                             location.reload();
                         }
                         });
            }

    }

    function admin_delete_from_division(adminid, divisionid)
    {
        
            if (confirm('Are you sure you wish to delete this user from this Division?')) {
               $.ajax({
                         type: 'post',
                         url: 'national_administrator/delete_admin',
                         data: {adminid: adminid, division_id: divisionid}, 
                         success: function (html) {
                             location.reload();
                         }
                         });
            }

    }
