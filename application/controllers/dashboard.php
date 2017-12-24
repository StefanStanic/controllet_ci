<?php
/**
 * Created by PhpStorm.
 * User: stefan
 * Date: 12/23/17
 * Time: 1:26 AM
 */

class dashboard extends CI_Controller{
    public function index(){
        if($this->session->userdata('is_logged_in')===1){
            $this->load->view("dashboard");
        }
        else{
            redirect('home_page/restricted');
        }
    }
}