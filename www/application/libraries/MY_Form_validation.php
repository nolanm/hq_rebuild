<?php

class MY_Form_validation extends CI_Form_validation
{
    public function password_check($str)
    {
        if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str))
        {
            return TRUE;
        }
        else
        {
            $this->set_message('password_check', 'Password must ontain at least one (1) number AND letter.' );
            return FALSE;
        }
    }
    
}

?>
