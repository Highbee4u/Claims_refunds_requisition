<?php  
// filename: user.php
if(!file_exists("config.php")){
    require_once 'config.php';
}

class Itemmovement {

    private $table = 'item_movement';
    private $item_table = 'items';

    public function create_negative_movement($data){


        foreach($data as $val){

            $query = "INSERT INTO ".$this->table ." (`itemid`, `qty`, `flow`, `flowdate`) VALUES ('".$val['itemid']."', '".-$val['qty']."','OUT', '".date('Y-m-d h:i:s', time())."')";


            $con = connection::getConnection();

            $result = $con->query($query);

        }
                
        return $result ? true : false;
    }

    public function create_positive_movement($data){

            $query = "INSERT INTO ".$this->table ."(`itemid`, `qty`, `flow`, `flowdate`) VALUES ('".$data['itemid']."', '".$data['qty']."','IN', '".date('Y-m-d h:i:s', time())."')";

            $con = connection::getConnection();

            $result = $con->query($query);

            if($result){

                
                $query1 = "SELECT qty FROM ".$this->item_table ." WHERE itemid ='".$data['itemid']."'";

                // return $query;

                $res = $con->query($query1);
        
                if($res){
        
                    $currentqty = $res->fetch_assoc()['qty'];
        
                }

                $new_qty = $currentqty + $data['qty'];

        
                $sql = "UPDATE ".$this->item_table. " SET qty = '$new_qty' WHERE itemid = '".$data['itemid']."'";
                

                $res = $con->query($sql);
            }

            return $result ? true : false;
    }
    

    public function get_balance_qty($id){

        $query = "SELECT SUM(IFNULL(`qty`, 0)) as qtybalance FROM ".$this->table ." WHERE itemid ='".$id."'";

        $con = connection::getConnection();

        $result = $con->query($query);

       
        
        $bqty = $result->fetch_assoc()['qtybalance'];

        return $bqty;
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

    public function fetch_header(){

        $data = array();

        $con = connection::getConnection();

        $qry = "SELECT DISTINCT mt.itemid FROM $this->table mt INNER JOIN $this->item_table it ON it.itemid = mt.itemid WHERE it.itemtypeid = 1";

        // return $qry;

        $result = $con->query($qry);

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


    public function test($val){
        return "<h1>".$val."</h1>";
    }
}

$itemmovement = new Itemmovement();

?>