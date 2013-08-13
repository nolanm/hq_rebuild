
var restaurant_array;

function set_restaurants_array(restaurants)
{
    restaurant_array= restaurants;
}

function sortable_table(id)
{
    $("#table"+id).tablesorter({
        headers: { 
            // assign the secound column (we start counting zero) 
            0: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            }
        }
    }); 
}


function check_all_toggle(id)
{
    if($('#toggle_'+id).hasClass('active'))
    {
        for (var i=0;i<restaurant_array.length;i++)
        {
            $('#list-'+id+'restaurant-'+restaurant_array[i]).prop('checked', 0);
            update_box(id, restaurant_array[i]);
        }
        $('#toggle_'+id).text('Check All');
    }
    else
    {
        for (var i=0;i<restaurant_array.length;i++)
        {
            $('#list-'+id+'restaurant-'+restaurant_array[i]).prop('checked', 1);
            update_box(id, restaurant_array[i]);
        }
         $('#toggle_'+id).text('UnCheck All');
    }
}

function update_box(list, rest)
{
     if($('#list-'+list+'restaurant-'+rest).is(':checked'))
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
                url: 'distribution_lists/update_list_restaurant',
                data: { list: list, restaurant: rest, add: x}, 
                success: function (html) {
                     
                }
              });
}

    

