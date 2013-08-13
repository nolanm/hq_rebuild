var package_id;
var shown_count;

function show_package_items(id)
{
    
    $("#package"+id).on("show",function(event){
         $.ajax({
                    type: 'post',
                    url: 'package_items',
                    data: { packageid: id }, 
                    success: function (html) {
                        
                        $('#items'+id).html(html);
                        
                    }   
                  });
     });


}

function create_sortable(id) {
    
    $( "#list_"+id ).sortable({
        stop: function( event, ui )
        {
        var neworder = new Array();

           $("#list_"+id+' li').each(function() {    

               //get the id
               var id  = $(this).attr("id");

               //push the object into the array
               neworder.push(id);

           });
        $.ajax({
           type: 'post',
           url: 'sort_items',
           data: { packageid: id , sorting_list: neworder}, 
           success: function (html) {}   
         });

        }
    });
    
   
}


function new_benefit_item(package_id)
{
    if($('#newBenefit_name'+package_id).val()=='')
    {
        alert("Name is a required field.");
    }
    else
    {
        var header=0;
        if($('#newBenefit_headingYes'+package_id).is(':checked'))
        {
            header=1;
        }

        $.ajax({
                type: 'post',
                url: 'new_package_item',
                data: { name: $('#newBenefit_name'+package_id).val(), header: header,
                    package_id: package_id }, 
                success: function (html) {
                    $('#items_'+package_id).html(html);
                }   
              });
    }
}

function update_package_assignments(package_id)
{
    var restaurants;
    if($('#radioall'+package_id).is(':checked'))
    {
       restaurants= $('#allstores'+package_id).val();
    }
    else if($('#radiostores'+package_id).is(':checked'))
    {
        restaurants= $('#stores'+package_id).val();
    }
    $.ajax({
                type: 'post',
                url: 'update_assignments',
                data: { id: package_id, restaurants: restaurants }, 
                success: function (html) {
                    $('#update_alert_assignments'+package_id).html(html);
                }   
              });
}

function update_item(id)
{
    if($('#benefit_name'+id).val()=='')
    {
        alert("Name is a required field.");
    }
    else
    {
        $.ajax({
                type: 'post',
                url: 'update_item',
                data: { name: $('#benefit_name'+id).val(), description: $('#item_description'+id).val(),
                    id: id }, 
                success: function (html) {
                    $('#update_alert_item'+id).html(html);
                }   
              });
    }
}

function delete_item(itemid, packageid)
{
    if(confirm("Are you sure you want to delete this benefit item?")) {
    $.ajax({
            type: 'post',
            url: 'delete_item',
            data: { item_id: itemid, package_id: packageid }, 
            success: function (html) {
                $('#items_'+packageid).html(html);
            }   
          });
    }
}

function delete_package(packageid)
{
    if(confirm("Are you sure you want to delete benfit package?")) 
    {
        $.ajax({
            type: 'post',
            url: 'delete_package',
            data: { package_id: packageid }, 
            success: function (html) {
               location.reload();
            }   
          });
    }
    
}

function distListDisplay(id) {
    restaurantsdiv = 'restaurants_' + id;
    distributiondiv = 'distribution_' + id;
    if($('#radioall'+id).is(':checked'))
    {
        $('#'+restaurantsdiv).hide();
        $('#'+distributiondiv).hide();
    }
    else if($('#radiostores'+id).is(':checked'))
    {
        $('#'+restaurantsdiv).show();
        $('#'+distributiondiv).hide();
    }
    else if($('#radiodist'+id).is(':checked'))
    {
        $('#'+restaurantsdiv).hide();
        $('#'+distributiondiv).show();
    }
}