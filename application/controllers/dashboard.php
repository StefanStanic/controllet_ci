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
    public function settings()
    {
        $this->load->view('settings');
    }
    public function update_bill($key){
        $data['bill']=$this->dashboard_model->get_specific_bill($key);
        $this->load->view('update_bill',$data);
    }

    public function delete_bill($key){
        $this->dashboard_model->detele_specific_bill($key);
        $this->load->view('control_bills');
    }

    public function control_bills(){
        $data['bills']=$this->dashboard_model->get_bills();
        $this->load->view('control_bills',$data);
    }
    public function index(){
        if($this->session->userdata('is_logged_in')===1){
            $data['bills']=$this->dashboard_model->get_bills();
            $data['transactions']=$this->dashboard_model->get_transactions();
            $data['income']=$this->dashboard_model->get_income();
            $this->load->view("dashboard",$data);
        }
        else{
            redirect('home_page/restricted');
        }

    }
    public function pay_bill($key){
        /*echo $key;*/
        $this->load->model("dashboard_model");
        $id_user=$this->session->userdata('id');
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

    public function new_income_validation() {
        $this->form_validation->set_rules('company','company','required|trim');
        $this->form_validation->set_rules('date_of_monthly_income','date_of_monthly_income','required|trim');
        $this->form_validation->set_rules('amount_of_monthly_income','amount_of_monthly_income','required|trim');
        $this->form_validation->set_rules('job_category','job_category','required|trim');

        if($this->form_validation->run()) {
            $this->load->model('dashboard_model');
            $data=array(
                "company"=>$this->input->post('company'),
                "date_of_monthly_income"=>$this->input->post('date_of_monthly_income'),
                "amount_of_monthly_income"=>$this->input->post('amount_of_monthly_income'),
                "job_category"=>$this->input->post('job_category'),
                "id_user"=>$this->input->post('id_user')
            );
            if($this->dashboard_model->add_new_income($data)){
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

    public function update_rec_bill_validation() {
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
            if($this->dashboard_model->update_re_bill($data)){
                redirect('dashboard/control_bills');
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