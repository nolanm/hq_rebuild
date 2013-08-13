
function show_htw_div(id)
{
    $('#htw_link'+id).show();
    $('#htw_mgmt'+id).show();
    $('#htw_crew'+id).show();
    var mgmt= $('input:radio[id=hiring_to_win_force_mgmt'+id+']:checked').val();
    var crew= $('input:radio[id=hiring_to_win_force_crew'+id+']:checked').val();
    if(mgmt==0)
    {
        $('#mgmt_email'+id).show();
    }
    else
    {
        $('#mgmt_email'+id).hide();
    }
    if(crew==0)
    {
        $('#crew_email'+id).show();
    }
    else
    {
        $('#crew_email'+id).hide();
    }
    show_additional_options(id);
}

function hide_htw_div(id)
{
    $('#htw_link'+id).hide();
    $('#htw_mgmt'+id).hide();
    $('#htw_crew'+id).hide();
    $('#mgmt_email'+id).show();
    $('#crew_email'+id).show();
    show_additional_options(id)
}

function show_mgmt_email(id)
{
    $('#mgmt_email'+id).show();
    show_additional_options(id)
}

function hide_mgmt_email(id)
{
    $('#mgmt_email'+id).hide();
    show_additional_options(id)
}

function show_crew_email(id)
{
    $('#crew_email'+id).show();
    show_additional_options(id)
}

function hide_crew_email(id)
{
    $('#crew_email'+id).hide();
    show_additional_options(id)
}

function app_response(id) {
    if ($('input:radio[id=SendAppResponse'+id+']:checked').val()==1) 
    {
        $('#appresponse_default'+id).show();
        $('#appresponse'+id).hide();

   } 
   else if ($('input:radio[id=SendAppResponse'+id+']:checked').val()==2)
   {
        $('#appresponse_default'+id).hide();
        $('#appresponse'+id).show();

   }
	
}

function show_additional_options(id)
{
    if($('input:radio[id=hiring_to_win'+id+']:checked').val()==1 && 
        $('input:radio[id=hiring_to_win_force_mgmt'+id+']:checked').val()==1 &&
        $('input:radio[id=hiring_to_win_force_crew'+id+']:checked').val()==1)
    {
        $('#addOptions'+id).hide();
    }
    else
    {
        $('#addOptions'+id).show();
    }
}

function save_settings(id)
{
    
    var AppResponse= '';
    if ($('input:radio[id=SendAppResponse'+id+']:checked').val()==1) 
    {
        AppResponse= $('#AppResponseDefaultText'+id).val();
    } 
    else if ($('input:radio[id=SendAppResponse'+id+']:checked').val()==2)
    {
        AppResponse= $('#AppResponseText'+id).val();
    }
    
    $.ajax({
        type: 'post',
        url: 'save_settings',
        data: { RestaurantID: id, e_verify: $('input:radio[id=everify_'+id+']:checked').val(), hiring_to_win: $('input:radio[id=hiring_to_win'+id+']:checked').val(), 
            htw_autolink: $('input:radio[id=htw_autolink'+id+']:checked').val(), hiring_to_win_force_mgmt: $('input:radio[id=hiring_to_win_force_mgmt'+id+']:checked').val(), 
            MgmtEmail: $('#MgmtEmail'+id).val(), hiring_to_win_force_crew: $('input:radio[id=hiring_to_win_force_crew'+id+']:checked').val(),
        CrewEmail: $('#CrewEmail'+id).val(), SpanishApps: $('input:radio[id=SpanishApps'+id+']:checked').val(), HTMLApps: $('input:radio[id=HTMLApps'+id+']:checked').val(),
        SendAppResponse: $('input:radio[id=SendAppResponse'+id+']:checked').val(), AppResponseText: AppResponse}, 
        success: function (html) {
            //alert(html);
            $('#update_alert'+id).html(html);
        }   
      });
}

function accept_apps(id)
{
    $.ajax({
        type: 'post',
        url: 'restaurant_accept_appplications',
        data: { RestaurantID: id, AcceptsApps: $('input:radio[id=AcceptsApps'+id+']:checked').val()}, 
        success: function (html) {
            //alert(html);
            $('#update_alert'+id).html(html);
        }   
      });
}