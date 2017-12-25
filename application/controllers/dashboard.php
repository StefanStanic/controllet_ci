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

    public function add_new_bill(){
        $this->load->view('add_new_bill');
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

    public function new_rec_bill_validation() {
        $this->form_validation->set_rules('recurring_date','recurring_date','required|trim');
        $this->form_validation->set_rules('category','category','required|trim');
        $this->form_validation->set_rules('amount','amount','required|trim');
        $this->form_validation->set_rules('description','description','required|trim');

        if($this->form_validation->run()) {
            $this->load->model('dashboard_model');
            $data=array(
                "recurring_date"=>$this->input->post('recurring_date'),
                "category"=>$this->input->post('category'),
                "amount"=>$this->input->post('amount'),
                "description"=>$this->input->post('description'),
                "id_user"=>$this->input->post('id_user')
            );
            if($this->dashboard_model->add_re_bill($data)){
                redirect('dashboard');
            }
            else{
                redirect('dashboard');
            }
        }
        else{
            redirect('dashboard');
        }
    }
}