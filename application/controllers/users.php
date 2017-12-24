<?php
/**
 * Created by PhpStorm.
 * User: stefan
 * Date: 12/24/17
 * Time: 12:18 PM
 */

class users extends CI_Controller
{
    public function index(){
        $this->load->view("login");
    }
    public function login(){
        $this->load->view("login");
    }
    public function register(){
        $this->load->view("register");
    }
}