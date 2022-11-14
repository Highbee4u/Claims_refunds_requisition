<?php  
// filename: Consultant.php
if(!file_exists("config.php")){
    require_once 'config.php';
}

class Consultant {

    private $table = 'consultings_header';

    private $detail = 'consultings_detail';

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

    public function is_exist($data){
        
        $con = connection::getConnection();

        $sql = "SELECT * FROM ". $this->table ." WHERE Created_date='".date('Y-m-d')."' AND Enteredby='".$data['Enteredby']."'";

        // return $sql;
        $result = $con->query($sql);

        if($result){
            $count_row = $result->num_rows;
        }

        if($count_row == 1){
            $row = $result->fetch_assoc();
        }

        return $count_row == 1 ? array('status' => true, 'id' => $row['id'])  : array('status' => false, 'id' => '');
    }

    public function create($data, $table_name){
        
        $cleaned_request = $this->sanitize($data);
        
        $res = $this->is_exist($cleaned_request);

        if($res['status'] == true){

            return array("id"=>$res['id']);

        }

        $con = connection::getConnection();

        $sql = "INSERT INTO ".$table_name. "(". implode(",", array_keys($cleaned_request)) .") VALUE ('" . implode("','", array_values($cleaned_request)). "')";

        // return $sql;
        $result = $con->query($sql);
        
        $id = $con->insert_id;

        $response = array("id"=>$id);

        return $result ? $response : "";

    }

    public function create_consult_detail($data){
        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data);

        $sql = "INSERT INTO $this->detail  ( consult_id, hospital_no, Patients_name, Amount, Description ) VALUES ('".$cleaneddata['consult_id']."','".$cleaneddata['hospital_no']."','".$cleaneddata['Patients_name']."','".$cleaneddata['Amount']."','".$cleaneddata['comment']."')";


        $result = $con->query($sql);

        $id = $con->insert_id;

        return $result ? array("id"=>$id, 'status'=> true ) : array('status'=> false );

        
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

    public function fetch_detail_by_criterial($conditions = array()){
        
        $data = array();

        $con = connection::getConnection();

        $filter = '';
        foreach($conditions as $col=>$colval){
            $filter .= "`".$col."` = '".$colval."' AND";
        }

        $filters = substr($filter,0, -3);

        $sql = 'SELECT * FROM '.$this->detail.' WHERE '.$filters;

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

    public function delete_records($recordid){
        
        $con = connection::getConnection();

        $id = implode(',',$recordid);       

        $query = "DELETE FROM `$this->table`  WHERE id='".$id."'";

        if($con->query($query)){

            $qry = "DELETE FROM `$this->detail`  WHERE record_id='".$id."'";

            $result = $con->query($qry);

            return $result ? true : false;

        } else {
            return false;
        }

        
    }

    public function update_record_detail($data){
        $cleaned_request = $this->sanitize($data);

        $con = connection::getConnection();

        $sql = "UPDATE ". $this->detail ." SET hospital_no = '".$cleaned_request['hospital_no']."',Patients_name = '".$cleaned_request['Patients_name']."', Amount = '".$cleaned_request['Amount']."', Description ='".$cleaned_request['comment']."' WHERE id = '".$cleaned_request['id']."' AND consult_id = '".$cleaned_request['consult_id']."'";
        
        
        $result = $con->query($sql);

        return $result ? true : false ; 

    }

    public function delete_record_detail($data){
        $con = connection::getConnection();
        
        $id = implode(',', $data);

        $query = "DELETE FROM ".$this->detail ." WHERE id= '".$id."'";


        $result = $con->query($query);

        return $result ? true : false;

    }

    public function approval_request($recordid){
        $con = connection::getConnection();

        $id = implode(',',$recordid);

        $query = "UPDATE '$this->table` SET `approvalRequest` = '1'  WHERE id='$id'";

        // return $query;
        $result = $con->query($query);

        return $result ? true : false;
    }

    public function approval_record($recordid){
        $con = connection::getConnection();

        $id = implode(',',$recordid);

        $query = "UPDATE `$this->table`  SET `Approved` = '1', `Approveddate` = '".date('Y-m-d h:i:s', time())."', `returned` = 0, `returnedby` = '', `returneddate` = NULL WHERE id ='".$id."'";

         $result = $con->query($query);

         return $result ? true : false;
    }

    public function audit_approval_record($data){
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

    public function updatepaymentprocessstatus($recordid){

        $con = connection::getConnection();

        $id = implode(',', $recordid); 

        $query = "UPDATE `$this->table` SET `payment_process_status`='1' WHERE id ='".$id."'";

        $result = $con->query($query);

        return $result ? 1 : 0;
    }

    public function delete_category($recordid){
        $con = connection::getConnection();

        $id = implode(',',$recordid);       

        $query = "DELETE FROM records_category  WHERE id ='".$id."'";

        $result = $con->query($query);

        return $result ? 1 : 0;
    }

    public function updaterecordscategory($data){
        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data);     

        $query = "UPDATE records_category SET `name`= '".$cleaneddata['name']."', `description`= '".$cleaneddata['description']."'   WHERE id ='".$cleaneddata['id']."'";

        $result = $con->query($query);

        return $result ? 1 : 0;
    }

    public function update_header_total($id){

        $con = connection::getConnection();

        $sql = "UPDATE ". $this->table. " SET Amount = ( SELECT SUM(IFNULL(Amount, 0)) FROM ".$this->detail." WHERE consult_id = '".$id."' ) WHERE id = '".$id."'";

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

    public function hr_approve_record($data){
        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data);   

        $query = "UPDATE `$this->table` SET `hrstatus` = '1', `Auditedby` = '".$cleaneddata['Auditedby']."'  WHERE id='".$cleaneddata['id']."'";

        // return $query;
        $result = $con->query($query);

        return $result ? true : false;
    }

    public function return_record($data){
        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data);

        $query = "UPDATE `$this->table` SET `comment` = '".$cleaneddata['description']."', `Audited` = 0, `Approved` = 0, `approvalRequest` = 0, `returned` = 1, `returnedby` ='".$cleaneddata['returnedby']."', `returneddate` ='".date('Y-m-s h:i:s', time())."'  WHERE id='".$cleaneddata['id']."'";
        
        $result = $con->query($query);

        return $result ? true : false;
    }

    public function get_category_name_by_id($id){
        $name = "";

        
        $con = connection::getConnection();
        $query = "SELECT name FROM consult_category WHERE id ='".$id."'";
        
        $result = $con->query($query);
        if($result){
            $name = $result->fetch_assoc()['name'];
        }

        return $name;
    }

    public function hod_sent_records_to_hr($data){
        $con = connection::getConnection();
        
        $cleaneddata = $this->sanitize($data);

        $query = "UPDATE $this->table SET `hrname` = '".$cleaneddata['hrname']."', `hrrequired` = '".$cleaneddata['hrrequired']."', `hod`= '0' WHERE `id` = '".$cleaneddata['id']."'";
        
        $result = $con->query($query);

        return $result ? true : false;
        
    }

    public function hod_sent_records_to_auditor($data){
        $con = connection::getConnection();

        $cleaneddata = $this->sanitize($data);

        $query = "UPDATE $this->table SET `Auditedby` = '".$cleaneddata['Auditedby']."',`hod` = '0' WHERE `id` = '".$cleaneddata['id']."'";

        $result = $con->query($query);

        return $result ? 1 : 0;

    }

    public function get_total_service_per_day(){
        $con = connection::getConnection();

        $sql =  "SELECT SUM(IFNULL(Amount, 0)) as total FROM ".$this->detail." WHERE consult_id =(SELECT id FROM $this->table WHERE Created_date = CURRENT_DATE() GROUP BY Created_date)";

        $result = $con->query($sql);

        $total = $result->fetch_assoc();


        return $total; 
    }

    public function total_patients(){
        $con = connection::getConnection();

        $sql =  "SELECT count(*) FROM ".$this->detail." WHERE consult_id =(SELECT id FROM $this->table WHERE Created_date = date('Y-m-d') GROUP BY Created_date)";

        $result = $con->query($sql);

        $totalpatient = $result->fetch_assoc();


        return $totalpatient; 
    }
    
}

$consultant = new Consultant;