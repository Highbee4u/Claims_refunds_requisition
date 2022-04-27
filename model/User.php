<?php  
// filename: user.php
if(!file_exists("config.php")){
    require_once 'config.php';
}

if(!class_exists('User')){
    class User {

        private $table = 'users';
    
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
    
        /* for login process */
        public function login($postedval){
            
            $con = connection::getConnection();
            
            $user_data = array();
            $count_row = 0;
    
            $cleaned_request = $this->sanitize($postedval);
    
            
    
            $password = $this->myencrypt($cleaned_request['password']);
            $emailusername = $cleaned_request['email'];
    
            /* 
                user_roleid:
                    -1 => supper user
                    0 => normal staff
                    1 => auditor
                    2 => approval
                    3 => procurement
                    4 => accountant
                    5 => hr
    
            */
    
            $sql="SELECT id, name, email, user_roleid, login_attempt, departmentid FROM users WHERE email='$emailusername' AND password='$password'";
    
    
            //checking if the username is available in the table
            $result = $con->query($sql);
    
            if($result){
               while($row = $result->fetch_assoc()){
                    $user_data[] = $row;
               }
                $count_row = $result->num_rows;
            }
    
    
            if (count($user_data) < 1 || empty($user_data)) {
                return  json_encode(array('status'=> -1, 'data' => [], 'message' => 'User email not found'));
            } else {
                return  json_encode(array('status'=> 1, 'data' => $user_data, 'message' => 'User detail'));
            }
        }
    
        public function register($data){
            $cleaned_request = $this->sanitize($data);
    
            $con = connection::getConnection();
            
            $password = $this->myencrypt($cleaned_request['password']);
    
            $sql = "INSERT INTO ".$this->table. "( name, email, password, user_roleid,  departmentid) VALUE ( '".$cleaned_request['name']."', '".$cleaned_request['email']."', '".$password."', '".$cleaned_request['user_roleid']."', '".$cleaned_request['department']."')";
    
            $result = $con->query($sql);
    
            return $result ? true : false;
    
    
        }
    
        public function fetch_all(){
            
            $data = array();
    
            $con = connection::getConnection();
    
            $sql = "SELECT * FROM $this->table";
    
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
    
            $sql = 'SELECT * FROM '.$this->table.' WHERE '.$filters;
    
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
    
       public function canAudit($userid){
    
            $con = connection::getConnection();
    
            $sql = "SELECT * FROM $this->table WHERE id = '".$userid."' AND user_roleid ='1'";
    
            
    
            $result = $con->query($sql);
    
            $count_row = 0;
    
            if($result){
    
                $count_row = $result->num_rows;
    
            }
    
            if($count_row == 0){
                return false;
            } else{
                return true;
            }
    
       }
    
        public function canApprove($userid){
    
            $con = connection::getConnection();
    
            $sql = "SELECT * FROM $this->table WHERE  id = '".$userid."' AND user_roleid = '2'";
        
            $result = $con->query($sql);
            $count_row = 0;
        
            if($result){
                $count_row = $result->num_rows;
            }
        
            return $count_row  == 1 ? true : false;
        }
    
        public function is_admin($userid){
            $con = connection::getConnection();
    
            $sql = "SELECT * FROM $this->table WHERE  id = '".$userid."' AND user_roleid = '-1'";
        
            $result = $con->query($sql);
            $count_row = 0;
        
            if($result){
                $count_row = $result->num_rows;
            }
        
            return $count_row  == 1 ? true : false;
        }

        public function is_accountant($userid){

            $con = connection::getConnection();
    
            $sql = "SELECT * FROM $this->table WHERE  id = '".$userid."' AND user_roleid = '4'";
        
            $result = $con->query($sql);
            
            $count_row = 0;
        
            if($result){
                $count_row = $result->num_rows;
            }
        
            return $count_row  == 1 ? true : false;
        }

        public function is_hr($userid){
            $con = connection::getConnection();
    
            $sql = "SELECT * FROM $this->table WHERE  id = '".$userid."' AND user_roleid = '5'";
        
            $result = $con->query($sql);
            $count_row = 0;
        
            if($result){
                $count_row = $result->num_rows;
            }
        
            return $count_row  == 1 ? true : false;
        }

        public function is_bcc($userid){
            $con = connection::getConnection();
    
            $sql = "SELECT * FROM $this->table WHERE  id = '".$userid."' AND user_roleid = '7'";
        
            $result = $con->query($sql);
            $count_row = 0;
        
            if($result){
                $count_row = $result->num_rows;
            }
        
            return $count_row  == 1 ? true : false;
        }
        public function is_hmo($userid){
            $con = connection::getConnection();
    
            $sql = "SELECT * FROM $this->table WHERE  id = '".$userid."' AND user_roleid = '6'";
        
            $result = $con->query($sql);
            $count_row = 0;
        
            if($result){
                $count_row = $result->num_rows;
            }
        
            return $count_row  == 1 ? true : false;
        }

        public function is_hod($userid){
            $con = connection::getConnection();
    
            $sql = "SELECT * FROM $this->table WHERE  id = '".$userid."' AND user_roleid = '8'";
        
            $result = $con->query($sql);
            $count_row = 0;
        
            if($result){
                $count_row = $result->num_rows;
            }
        
            return $count_row  == 1 ? true : false;
        }
    
        public function get_user_name_by_id($userid){
            $con = connection::getConnection();
    
            $sql = "SELECT name FROM $this->table WHERE  id = '".$userid."'";
        
            $result = $con->query($sql);
            $name = $result->fetch_assoc()['name'];
        
            return !empty($name) ? $name : "";
        }
    
        public function get_user_name_by_email($email){
            $con = connection::getConnection();
    
            $sql = "SELECT name FROM $this->table WHERE  email = '".$email."'";
        
            $result = $con->query($sql);
            $name = $result->fetch_assoc()['name'];
        
            return !empty($name) ? $name : "";
        }
    
        public function update_password($data){
            $con = connection::getConnection();
        
            $cleaned_request = $this->sanitize($data);
    
            $password = $this->myencrypt($cleaned_request['password']);
    
            $query = "UPDATE $this->table SET password = '".$password."', login_attempt = 1 WHERE id = '".$cleaned_request['userid']."' AND email = '".$cleaned_request['email']."'";
    
            $result = $con->query($query);
    
            return $result ? true : false;
        }
        public function reset_password($data){
            $con = connection::getConnection();
    
            $cleaned_request = $this->sanitize($data);
    
            $password = $this->myencrypt($cleaned_request['password']);
    
            $query = "UPDATE $this->table SET password = '".$password."', login_attempt = 0 WHERE id = '".$cleaned_request['id']."' AND email = '".$cleaned_request['email']."'";
    
            $result = $con->query($query);
    
            return $result ? true : false;
        }
    
        public function get_user_count(){
            $con = connection::getConnection();
            
            $query = "SELECT count(*) as users FROM $this->table";
    
            $result = $con->query($query);
    
            if($result){
                $count = $result->fetch_assoc()['users'];
            }
    
            return $count;
        }
    
        public function delete_user($dataid){
            
            $con = connection::getConnection();
            
            $id = implode(',', $dataid);
    
            $query = "DELETE FROM ".$this->table ." WHERE id= '".$id."'";
    
    
            $result = $con->query($query);
    
            return $result ? true : false;
        }
    
        public function updateuserdetail($data){
            $con = connection::getConnection();
            
            $query = "UPDATE ".$this->table ." SET name = '".$data['name']."', email = '".$data['email']."', user_roleid = '".$data['user_roleid']."', departmentid = '".$data['departmentid']."' WHERE id= '".$data['id']."'";
    
    
            $result = $con->query($query);
    
            return $result ? true : false;
        }
    
        // implements later, to check if user is been assigned to approve or delete and if true, prevent delete
    
        // public function assigned($column, $userid){
        //     $con = connection::getConnection();
            
        //     $query = "SELECT count(*) as assign FROM requisition_header WHERE $column = '$userid'";
    
        //     $result = $con->query($query);
    
        //     if($result){
        //         $count = $result->fetch_assoc()['assign'];
        //     }
    
        //     return $count > 0 ? true : false;
        // }
        
    }
    
    $user = new User();
}
