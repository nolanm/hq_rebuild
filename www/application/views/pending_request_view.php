<?php

$request_array= $view_data['request_array'];

?>

<div class="page-header">
    <h3>Pending Administrator Requests<br/>
    <small>If another administrator has requested to grant you permission to their organization, the requests can be accepted or denied here.</small></h3>   
</div>

<table class="table table-striped table-hovered">
    <thead>
        <th>
            Name of Sender:
        </th>
        <th>
            Affiliated With:
        </th>
        <th></th>
    </thead>
    <tbody>
        <?
            foreach($request_array as $request)
            {
                ?>
                    <tr>
                        <td>
                            <?print $request->parent_name;?>
                        </td>
                        <td>
                            <?print $request->parent_type." ".$request->parent_id;?>
                        </td>
                        <td>
                            <a class="btn btn-small" href="pending_request/accept/<?print $request->id?>/<?print $request->parent_type?>/<?print $request->parent_id?>">Accept</a>
                            <a class="btn btn-small" href="pending_request/deny/<?print $request->id?>">Deny</a>
                        </td>
                    </tr>
                <?
            }
        ?>
    </tbody>    
</table>