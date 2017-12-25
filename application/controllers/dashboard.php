<?php
/**
 * Created by PhpStorm.
 * User: stefan
 * Date: 12/23/17
 * Time: 1:26 AM
 */

class dashboard extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard_model');
    }

    public function index(){
        if($this->session->userdata('is_logged_in')===1){
            $data['bills']=$this->dashboard_model->get_bills();
            $this->load->view("dashboard",$data);
        }
        else{
            redirect('home_page/restricted');
        }

    }
    public function pay_bill($key){
        /*echo $key;*/
        $this->load->model("dashboard_model");
        if($this->dashboard_model->can_pay_my_bills($key)){
            if($this->dashboard_model->pay_my_bills($key)){
                redirect("dashboard");
            }else echo "failed to find the bill";
        }else echo "failed to pay";
    }

}