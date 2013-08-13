
var map_array= new Array();

function show_map(id,lat,lon)
{
    
    var map;

    jQuery(function($) {
        $(document).ready(function() {
            var latlng = new google.maps.LatLng(lat, lon);
            var myOptions = {
                zoom: 16,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            

            $('#map_tab'+id).on('shown', function (e) {
               map = new google.maps.Map(document.getElementById("map_canvas"+id), myOptions);
               map_array[id]=map;
            console.dir(map);
            google.maps.event.trigger(map, 'resize');
            add_marker(id,latlng);
            });
            
            $("#map_canvas"+id).css("width", 400).css("height", 400);
        });
    });
}

function lat_lng_changed(id)
{
    var lat=$("#res_lat_"+id).val();
    var lng=$("#res_lng_"+id).val();
    if(lat!='' && lng!='')
    {
        var latlng = new google.maps.LatLng(lat, lng);
        map_array[id].setCenter(latlng);
        map_array[id].setZoom(16);
        add_marker(id,latlng);
    }
}

function add_marker(id,latlng)
{
        var marker = new google.maps.Marker({
                        position: latlng,
                        draggable: true
                        });
        marker.setMap(map_array[id]);
        google.maps.event.addListener(marker, 'drag', function(event){
                    document.getElementById("res_lat_"+id).value = event.latLng.lat();
                    document.getElementById("res_lng_"+id).value = event.latLng.lng();
                });
}

function codeAddress(id)
{
    var address = document.getElementById("address_"+id).value;
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            
            var lat = results[0].geometry.location.lat();
            var lng = results[0].geometry.location.lng();
            document.getElementById("res_lat_"+id).value = lat;
            document.getElementById("res_lng_"+id).value = lng;
            map_array[id].setCenter(results[0].geometry.location);
            map_array[id].setZoom(16);
            add_marker(id,results[0].geometry.location);
            
        } else {
            alert("Address Warning: Could not map the address provided. Please check the address value and try again!");
        }
    }); 
}

function update_latlng(id)
{
     $.ajax({
                type: 'post',
                url: 'update_map',
                data: { restaurantid: id,latitude: $("#res_lat_"+id).val(),longitude: $("#res_lng_"+id).val()}, 
                success: function (html) {
                    $('#map_alert_'+id).html(html);
                }
              });
}

function save_info(restaurantid)
        {
            $.ajax({
                    type: 'post',
                    url: 'update_info',
                    data: { restaurantid: $('#restaurantid'+restaurantid).val(), StoreName: $('#StoreName'+restaurantid).val(),
                                UnitName: $('#UnitName'+restaurantid).val(), ManagerName: $('#ManagerName'+restaurantid).val(),
                                CommentsEmail: $('#CommentsEmail'+restaurantid).val(), ManagerEmail: $('#ManagerEmail'+restaurantid).val(),
                                timezone: $('#timezone'+restaurantid).val(),market_radius: $('#market_radius'+restaurantid).val()}, 
                    success: function (html) {
                       
                        $('#info_alert_'+restaurantid).html(html);
                    }
                  });
        }
    
        function addphotolistener(restaurantid)
        {

            document.getElementById('uploadedfile'+restaurantid).addEventListener('change', handleFileSelect, false);
        }
    
        function handleFileSelect(evt) {
            
                var file = evt.target.files; // FileList object

                  
                  if(escape(file.name.length) < 1) {

                  }
                  else if(file.size > 100000) {
                      alert("File is to big");
                  }
                  else if(file.type != 'image/png' && file.type != 'image/jpg' && !file.type != 'image/gif' && file.type != 'image/jpeg' ) {
                      alert("File doesnt match png, jpg or gif");
                  }
                  else {

                          var reader = new FileReader();

                          // Closure to capture the file information.
                          reader.onload = (function(theFile) {
                            return function(e) {
                              // Render thumbnail.

                              $('#upload_photo_resize'+restaurantid).html('<img class="img-polaroid" src="'+ e.target.result+
                                                '" title="'+escape(theFile.name)+'" id="upload_photo'+restaurantid+'"/>');
                              $('#upload_photo_thumb'+restaurantid).html('<img class="img-polaroid" src="'+ e.target.result+
                                                '" title="'+escape(theFile.name)+'_thumb" id="upload_thumb'+restaurantid+'"/>');


                            };
                          })(file);

                          // Read in the image file as a data URL.
                          reader.readAsDataURL(file);


                  }
                
        }
        
        function save_address(restaurantid)
        {
            $.ajax({
                    type: 'post',
                    url: 'update_address',
                    data: { restaurantid: $('#addressrestaurantid'+restaurantid).val(), MailAddress: $('#MailAddress_'+restaurantid).val(),
                                MailAddress2: $('#MailAddress2_'+restaurantid).val(), MailCity: $('#City_'+restaurantid).val(),
                                MailState: $('#State_'+restaurantid).val(), MailZip: $('#Zip_'+restaurantid).val(),
                                Phone: $('#Phone_'+restaurantid).val(), Fax: $('#Fax_'+restaurantid).val()}, 
                    success: function (html) {

                        $('#address_alert_'+restaurantid).html(html);
                    }
                  });
        }
        
        function save_background(restaurantid)
        {
             $.ajax({
                    type: 'post',
                    url: 'update_background',
                    data: { restaurantid: $('#background_restaurantid'+restaurantid).val(), background: $('input:radio[name=radio_background_'+restaurantid+']:checked').val()}, 
                    success: function (html) {

                        $('#background_alert_'+restaurantid).html(html);
                    }
                  });
        }