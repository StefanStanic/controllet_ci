<?php

/**
 * Created by PhpStorm.
 * User: stefan
 * Date: 12/24/17
 * Time: 12:18 PM
 */

class admins extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard_model');
    }


    public function index(){
        $this->load->view("admin_login");
    }
    public function admin_login(){
        $this->load->view("admin_login");
    }
    public function admin_dashboard(){
        $data['categories']=$this->dashboard_model->get_categories();
        $data['user_statistics']=$this->dashboard_model->get_user_statistics();
        $data['transactions_statistics']=$this->dashboard_model->get_transactions_statistics();
        $data['bills_statistics']=$this->dashboard_model->get_bills_statistics();
        $this->load->view("controllet_admin",$data);
    }


    // admin login validation
    public function admin_login_validation(){
        $this->form_validation->set_rules('username','Username','required|trim|callback_admin_validate_credentials');
        $this->form_validation->set_rules('password','Password','required|sha1|trim');

        if($this->form_validation->run()){
            $data=array(
                'id_admin'=>$this->input->post('username')
            );
            $this->session->set_userdata($data);
            redirect("admins/admin_dashboard");
        }
        else{
            redirect('admins/admin_login'.'?admin_login=no');
        }
    }

    public function admin_validate_credentials(){
        $this->load->model('model_users');
        if($admin_username=$this->model_users->admin_can_log_in()){
            $data=array(
                'admin_username'=>$admin_username
            );
            $this->session->set_userdata($data);
            return true;
        }
        else{
            $this->form_validation->set_message('validate_credentials','Incorrect username/password');
            return false;
        }
    }

    public function add_category(){
        $this->form_validation->set_rules('category','category','required|trim');

        if($this->form_validation->run()) {
            $this->load->model('dashboard_model');
            $data=array(
                "category_name"=>$this->input->post('category'),
            );
            if($this->dashboard_model->add_new_category($data)){
                redirect('admins/admin_dashboard'.'?category_added=ok');
            }
            else{
                redirect('admins/admin_dashboard'.'?category_added=no');
            }
        }
    }
    public function delete_category($key){
        $this->db->where('id_category',$key);
        $query=$this->db->delete('category');
        if($query){
            redirect('admins/admin_dashboard'.'?category_deleted=ok');
        }else{
            redirect('admins/admin_dashboard'.'?category_deleted=no');
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('admins/admin_login');
    }
}