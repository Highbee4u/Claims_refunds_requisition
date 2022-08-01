<?php  
// filename: Consultant.php
if(!file_exists("config.php")){
    require_once 'config.php';
}

class Consultant {

    private $table = 'claims_header';

    private $detail = 'claims_detail';

    public function myencrypt($str){
        return md5($str);
    }

    public function sanitize($array) {
        $con = connection::getConnection();
        foreach($array as $key=>$value) {
            if(is_array($value)) { 
                $this->sanitize($value); 
            }else { 
                $array[$key] = mysqli_real_escape_string($con, $value); 
            }
        }
        return $array;
    }

    

    public function create($data, $table_name){
        $cleaned_request = $this->sanitize($data);
        
        $con = connection::getConnection();

        $sql = "INSERT INTO ".$table_name. "(". implode(",", array_keys($cleaned_request)) .") VALUE ('" . implode("','", array_values($cleaned_request)). "')";

        // return $sql;
        $result = $con->query($sql);
        
        $id = $con->insert_id;

        $response = array("id"=>$id);

        return $result ? $response : "";

    }

    public function fetch_all(){
        
        $data = array();

        $con = connection::getConnection();

        $sql = "SELECT * FROM $this->table ORDER BY id desc";

        $result = $con->query($sql);

        if($result){

            while($row = $result->fetch_assoc()){

                $data[] = $row;

            }
        }

        return $data;
    }

    public function fetch_all_category($table_name){
        
        $data = array();

        $con = connection::getConnection();

        $sql = "SELECT * FROM ".$table_name;

        $result = $con->query($sql);

        if($result){

            while($row = $result->fetch_assoc()){

                $data[] = $row;

            }
        }

        return $data;
    }

    public function fetch_by_criterial($conditions = array(), $table_name){
        
        $data = array();
        $con = connection::getConnection();

        $filter = '';
        foreach($conditions as $col=>$colval){
            $filter .= "`".$col."` = '".$colval."' AND";
        }

        $filters = substr($filter,0, -3);

        $sql = 'SELECT * FROM '.$table_name.' WHERE '.$filters. ' ORDER BY id DESC'; 

        $user_data = array();
        $count_row = 0;

        $result = $con->query($sql);
        
        if($result){
            $count_row = $result->num_rows;
        }

        if($count_row > 0){
            while($row = $result->fetch_assoc()){
                $user_data[] = $row;
            }
        }
        return $user_data;
    }

    public function delete_claims($claimid){
        
        $con = connection::getConnection();

        $id = implode(',',$claimid);       

        $query = "DELETE FROM `$this->table`  WHERE id='".$id."'";

        if($con->query($query)){

            $qry = "DELETE FROM `$this->detail`  WHERE claim_id='".$id."'";

            $result = $con->query($qry);

            return $result ? true : false;

        } else {
            return false;
        }

        
    }

    public function update_claim_detail($data){
        $cleaned_request = $this->sanitize($data);

        $con = connection::getConnection();

        $sql = "UPDATE $this->detail SET 'Amount' = '".$cleaned_request['Amount']."', 'Description' = '".$cleaned_request['Description']."' WHERE id = '".$cleaned_request['id']."' AND claim_id = '".$cleaned_request['claim_id']."'";
        
        $result = $con->query($sql);

        return $result ? true : false ; 

    }

    public function delete_claim_detail($data){
        $con = connection::getConnection();
        
        $id = implode(',', $data);

        $query = "DELETE FROM ".$this->detail ." WHERE id= '".$id."'";


        $result = $con->query($query);

        return $result ? true : false;

    }

    public function approval_request($claimid){
        $con = connection::getConnection();

        $id = implode(',',$claimid);

        $query = "UPDATE `$this->table` SET `approvalRequest` = '1'  WHERE id='$id'";

        // return $query;
        $result = $con->query($query);

        return $result ? true : false;
    }

    public function approval_claim($claimid){
        $con = connection::getConnection();

        $id = implode(',',$claimid);

        $query = "UPDATE `$this->table`  SET `Approved` = '1', `Approveddate` = '".date('Y-m-d h:i:s', time())."', `returned` = 0, `returnedby` = '', `returneddate` = NULL WHERE id ='".$id."'";

         $result = $con->query($query);

         return $result ? true : false;
    }

    public function audit_approval_claim($data){
        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data);        

        $query = "UPDATE `$this->table` SET `Approved`='1', `Audited`='1', `hrstatus`='1', `hrname`='".$cleaneddata['userid']."', `Approvedby`='".$cleaneddata['userid']."',`Auditedby`='".$cleaneddata['userid']."', `Approveddate` = '".date('Y-m-d h:i:s', time())."', `auditeddate` = '".date('Y-m-d h:i:s', time())."' WHERE id ='".$cleaneddata['id']."'";

        // return $query;
        $result = $con->query($query);

        return $result ? true : false;
    }

    public function audit_set_approval($data){

        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data);        

        $query = "UPDATE `$this->table` SET `Audited`='1', `Approvedby`='".$cleaneddata['approvedby']."',`Auditedby`='".$cleaneddata['userid']."', `auditeddate` = '".date('Y-m-d h:i:s', time())."' WHERE id ='".$cleaneddata['id']."'";

        $result = $con->query($query);

        return $result ? 1 : 0;
    }

    public function updatepaymentstatus($data){
        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data); 

        $query = "UPDATE `$this->table` SET `Accounting_status`='1', `payment_process_status`='1', `payment_date`='".date('Y-m-d h:i:s', time())."', `paidby` = '".$cleaneddata['userid']."' WHERE id ='".$cleaneddata['id']."'";

        $result = $con->query($query);

        return $result ? 1 : 0;
    }

    public function updatepaymentprocessstatus($claimid){

        $con = connection::getConnection();

        $id = implode(',', $claimid); 

        $query = "UPDATE `$this->table` SET `payment_process_status`='1' WHERE id ='".$id."'";

        $result = $con->query($query);

        return $result ? 1 : 0;
    }

    public function delete_category($claimid){
        $con = connection::getConnection();

        $id = implode(',',$claimid);       

        $query = "DELETE FROM claims_category  WHERE id ='".$id."'";

        $result = $con->query($query);

        return $result ? 1 : 0;
    }

    public function updateclaimscategory($data){
        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data);     

        $query = "UPDATE claims_category SET `name`= '".$cleaneddata['name']."', `description`= '".$cleaneddata['description']."'   WHERE id ='".$cleaneddata['id']."'";

        $result = $con->query($query);

        return $result ? 1 : 0;
    }

    public function update_header_total($id){

        $con = connection::getConnection();

        $sql = "UPDATE ". $this->table. " SET Amount = ( SELECT SUM(IFNULL(Amount, 0)) FROM ".$this->detail." WHERE claim_id = '".$id."' ) WHERE id = '".$id."'";

        $result = $con->query($sql);

        return $result ? true : false ; 

    }

    public function audit_set_hr($data){

        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data);        

        $query = "UPDATE `$this->table` SET `audited`='1', `hrname`='".$cleaneddata['hr']."',`auditedby`='".$cleaneddata['userid']."' WHERE id ='".$cleaneddata['id']."'";

        $result = $con->query($query);

        return $result ? 1 : 0;
    }

    public function hr_approve_claim($data){
        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data);   

        $query = "UPDATE `$this->table` SET `hrstatus` = '1', `Auditedby` = '".$cleaneddata['Auditedby']."'  WHERE id='".$cleaneddata['id']."'";

        // return $query;
        $result = $con->query($query);

        return $result ? true : false;
    }

    public function return_claim($data){
        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data);

        $query = "UPDATE `$this->table` SET `comment` = '".$cleaneddata['description']."', `Audited` = 0, `Approved` = 0, `approvalRequest` = 0, `returned` = 1, `returnedby` ='".$cleaneddata['returnedby']."', `returneddate` ='".date('Y-m-s h:i:s', time())."'  WHERE id='".$cleaneddata['id']."'";
        
        $result = $con->query($query);

        return $result ? true : false;
    }

    public function get_category_name_by_id($id){
        $name = "";

        
        $con = connection::getConnection();
        $query = "SELECT name FROM claims_category WHERE id ='".$id."'";
        
        $result = $con->query($query);
        if($result){
            $name = $result->fetch_assoc()['name'];
        }

        return $name;
    }

    public function hod_sent_claims_to_hr($data){
        $con = connection::getConnection();
        
        $cleaneddata = $this->sanitize($data);

        $query = "UPDATE $this->table SET `hrname` = '".$cleaneddata['hrname']."', `hrrequired` = '".$cleaneddata['hrrequired']."', `hod`= '0' WHERE `id` = '".$cleaneddata['id']."'";
        
        $result = $con->query($query);

        return $result ? true : false;
        
    }

    public function hod_sent_claims_to_auditor($data){
        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data);

        $query = "UPDATE $this->table SET `Auditedby` = '".$cleaneddata['Auditedby']."',`hod` = '0' WHERE `id` = '".$cleaneddata['id']."'";

        $result = $con->query($query);

        return $result ? 1 : 0;

    }
    
}

$consultant = new Consultant;