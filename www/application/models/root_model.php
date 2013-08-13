<?php

class Root_model extends CI_Model {
        
    function userAuthenticated()
    {
        return $this->session->userdata('authenticated');
    }
}

?>
