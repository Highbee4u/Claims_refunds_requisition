<?php  
// filename: user.php
if(!file_exists("config.php")){
    require_once 'config.php';
}

class Item {

    private $table = 'items';

    public function create_item($data){
        
        $query = "INSERT INTO ".$this->table ."(`itemname`, `uom`, `createdby`, `itemtypeid`, `limit` ) VALUES ('".$data['itemname']."','".$data['uom']."','".$_SESSION['user'][0]['id']."', '".$data['itemtype']."', '".$data['limit']."')";

        $con = connection::getConnection();

        $result = $con->query($query);
        
        return $result ? true : false;
    }

    public function update_item_details($data){

        $con = connection::getConnection();

        $cleaned_request = $this->sanitize($data);

        $query = "UPDATE ".$this->table. " SET itemname = '".$cleaned_request['itemname']."', uom = '".$cleaned_request['uom']."' , itemtypeid = '".$cleaned_request['itemtype']."' where itemid = '".$cleaned_request['itemid']."' ";
    
        $result = $con->query($query);
        
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

    public function get_item_name_by_id($id){
        $name = "";

        
        $con = connection::getConnection();
        $query = "SELECT itemname FROM ".$this->table ." WHERE itemid ='".$id."'";
        $result = $con->query($query);
        if($result){
            $name = $result->fetch_assoc()['itemname'];
        }

        return $name;
    }

    public function get_item_uom_by_id($id){
        $name = "";

        
        $con = connection::getConnection();
        $query = "SELECT uom FROM ".$this->table ." WHERE itemid ='".$id."'";

        $result = $con->query($query);
        if($result){
            $name = $result->fetch_assoc()['iteuommname'];
        }

        return $name;
    }

    public function reduce_inventory($data){
        
        $currentqty = 0;

        $new_qty = 0;

        $con = connection::getConnection();

        foreach($data as $val){

            $query = "SELECT qty FROM ".$this->table ." WHERE itemid ='".$val['itemid']."'";

            // return $query;

            $result = $con->query($query);
    
            if($result){
    
                $currentqty = $result->fetch_assoc()['qty'];
    
            }

            $new_qty = $currentqty - $val['qty'];

    
            $sql = "UPDATE ".$this->table. " SET qty = '$new_qty' WHERE itemid = '".$val['itemid']."'";
            
            $res = $con->query($sql);
        }
        
        
        return $res ? true : false;
    }

    public function add_inventory($itemid, $qty){
        $currentqty = 0;
        $new_qty = 0;

        $con = connection::getConnection();

        $query = "SELECT qty FROM ".$this->$table ."WHERE itemid ='".$itemid."'";

        $result = $con->query($sql);

        if($result){

            $currentqty = $result->fetch_assoc()['qty'];

        }

        $new_qty =  empty($currentqty) ? 0 : $currentqty + ( empty($qty) ? 0 : $qty );

        $sql = "UPDATE ".$this->table. " SET qty = '$new_qty' WHERE itemid = '".$itemid."'";
        
        $res = $con->query($sql);
        
        return $res ? true : false;
    }

    public function get_item(){
        $data = array();
        $con = connection::getConnection();
        $query = "SELECT items.itemid, items.itemname as name, items.uom, items.qty, items.createdby,uom.uomname, items.itemtypeid  FROM items LEFT JOIN uom ON uom.id = items.uom ";

        $result = $con->query($query);
        if($result){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
        }

        return $data;
    }

    public function get_uom_by_item($data){
         $name = "";
         $id = implode(',',$data);
        $con = connection::getConnection();
        $query = "SELECT uom.uomname as name FROM items LEFT JOIN uom ON uom.id = items.uom WHERE items.itemid = '$id'";

        $result = $con->query($query);
        if($result){
            $name = $result->fetch_assoc()['name'];
                
        }

        return $name;
    }

    public function get_low_stock(){
        $data = array();
        $con = connection::getConnection();
        $query = "SELECT * FROM   $this->table WHERE $this->table.itemtypeid = '1' AND ifnull($this->table.qty, 0) <= ifnull($this->table.limit, 0)";

        $result = $con->query($query);
        if($result){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
        }

        return $data;
    }

    function get_stock_item_to_update($id){

        $detail = [];

        $con = connection::getConnection();

        $query = "SELECT itemid, qty FROM requisition_detail WHERE reqnumber ='".$id."'";

        $result = $con->query($query);

        if($result){
            while($row = $result->fetch_assoc()){
                $detail[] = $row;
            }

        }

        return $detail;

    }

    public function test($val){
        return "<h1>".$val."</h1>";
    }

    
}

$item = new Item();

?>