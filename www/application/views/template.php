<?php
$this->load->view('template/header2');
$this->load->view('template/navigation2');
if(empty($view_data))
{
    $this->load->view($bodycontent);
}
else
{
    $this->load->view($bodycontent, $view_data);
}
$this->load->view('template/footer');
?>

