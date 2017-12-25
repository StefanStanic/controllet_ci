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


            $this->db->where('id_montly_bills',$key);
            $query1=$this->db->get('recurring_montly_bills');
            $row=$query1->row();
            $transactions=array(
                "date_of_transaction"=>date("Y-m-d h:i:sa"),
                "category"=>$row->category,
                "transaction_amount"=>$row->amount,
                "id_user"=>$row->id_user
            );

            $query2=$this->db->insert('transactions',$transactions);
            if($query and $query2){
                return true;
            }else {
                return false;
            }
        }

}