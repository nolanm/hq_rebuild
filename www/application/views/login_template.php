<?php
/*the template will maintain order for the views. 
 * Load the template with the view you wish to show as main content for the page as a variable named 'bodycontent'
 */
$this->load->view('login/login_header');
$this->load->view($bodycontent);
$this->load->view('login/login_footer');
?>
