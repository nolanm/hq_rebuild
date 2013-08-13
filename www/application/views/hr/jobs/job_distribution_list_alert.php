
<?
    $restaurantIDs= $view_data['unpermitted_restaurants'];
?>
<div class="alert alert-block">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4>Warning!</h4>
    These restaurants will be not be assigned as part of this distribution list considering your current permissions:<br/>
    <ul>
    <?
        $i=0;
       while($i< count($restaurantIDs))
       {
           print "<li>".$restaurantIDs[$i]."</li>";
           $i++;
       }
    ?>
    </ul>
</div>
