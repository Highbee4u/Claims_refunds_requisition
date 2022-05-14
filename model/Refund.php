<?php  
// filename: Claim.php
if(!file_exists("config.php")){
    require_once 'config.php';
}

class Refund {

    private $table = 'refunds_header';

    private $detail = 'refunds_detail';

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

        $result = $con->query($sql);
        
        $id = $con->insert_id;

        $response = array("id"=>$id);

        return $result ? $response : "";

    }

    public function update_header_total($id){

        $con = connection::getConnection();

        $sql = "UPDATE ". $this->table. " SET amount = ( SELECT SUM(IFNULL(amount, 0)) FROM ".$this->detail." WHERE refund_id = '".$id."' ) WHERE id = '".$id."'";

        $result = $con->query($sql);

        return $result ? true : false ; 

    }

    public function fetch_all(){
        
        $data = array();

        $con = connection::getConnection();

        $sql = "SELECT * FROM $this->table ORDER BY id DESC";

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

        $sql = 'SELECT * FROM '.$table_name.' WHERE '. $filters;

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

    public function delete_refunds($refundid){
        
        $con = connection::getConnection();

        $id = implode(',',$refundid);       

        $query = "DELETE FROM `$this->table`  WHERE id='".$id."'";

        if($con->query($query)){

            $qry = "DELETE FROM `$this->detail`  WHERE refund_id ='".$id."'";

            $result = $con->query($qry);

            return $result ? true : false;

        } else {
            return false;
        }

        
    }

    public function update_refund_detail($data){
        $cleaned_request = $this->sanitize($data);

        $con = connection::getConnection();

        $sql = "UPDATE $this->detail SET 'Amount' = '".$cleaned_request['Amount']."', 'Description' = '".$cleaned_request['Description']."' WHERE id = '".$cleaned_request['id']."' AND refundid = '".$cleaned_request['refundid']."'";

        $result = $con->query($sql);

        return $result ? true : false ; 

    }

    public function delete_refund_detail($data){
        $con = connection::getConnection();
        
        $id = implode(',', $data);

        $query = "DELETE FROM ".$this->detail ." WHERE id= '".$id."'";

        $result = $con->query($query);

        return $result ? true : false;

    }

    public function approval_request($claimid){
        $con = connection::getConnection();

        $id = implode(',',$claimid);

        $query = "UPDATE `$this->table` SET `approvalRequest` = '1', `returned` = '0'  WHERE id ='$id'";

        // return $query;
        $result = $con->query($query);

        return $result ? true : false;
    }

    public function audit_approval_refund($data){
        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data);        

        $query = "UPDATE `$this->table` SET `approval`='1', `audited`='1', `approvedby`='".$cleaneddata['userid']."',`auditedby`='".$cleaneddata['userid']."', `approveddate` = '".date('Y-m-d')."' WHERE id ='".$cleaneddata['id']."'";

        // return $query;
        $result = $con->query($query);

        return $result ? true : false;
    }
    public function hod_set_auditor($data){
        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data);        

        $query = "UPDATE `$this->table` SET `auditedby`='".$cleaneddata['auditedby']."', `is_hod`= '0' WHERE id ='".$cleaneddata['id']."'";

        $result = $con->query($query);

        return $result ? true : false;
    }
    public function bcc_set_auditor($data){

        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data);        

        $query = "UPDATE `$this->table` SET `hod`='".$cleaneddata['auditedby']."', `is_bcc`= '0', `is_hod`= '1', `hodrequired`= '1'  WHERE id ='".$cleaneddata['id']."'";

        $result = $con->query($query);

        return $result ? true : false;
    }

    public function audit_set_approval($data){

        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data);        

        $query = "UPDATE `$this->table` SET `audited`='1', `approvedby`='".$cleaneddata['approvedby']."',`auditedby`='".$cleaneddata['userid']."' WHERE id ='".$cleaneddata['id']."'";

        $result = $con->query($query);

        return $result ? 1 : 0;
    }

    public function updatepaymentstatus($refundid){
        $con = connection::getConnection();

        $id = implode(',',$refundid);       

        $query = "UPDATE `$this->table` SET `accountant_status`='1', `payment_date`='".date('Y-m-d h:i:s', time())."' WHERE id ='".$id."'";

        $result = $con->query($query);

        return $result ? 1 : 0;
    }

    public function approve_refund($refundid){
        $con = connection::getConnection();

        $id = implode(',', $refundid);

        $query = "UPDATE `$this->table` SET `approval` = 1, `approveddate` = '".date('Y-m-d')."'  WHERE id='$id'";
        
        $result = $con->query($query);

        return $result ? true : false;
    }

    public function return_refund($data){
        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data);

        $query = "UPDATE `$this->table` SET `comment` = '".$cleaneddata['description']."', `audited` = 0, `Approval` = 0, `approvalRequest` = 1, `returned` = 1 WHERE id='".$cleaneddata['id']."'";

        $result = $con->query($query);

        return $result ? true : false;
    }
}

$refund = new Refund;