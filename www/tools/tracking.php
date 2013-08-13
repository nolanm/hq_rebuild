<?


require('ez_sql_mysql.php');


if (isset($_GET['src'])) {
	$src = $_GET['src'];
} else {
	$src = '';
}

$record = $db->query("INSERT INTO mobile_to_pc_links (referrer, source) VALUES ('{$_SERVER['HTTP_REFERER']}','{$src}');");

$state_url = $db->get_var("SELECT u.URL FROM URLs u, Restaurants r WHERE r.restaurantid = {$_GET['id']} AND r.stateid = u.stateid AND (u.URL <> 'www.mchays.com' AND u.URL <> 'www.mclawrence.com' AND u.URL <> 'www.mcsoutherncalifornia.com' AND u.URL <> 'www.mcohio.net');");

$url = 'http://'.$state_url.'/careers/apply-online/'.$_GET['id'].'/';

header("Location: {$url}");

?>