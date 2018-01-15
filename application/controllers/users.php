<?php

/**
 * Created by PhpStorm.
 * User: stefan
 * Date: 12/24/17
 * Time: 12:18 PM
 */

class users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_users');
    }
    public function index(){
        $this->load->view("login");
    }
    public function login(){
        $this->load->view("login");
    }
    public function register(){
        $this->load->view("register");
    }
    public function forgotten_password(){
        $this->load->view("reset_password");
    }


    public function check_reset_password(){
        if($this->model_users->email_exists($this->input->post('email'))){
            $this->form_validation->set_rules('email','Email','required|valid_email|trim');
            if($this->form_validation->run()){
                urldecode($email=$this->input->post('email'));
                $config = array(
                    'protocol'=>'smtp',
                    'smtp_host'=>'ssl://smtp.gmail.com',
                    'smtp_port'=>465,
                    'smtp_user'=>'stefanmaileremail@gmail.com',
                    'smtp_pass'=>'temppassword',
                    'mailtype'=>'html',
                    'charset'=> 'iso-8859-1',
                    'wordwrap'=>TRUE
                );
                $this->load->library('email',$config);
                $this->load->model("model_users");
                $this->email->set_newline("\r\n");

                //generate a random key
                $key=md5($email."mojsalt123");
                //send email to a user
                $this->email->from('noreply@controllet.com',"Controllet Admin");
                $this->email->to($this->input->post('email'));
                $this->email->subject("Reset your password.");
                $message="<p>We are here to help you reset your account, please follow the instructions</p>";
                $message.="<p><a href='".base_url()."Users/reset_password_function/$email/$key'>Click here</a> to reset your accounts password.</p>";
                $this->email->message($message);
                if($this->email->send()){
                    redirect('users/forgotten_password'."?emailsent=ok");
                }else
                {
                    redirect('users/forgotten_password'."?emailsent=bad");
                }

            }else{
                redirect('users/forgotten_password'."?bad=ok");
            }
        }else{
            $this->load->view('users/forgotten_password');
        }
    }
    public function reset_password_function($email,$key){
        if($this->model_users->is_reset_key_valid($email,$key)){
            $data['email']=$email;
            $this->load->view("reset_password_form",$data);
        }
    }
    public function reset_password_form_check(){
        $this->form_validation->set_rules('password','Password','required|trim');
        $this->form_validation->set_rules('cpassword','Confirm Password','required|trim|matches[password]');
        if($this->form_validation->run()) {
            $email=$this->input->post('email');
            $password=sha1($this->input->post('password'));
            if($this->model_users->update_password($password,$email)){
                redirect("users/login"."?updatepass=ok");
            }
            else{
                redirect('users/forgotten_password'.'?updatepass=bad');
            }
        }
    }
}