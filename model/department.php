<?php  
// filename: department.php
if(!file_exists("config.php")){
    require_once 'config.php';
}

class Department {

    private $table = 'departments';

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

    

    public function create($data){
        $cleaned_request = $this->sanitize($data);

        $con = connection::getConnection();
        

        $sql = "INSERT INTO ".$this->table. "( name ) VALUE ( '".$cleaned_request['name']."')";

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

  
    public function delete_department($dataid){
        
        $con = connection::getConnection();
        
        $id = implode(',', $dataid);

        $query = "DELETE FROM ".$this->table ." WHERE id= '".$id."'";


        $result = $con->query($query);

        return $result ? true : false;
    }

    public function updatedepartment($data){
        $con = connection::getConnection();
        
        $query = "UPDATE ".$this->table ." SET name = '".$data['name']."' WHERE id= '".$data['id']."'";


        $result = $con->query($query);

        return $result ? true : false;
    }

    public function get_depart_name_by_id($departmentid){
        $name = "";

        
        $con = connection::getConnection();
        $query = "SELECT name FROM ".$this->table ." WHERE id ='".$departmentid."'";

        $result = $con->query($query);
        if($result){
            $name = $result->fetch_assoc()['name'];
        }

        return $name;
    }

    
}

$department = new Department();