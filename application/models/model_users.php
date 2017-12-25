<?php
class Model_users extends CI_Model{
    public function can_log_in(){
        $this->db->where('email',$this->input->post('email'));
        $this->db->where('password',sha1($this->input->post('password')));
        $this->db->where('active',2);
        $query=$this->db->get('users');
        $userId=$query->row();

        if($query->num_rows()===1){
            return $userId->id_user;
        }
        else{
            return false;
        }
    }
    public function add_temp_user($key){
        $data=array(
            'full_name'=> $this->input->post('full_name'),
            'password'=> sha1($this->input->post('password')),
            'email'=> $this->input->post('email'),
            'phone_number'=> $this->input->post('phone'),
            'location_city'=> $this->input->post('city'),
            'location_country'=> $this->input->post('country'),
            'active'=> 1,
            'reg_key'=> $key
        );

        $query=$this->db->insert('users',$data);
        if($query){
            return true;
        }
        else{
            return false;
        }
    }
    public function is_key_valid($key){
        echo $key;
        $this->db->where('reg_key',$key);
        $query=$this->db->get('users');
        if($query->num_rows()==1){
            return true;
        }else{
            return false;
        }
    }
    public function add_user($key){
        $data=array(
          'active'=>2
        );
        $this->db->where('reg_key',$key);
        $emailGet=$this->db->get('users');
        $row=$emailGet->row();
        $query=$this->db->update('users',$data);
        $user_data=array(
            'email'=> $row->email,
            'id'=> $row->id_user
        );
        if($query){
            return $user_data;
        }else {
            return false;
        }
    }
}
?>