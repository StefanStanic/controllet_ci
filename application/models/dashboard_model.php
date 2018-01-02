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

    public function get_transactions(){
        $datenow=date('Y-m-d');
        $date7=date('Y-m-d', strtotime('-1 week'));
        $userId = $this->session->userdata('id');
        $this->db->where('id_user', $userId);
//        echo "SELECT * from transactions WHERE date_of_transaction BETWEEN '$date7' AND '$datenow'";
        $query=$this->db->query("SELECT * from transactions WHERE date_of_transaction BETWEEN '$date7' AND '$datenow'");
        return $query->result();
    }

    public function get_income()
    {
        $userId = $this->session->userdata('id');
        $this->db->where('id_user', $userId);
        $query = $this->db->get('my_income');
        return $query->result();
    }

    public function get_user_details(){
    $userId = $this->session->userdata('id');
    $this->db->where('id_user',$userId);
    $query=$this->db->get('users');
    return $query->result();
    }



    public function get_budget()
    {
        $userId = $this->session->userdata('id');
        $this->db->where('id_user', $userId);
        $query = $this->db->get('budget');
        return $query->result();
    }

    public function get_specific_bill($id)
    {
        $this->db->where('id_montly_bills', $id);
        $query = $this->db->get('recurring_montly_bills');
        return $query->result();
    }

    public function get_specific_profile($id){
        $this->db->where('id_user',$id);
        $query=$this->db->get('users');
        return $query->result();
    }
    public function detele_specific_bill($id){
        $this->db->where('id_montly_bills',$id);
        $query=$this->db->delete('recurring_montly_bills');
        if($query){
            return true;
        }else{
            return false;
        }
    }


    public function can_pay_my_bills($key){
//        echo $key;
        $this->db->where('id_montly_bills',$key);
        $query=$this->db->get('recurring_montly_bills');
        $row=$query->row();

        $userID=$this->session->userdata('id');
        $this->db->where('id_user',$userID);
        $query1=$this->db->get('my_income');
        $row1=$query1->row();

//        echo $row->amount.'<br>';
//        echo $row1->amount_of_monthly_income.'<br>';
        if($row->amount <= $row1->amount_of_monthly_income){
            return $row->amount;
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
                return $row->amount;
            }else {
                return false;
            }
        }

        public function add_re_bill($data){
            $id=$data['id_user'];
            $this->db->where('id_user',$id);
            $query=$this->db->insert('recurring_montly_bills',$data);
            if($query){
                return true;
            }
            else{
                return false;
            }
        }

        public function add_new_income($data){
            $id=$data['id_user'];
            $this->db->where('id_user',$id);
            $query=$this->db->insert('my_income',$data);

            $this->db->where('id_user',$id);
            $query1=$this->db->get('budget');
            if($query1->num_rows()>0){
                $this->db->where('id_user',$id);
                $getCurrentBudget=$this->db->get('budget');
                $row=$getCurrentBudget->row();
                $currentBudgedAmout=$row->budget_amount;
                $newBudgetAmount=$data['amount_of_monthly_income'];

                $finalBudged=$currentBudgedAmout+$newBudgetAmount;

                $budgetUpdate=array(
                  "budget_amount"=>$finalBudged
                );
                $this->db->where('id_user',$id);
                $this->db->update('budget',$budgetUpdate);
            }
            else{
                $budgetAdd=array(
                    "budget_amount"=>$data['amount_of_monthly_income'],
                    "id_user"=>$id
                );
                $this->db->insert('budget',$budgetAdd);
            }
            if($query){
                return true;
            }
            else{
                return false;
            }
    }



        public function update_re_bill($data){
            $id=$data['id_user'];

            $updateData=array(
                "id_montly_bills"=>$data['id_user'],
                "recurring_date "=>$data['recurring_date'],
                "category"=>$data['category'],
                "amount"=>$data['amount'],
                "description"=>$data['description']
            );
            $this->db->where('id_montly_bills',$id);
            $query=$this->db->update('recurring_montly_bills',$updateData);
            if($query){
                return true;
            }
            else{
                return false;
            }
    }

    public function update_re_profile($data){
        $id=$data['id_user'];

        if($this->upload->data('file_name')==null){
            $updateData=array(
                "full_name"=>$data['full_name'],
                "phone_number"=>$data['phone_number'],
                "location_city"=>$data['location_city'],
                "location_country"=>$data['location_country']
            );
        }
        else{
            $updateData=array(
                "full_name"=>$data['full_name'],
                "phone_number"=>$data['phone_number'],
                "location_city"=>$data['location_city'],
                "location_country"=>$data['location_country'],
                'picture'=>$this->upload->data('file_name')
            );
        }

        $this->db->where('id_user',$id);
        $query=$this->db->update('users',$updateData);
        if($query){
            return $updateData;
        }
        else{
            return false;
        }
    }



    public function update_budget_after_pay($data){
        $id=$this->session->userdata('id');
        $this->db->where('id_user',$id);
        $query1=$this->db->get('budget');
        $row=$query1->row();
        $currentBudget=$row->budget_amount;

        $newBudget=$currentBudget-$data;
        echo $currentBudget;
        $updateData=array(
            "budget_amount"=>$newBudget
        );
        $this->db->where('id_user',$id);
        $query=$this->db->update('budget',$updateData);
        if($query){
            return true;
        }
        else{
            return false;
        }
    }

}