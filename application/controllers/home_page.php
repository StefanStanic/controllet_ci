<?php
/**
 * Created by PhpStorm.
 * User: stefan
 * Date: 12/23/17
 * Time: 1:11 AM
 */

class home_page extends CI_Controller
{
    public function index (){
        $this->load->view("home_page.php");
    }
    public function admin_login(){
        $this->load->view("admin_login");
    }

    //Regular User login validation
    public function login_validation(){
        $this->form_validation->set_rules('email','Email','required|valid_email|trim|callback_validate_credentials');
        $this->form_validation->set_rules('password','Password','required|sha1|trim');

        if($this->form_validation->run()){
            $data=array(
                'email'=>$this->input->post('email'),
                'is_logged_in'=> 1
            );
            $this->session->set_userdata($data);
            redirect("dashboard");
        }
        else{
            redirect('users/login'.'?user_login=no');
        }
    }


    public function register_validation() {
        $this->form_validation->set_rules('full_name','Full_name','required|trim');
        $this->form_validation->set_rules('email','Email','required|valid_email|trim|is_unique[users.email]');
        $this->form_validation->set_rules('password','Password','required|trim');
        $this->form_validation->set_rules('cpassword','Confirm Password','required|trim|matches[password]');
        $this->form_validation->set_rules('city','City','required|trim');
        $this->form_validation->set_rules('country','Country','required|trim');

        $this->form_validation->set_message('is_unique',"That Email address already exists");

        if($this->form_validation->run()) {

            $config['upload_path']          = './pictures/profile_pictures/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 10000;
            $config['max_width']            = 5000;
            $config['max_height']           = 5000;

            $this->load->library('upload', $config);

            $this->upload->do_upload('userpicture');

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
             $key=md5(uniqid());
             //send email to a user
             $this->email->from('noreply@controllet.com',"Controllet Admin");
             $this->email->to($this->input->post('email'));
             $this->email->subject("Confirm your account.");
             $message="<p>Thank you for signing up for Controllet</p>";
             $message.="<p><a href='".base_url()."home_page/register_user/$key'>Click here</a> to confirm your account.</p>";
             $this->email->message($message);


             if($this->model_users->add_temp_user($key)){
                 if($this->email->send()){
                     redirect('users/login');
                 }redirect('users/register'.'?email_sent=no');
             }redirect('users/register'.'?add_user=no');
             //add them to database with   flag 0
         }
         else{
             $this->load->view("register");
         }
        }


    public function validate_credentials(){
        $this->load->model('model_users');
        if($id_user=$this->model_users->can_log_in()){
            $data=array(
                'id'=>$id_user
            );
            $this->session->set_userdata($data);
            return true;
        }
        else{
            $this->form_validation->set_message('validate_credentials','Incorrect username/password or you did not activate
            your account!');
            return false;
        }
    }




    public function restricted(){
        $this->load->view('restricted');
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect('users/login');
    }
    public function register_user($key){
        $this->load->model("model_users");
        if($this->model_users->is_key_valid($key)){
            if($newData=$this->model_users->add_user($key)){

                $data =array(
                    'email'=>$newData['email'],
                    'id'=>$newData['id'],
                    'is_logged_in'=>1
                );
                $this->session->set_userdata($data);
                redirect("dashboard");
            }else echo "account failed to activate";
        }else echo "invalid key";
    }
}