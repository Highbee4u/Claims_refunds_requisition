<?php  
// filename: user.php
if(!file_exists("config.php")){
    require_once 'config.php';
}

if(!class_exists('Upload')){
    class Upload {

        private $table = 'uploads';
    
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

        public function upload_file($data, $postedval){
          
          if(isset($postedval)){
              $errors = array();
              $file_name = $postedval['file']['name'];
              $file_size = $postedval['file']['size'];
              $file_tmp = $postedval['file']['tmp_name'];
              $file_type = $postedval['file']['type'];
              $file_ext = explode('/',$file_type);
              $retextension = strtolower(end($file_ext));
              $max_size = 5 * 1024 * 1024;
              

              $allowedExtensions = array('jpeg', 'jpg','png', 'pdf', 'doc', 'docx');

              if(!in_array($retextension, $allowedExtensions)){
                  $errors[] = "Extension not allowed, please choose a JPEG or PNG or PDF or DOC or DOCX File";
              }

              if($file_size > $max_size){
                  $errors[] = "Image size is too large";
              }

              $actiontype = $data['actiontype'];
            

              $date = date_create();

              switch($actiontype){
                case '1': // requisition
                    $target = REQ_UPLOAD.$file_name.date_timestamp_get($date);
                    $upload_subfolder = 'requisition/';
                break;
                case '2': // refunds
                    $target = REFUNDS_UPLOAD.$file_name.date_timestamp_get($date);
                    $upload_subfolder = 'refund/';
                break;
                case '3': // claims
                    $target = CLAIMS_UPLOAD.$file_name.date_timestamp_get($date);
                    $upload_subfolder = 'claim/';
                break;
                case '4': // consultant
                    $target = CONSULTANTS_UPLOAD.$file_name.date_timestamp_get($date);
                    $upload_subfolder = 'consultant/';
                break;
              }
              
              $link = 'Uploads/'.$upload_subfolder.$file_name.date_timestamp_get($date);

              if(empty($errors) === true){

                  if($this->save_upload($data, $link)){ // Saving image detail to database
                      return move_uploaded_file($file_tmp, $target) ? array('status'=> 1, 'link' => $link, 'title'=> $data['title']) : array('status'=> 0, 'errors' => $errors);
                  }else{
                      return array('status'=> 0, 'error'=> 'Unable to save image, try later');
                  }
                  
              }else{
                  return array('status' => 0, 'error' => $errors);
              }
          }else{
              return array('status' => 0, 'error' => $postedval);
          }
        }

        public function save_upload($data, $url){
            $cleaned_request = $this->sanitize($data);
        
            $con = connection::getConnection();
    
            $sql = "INSERT INTO $this->table (`actionid`, `actiontype`, `title`, `url`, `createdby`) VALUE ('".$cleaned_request['actionid']."', '".$cleaned_request['actiontype']."','".$cleaned_request['title']."','".$url."','".$cleaned_request['createdby']."')";
    
            // return $sql;
            $result = $con->query($sql);
    
            return $result ? true : false;
        }

        public function getuploads($data){
            $cleaned_request = $this->sanitize($data);
        
            $con = connection::getConnection();
    
            $sql = "SELECT * FROM $this->table WHERE actionid = '".$cleaned_request['actionid']."' AND actiontype = '".$cleaned_request['actiontype']."'";
    
            // return $sql;
            $result = $con->query($sql);

            if($result){

                while($row = $result->fetch_assoc()){
    
                    $data[] = $row;
    
                }
            }
    
            return $data;
    
        }

        public function deleteuploads($data){

            $cleaned_request = $this->sanitize($data);
        
            $con = connection::getConnection();

            $delitem = $_SERVER["DOCUMENT_ROOT"].ROOT."/".$data['url'];

            // unlink($delitem);

            $sql = "DELETE FROM $this->table WHERE id = '".$cleaned_request['id']."' AND actiontype = '".$cleaned_request['actiontype']."'";
            // return $sql;
            $result = $con->query($sql);
    
            return $result ? true : false;
            
        }
      }
            
    $upload = new Upload();
}
