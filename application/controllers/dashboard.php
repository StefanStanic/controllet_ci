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
        $data['categories']=$this->dashboard_model->get_categories();
        $this->load->view('add_new_bill',$data);
    }
    public function add_my_income()
    {
        $this->load->view('my_income');
    }
    public function custom_bill(){
        $this->load->view('custom_bill');
    }
    public function profile(){
        $data['profile']=$this->dashboard_model->get_user_details();
        $this->load->view('profile',$data);
    }
    public function update_bill($key){
        $data['categories']=$this->dashboard_model->get_categories();
        $data['bill']=$this->dashboard_model->get_specific_bill($key);
        $this->load->view('update_bill',$data);
    }
    public function update_profile($key){
        $data['profile']=$this->dashboard_model->get_specific_profile($key);
        $this->load->view('update_profile',$data);
    }

    public function delete_bill($key){
        $this->dashboard_model->detele_specific_bill($key);
        $this->load->view('control_bills');
    }


//    public function update_bill($key){
//        $data['categories']=$this->dashboard_model->get_categories();
//        $data['bill']=$this->dashboard_model->get_specific_bill($key);
//        $this->load->view('update_bill',$data);
//    }




    public function control_bills(){
        $data['bills']=$this->dashboard_model->get_active_non_active_bills();
        $this->load->view('control_bills',$data);
    }

    public function all_income(){
        $data['income']=$this->dashboard_model->get_income();
        $this->load->view('all_income',$data);
    }
    public function one_time_bills(){
        $data['onetimebills']=$this->dashboard_model->get_onetime_bills();
        $this->load->view('one_time_bills',$data);
    }

    public function get_selected_data(){
        $cat1=$this->input->post('category1');
        $cat2=$this->input->post('category2');
        $date1=$this->input->post('date1');
        $date2=$this->input->post('date2');


        $this->load->model("dashboard_model");
        $data1=$this->dashboard_model->get_selected_data_months_1($cat1,$date1);
        $data2=$this->dashboard_model->get_selected_data_months_2($cat2,$date2);
        $data=array($data1,$data2);
        echo json_encode($data);
    }

    public function index(){
        if($this->session->userdata('is_logged_in')===1){
            $data['bills']=$this->dashboard_model->get_bills();
            $data['transactions']=$this->dashboard_model->get_transactions();
            $data['income']=$this->dashboard_model->get_income();
            $data['budget']=$this->dashboard_model->get_budget();
            $data['categories']=$this->dashboard_model->get_categories();
//            $data['current_month_statistics']=$this->dashboard_model->get_current_month_transactions_by_type();
//            $data['previous_month_statistics']=$this->dashboard_model->get_previous_month_transactions_by_type();
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
            if($amountPay=$this->dashboard_model->pay_my_bills($key)){
                $id_user=$this->session->userdata('id');
                if($this->dashboard_model->update_budget_after_pay($amountPay)){
                    redirect('dashboard'.'?rec_bill_payed=ok');
                }

            }redirect('dashboard'.'?rec_bill_payed=no');
        }else {
            echo '<h2 align="center">You are over your budget, you wont be able to pay this bill!</h2>';
            echo '<h3 align="center"><a href="'.base_url().'dashboard">Go back to dashboard</a></h3>';
        }
    }

    public function delete_income($key){
        if($status=$this->dashboard_model->detele_specific_income($key)){
            if($status=="budgetReducted"){
                redirect('dashboard/all_income'.'?status=reducted');
            }else if($status=="budgetOverflow"){
                redirect('dashboard/all_income'.'?status=overflow');
            }else{
                redirect('dashboard/all_income'.'?status=badQuery');
            }
        }

    }
//    public function update_income($key){
//        $data['income']=$this->dashboard_model->get_specific_income($key);
//        $this->load->view('update_income',$data);
//    }

//    //update income
//    public function update_income_validation() {
//        $this->form_validation->set_rules('company','company','required|trim');
//        $this->form_validation->set_rules('date_of_monthly_income','date_of_monthly_income','required|trim');
//        $this->form_validation->set_rules('amount_of_monthly_income','amount_of_monthly_income','numeric|required|trim');
//        $this->form_validation->set_rules('job_category','job_category','required|trim');
//
//        if($this->form_validation->run()) {
//            $this->load->model('dashboard_model');
//            $old_amount_income=$this->input->post('amount_of_monthly_income');
//            $data=array(
//                "company"=>$this->input->post('company'),
//                "date_of_monthly_income"=>$this->input->post('date_of_monthly_income'),
//                "amount_of_monthly_income"=>$this->input->post('amount_of_monthly_income'),
//                "job_category"=>$this->input->post('job_category'),
//                "id_user"=>$this->input->post('id_user')
//            );
//            if($this->dashboard_model->update_specific_income($data,$old_amount_income)){
//                redirect('dashboard'.'?update_new_income=ok');
//            }
//            else{
//                redirect('dashboard'.'?update_income=no');
//            }
//        }
//        else{
//            $this->load->view("my_income");
//        }
//
//    }

    public function new_rec_bill_validation() {
        $this->form_validation->set_rules('recurring_date','recurring_date','required|trim');
        $this->form_validation->set_rules('category','category','required|trim');
        $this->form_validation->set_rules('amount','amount','numeric|required|trim');
        $this->form_validation->set_rules('description','description','required|trim');

        if($this->form_validation->run()) {
            $this->load->model('dashboard_model');
            $data=array(
                "recurring_date"=>$this->input->post('recurring_date'),
                "category_id"=>$this->input->post('category'),
                "amount"=>$this->input->post('amount'),
                "description"=>$this->input->post('description'),
                "id_user"=>$this->input->post('id_user')
            );
            if($this->dashboard_model->add_re_bill($data)){
                redirect('dashboard'.'?rec_bill_add=ok');
            }
            else{
                redirect('dashboard'.'?rec_bill_add=no');
            }
        }
        else{
            redirect('dashboard');
        }

    }

    public function new_income_validation() {
        $this->form_validation->set_rules('company','company','required|trim');
        $this->form_validation->set_rules('date_of_monthly_income','date_of_monthly_income','required|trim');
        $this->form_validation->set_rules('amount_of_monthly_income','amount_of_monthly_income','numeric|required|trim');
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
                redirect('dashboard'.'?add_new_income=ok');
            }
            else{
                redirect('dashboard'.'?add_new_income=no');
            }
        }
        else{
            $this->load->view("my_income");
        }

    }
    //custom bill
    public function new_custom_bill_validation() {
        $this->form_validation->set_rules('amount','amount','required|trim');
        $this->form_validation->set_rules('description','description','required|trim');

        if($this->form_validation->run()) {
            $this->load->model('dashboard_model');
            $date=new DateTime();
            $insertDate=$date->format("y-m-d");
            $data=array(
                "date_added"=>$insertDate,
                "category"=>$this->input->post('category'),
                "amount"=>$this->input->post('amount'),
                "description"=>$this->input->post('description'),
                "id_user"=>$this->input->post('id_user')
            );
            if($amountPay=$this->dashboard_model->add_custom_bill($data)){
                if($this->dashboard_model->update_budget_after_pay($amountPay)){
                    redirect('dashboard/one_time_bills'.'?custom_bill_add=ok');
                }

            }
            else{
                echo '<h2 align="center">You are over your budget, you wont be able to pay this bill!</h2>';
                echo '<h3 align="center"><a href="'.base_url().'dashboard">Go back to dashboard</a></h3>';
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

    public function update_profile_validation() {
        $this->form_validation->set_rules('full_name','full_name','required|trim');
        $this->form_validation->set_rules('phone_number','phone_number','required|trim');
        $this->form_validation->set_rules('location_city','location_city','required|trim');
        $this->form_validation->set_rules('location_country','location_country','required|trim');

        if($this->form_validation->run()) {

            $config['upload_path']          ='./pictures/profile_pictures/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 10000;
            $config['max_width']            = 5000;
            $config['max_height']           = 5000;

            $this->load->library('upload', $config);

            $this->upload->do_upload('userpictures');


            $data=array(
                "full_name"=>$this->input->post('full_name'),
                "phone_number"=>$this->input->post('phone_number'),
                "location_city"=>$this->input->post('location_city'),
                "location_country"=>$this->input->post('location_country'),
                "picture"=>$this->upload->data('file_name'),
                "remove_picture"=>$this->input->post('remove_picture'),
                "id_user"=>$this->input->post('id_user')
            );

            $this->load->model('dashboard_model');
            if($checksomethng=$this->dashboard_model->update_re_profile($data)){
                redirect('dashboard/profile');
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