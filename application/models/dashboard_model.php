<?php

class dashboard_model extends CI_Model
{
    public function get_bills()
    {
        $userId = $this->session->userdata('id');
        $this->db->where('id_user', $userId);
        $this->db->where('active',1);
        $query = $this->db->get('recurring_montly_bills');
        return $query->result();
    }
    public function can_pay_my_bills($key){
        echo $key;
        $this->db->where('id_montly_bills',$key);
        $query=$this->db->get('recurring_montly_bills');
        if($query->num_rows()==1){
            return true;
        }else{
            return false;
        }
    }

        public function pay_my_bills($key){
            $data=array(
                'active'=>2
            );
            $this->db->where('id_montly_bills',$key);
            $query=$this->db->update('recurring_montly_bills',$data);
            if($query){
                return true;
            }else {
                return false;
            }
        }

}