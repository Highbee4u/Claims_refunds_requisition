<?php  
// filename: user.php
if(!file_exists("config.php")){
    require_once 'config.php';
}

class Uom {

    private $table = 'uom';

    public function create($data){
        $con = connection::getConnection();

        $name = implode("','", $data);
        $is_exists = $this->fetch_by_criterial(array('uomname'=> $name)); 


        $sql = "INSERT INTO $this->table (uomname) VALUES ('".implode("','", $data)."')";

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
        
        $con = connection::getConnection();

        $filter = '';
        foreach($conditions as $col=>$colval){
            $filter .= "`".$col."` = '".$colval."' AND";
        }

        $filters = substr($filter,0, -3);

        $sql = 'SELECT * FROM '.$this->table.' WHERE '.$filters;

        $return_data = array();
        $count_row = 0;

        $result = $con->query($sql);
        if($result){
            $count_row = $result->num_rows;
        }

        if($count_row > 0){
            while($row = $result->fetch_assoc()){
                $return_data[] = $row;
            }
        }
        return $return_data;
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

    public function get_uom_name($uomid){
        $con = connection::getConnection();

        $qry = "SELECT * FROM ".$this->table. " WHERE id ='".$uomid."'";

        $result = $con->query($qry);

        $row = $result->fetch_assoc()['uomname'];

        return !empty($row) ? $row : "";


    }

    public function test($val){
        return "<h1>".$val."</h1>";
    }
}

$uom = new Uom();

?>