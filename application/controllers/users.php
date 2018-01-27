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

    /*
     * Gets input from reset password field.
     * Check if the email exists
     * Checks if rules apply if so
     * Gets the input email, and sends that and the random generates key to email
     * Inputs generated key into db
     * Redirects to forgetten_password
     */

    public function check_reset_password(){
        if($this->model_users->email_exists($this->input->post('email'))){
            $this->form_validation->set_rules('email','Email','required|valid_email|trim');
            if($this->form_validation->run()){
                //generate Key
                $key=md5(uniqid());
                //get email
                urldecode($email=$this->input->post('email'));
                //insert into users

                if($this->model_users->insert_reset_key($key,$email)){
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

                }
                else{
                    redirect('users/forgotten_password'."?insertKey=bad");
                }

            }else{
                redirect('users/forgotten_password'."?bad=ok");
            }
        }else{
            redirect('users/forgotten_password'."?emailExists=bad");
        }
    }

    /*
     * Gets data from link (EMAIL, KEY)
     * Checks if the reset key is valid
     * If so it deletes it from db and passes the email to reset password form
     * If not, redirects with bad code
     */
    public function reset_password_function($email,$key){
        if($this->model_users->is_reset_key_valid($email,$key)){
            $data['email']=$email;
            $this->load->view("reset_password_form",$data);
        }
        else{
            redirect('users/forgotten_password'."?codebad=yes");
        }

    }

    /*
     * Gets data from the two password fields
     * If they match, and if rules apply updates the password in the DB
     * Redirects to login with OK
     * Else redirects with BAD
     */

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