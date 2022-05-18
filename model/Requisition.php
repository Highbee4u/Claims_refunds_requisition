<?php  
// filename: Requisition.php
if(!file_exists("config.php")){
    require_once 'config.php';
}

class Requisition {

    public $table = 'requisition_header';
    public $detailtable = 'requisition_detail';

    public function create_requisition_header($data){
        $con = connection::getConnection();

       

        $cleaneddata = $this->sanitize($data);

        $rectype = $cleaneddata['requisitiontype'];

        $sql = "INSERT INTO $this->table  ( reqby, reqdate, coment, auditedby, description, departmentid, requisitiontype, awaiting_price ) VALUES ('".$cleaneddata['reqby']."','".$cleaneddata['reqdate']."','','".$cleaneddata['auditedby']."', '".$cleaneddata['description']."', '".$cleaneddata['department']."', '".$cleaneddata['requisitiontype']."','".$cleaneddata['awaiting_price']."')";

        // return $sql;

        $result = $con->query($sql);

        
        $id = $con->insert_id;

        $response = array("id"=>$id, "rectype"=> $rectype);

        return $result ? $response : "";

        
    }
    public function create_requisition_detail($data){
        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data);

        $sql = "INSERT INTO $this->detailtable  ( reqnumber, itemid,  qty, uom) VALUES ('".$cleaneddata['requisitionid']."','".$cleaneddata['itemid']."','".$cleaneddata['qty']."','".$cleaneddata['uom']."')";


        $result = $con->query($sql);

        return $result ? true : false;

        
    }

    public function fetch_all(){
        
        $data = array();

        $con = connection::getConnection();

        $sql = "SELECT * FROM $this->table ORDER BY reqnumber DESC";

        $result = $con->query($sql);

        if($result){

            while($row = $result->fetch_assoc()){

                $data[] = $row;

            }
        }

        return $data;
    }

    public function fetch_by_criterial($conditions = array()){
        
        $data = array();

        $con = connection::getConnection();

        $filter = '';
        foreach($conditions as $col=>$colval){
            $filter .= "`".$col."` = '".$colval."' AND";
        }

        $filters = substr($filter,0, -3);

        $sql = 'SELECT * FROM '.$this->table.' WHERE '.$filters .' ORDER BY reqnumber DESC';

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

    public function fetch_detail_by_criterial($conditions = array()){
        
        $data = array();

        $con = connection::getConnection();

        $filter = '';
        foreach($conditions as $col=>$colval){
            $filter .= "`".$col."` = '".$colval."' AND";
        }

        $filters = substr($filter,0, -3);

        $sql = 'SELECT * FROM requisition_detail WHERE '.$filters;

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

    public function approve_requisition($data){
        $con = connection::getConnection();

        $query = "UPDATE `$this->table` SET `approved` = 1, `coment` = '', `returnedby` = '', `return` = 0, `returneddate` = NULL,   `approveddate`= '".date('Y-m-d h:i:s', time())."'  WHERE reqnumber='".$data['id']."'";
        
        $result = $con->query($query);

        return $result ? true : false;
    }

    public function audit_requisition($reqid){
        
        $con = connection::getConnection();

        $id = implode(',', $reqid);

        $query = "UPDATE `$this->table` SET `audited` = 1, `auditeddate`= '".date('Y-m-d h:i:s', time())."' WHERE reqnumber='$id'";

        $result = $con->query($query);

        return $result ? 1 : 0;
    }

    public function add_price($data){
        
        $con = connection::getConnection();

        $query = "UPDATE ".$this->detailtable." SET qty = '".$data['qty']."', price = '".$data['price']."'  WHERE reqnumber='".$data['requisitionid']."' AND reqdetailid = '".$data['detailid']."'";

        $result = $con->query($query);

        return $result ? 1 : 0;
    }
    
    public function get_release_from_procurement($data){
        
        $id = implode(',', $data);

        $con = connection::getConnection();

        $query = "UPDATE ".$this->table." SET awaiting_price = 0, returned = 0, procapproveddate = '".date('Y-m-d h:i:s', time())."'  WHERE reqnumber='".$id."'";

        $result = $con->query($query);

        return $result ? 1 : 0;
    }


    public function delete_detail($detailid){
        $con = connection::getConnection();

        $id = implode(',', $detailid);

        $query = "DELETE FROM $this->detailtable WHERE reqdetailid='$id'";

        $result = $con->query($query);

        return $result ? 1 : 0;
    }

    public function get_req_detail_by_id($detailid){
        $con = connection::getConnection();

        $record = array();

        $id = implode(',', $detailid);
 
        $query = "SELECT * FROM $this->detailtable WHERE reqdetailid='$id'";


        $result = $con->query($query);
        
        if($result){
            $record = $result->fetch_assoc();
        }

        return $record;
    }

    public function audit_approve($data){

        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data);        

        $query = "UPDATE `$this->table` SET `approved`='1', `audited`='1', `approvedby`='".$cleaneddata['userid']."',`auditedby`='".$cleaneddata['userid']."', `auditeddate` = '".date('Y-m-d h:i:s', time())."', `approveddate` = '".date('Y-m-d h:i:s', time())."', `coment` = ''  WHERE reqnumber ='".$cleaneddata['id']."'";

        $result = $con->query($query);

        $response = array("reqnumber"=>$cleaneddata['id'], "status"=>$result);

        return $response;
    }

    public function audit_set_approval($data){

        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data);        

        $query = "UPDATE `$this->table` SET `audited`='1', `approvedby`='".$cleaneddata['approvedby']."',`auditedby`='".$cleaneddata['userid']."', `auditeddate` = '".date('Y-m-d h:i:s', time())."', `coment` = '' WHERE reqnumber ='".$cleaneddata['id']."'";

        $result = $con->query($query);

        return $result ? 1 : 0;
    }

    public function update_req_detail($data){
        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data);        

        $query = "UPDATE `$this->detailtable` SET `itemid`='".$cleaneddata['itemid']."',`qty`='".$cleaneddata['qty']."',`uom`='".$cleaneddata['uom']."' WHERE reqdetailid ='".$cleaneddata['detailid']."'";

        $result = $con->query($query);

        return $result ? 1 : 0;
    }

    public function get_header_sum($reqid){
        $con = connection::getConnection();

        $total = 0;

        
        $query = "SELECT SUM(IFNULL(qty, 0) * IFNULL(price, 0)) as total FROM ".$this->detailtable." WHERE reqnumber = '".$reqid."' GROUP BY reqnumber";


        $result = $con->query($query);

        if($result){
            $total = $result->fetch_assoc()['total'];
        }
        return $total;
    }

    public function approval_request($reqid){
        $con = connection::getConnection();

        $id = implode(',',$reqid);

        $query = "UPDATE `$this->table` SET `approvalRequest` = '1', `awaiting_price` = '1', `return` = '0', `returnedby` = ''  WHERE reqnumber='$id'";

        // return $query;
        $result = $con->query($query);

        return $result ? true : false;
    }

    public function return_requisition($data){

        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data);

        $query = "UPDATE `$this->table` SET `coment` = '".$cleaneddata['description']."', `audited` = 0, `approved` = 0, `awaiting_price` = 1, `approvalRequest`= 1, `returned` = 1, `returnedby` = '".$cleaneddata['userid']."', returneddate = '".date('Y-m-d h:i:s', time())."' WHERE `reqnumber`= '".$cleaneddata['requisitionid']."'";
    
        $result = $con->query($query);

        return $result ? 1 : 0;
    }

    public function delete_requisition($data){
        
        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data);

        $query = "DELETE FROM `$this->table`  WHERE reqnumber='".$cleaneddata['id']."'";

        if($con->query($query)){

            $qry = "DELETE FROM `$this->detailtable`  WHERE reqnumber='".$cleaneddata['id']."'";

            $result = $con->query($qry);

            return $result ? true : false;

        } else {
            return false;
        }

        
    }

    public function updatepaymentstatus($data){

        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data);      

        $query = "UPDATE `$this->table` SET `payment_status`='1', `payment_date`='".date('Y-m-d h:i:s', time())."', `payment_process_status` = '1', `paidby` = '".$cleaneddata['userid']."' WHERE reqnumber ='".$cleaneddata['id']."'";

        $result = $con->query($query);

        return $result ? 1 : 0;
    }

    public function updatepaymentprocessstatus($reqid){

        $con = connection::getConnection();

        $id = implode(',', $reqid); 

        $query = "UPDATE `$this->table` SET `payment_process_status`='1' WHERE reqnumber ='".$id."'";

        $result = $con->query($query);

        return $result ? 1 : 0;
    }


    public function test($val){
        return "<h1>".$val."</h1>";
    }

}

$req = new Requisition();



?>