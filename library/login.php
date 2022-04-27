<?php 
session_start();
require '../model/User.php';

//create the instance of the DevClass
$user_obj = new User();


  $login = $user_obj->login($_POST);

  $detailToArray = json_decode($login, true);


  if(is_array($detailToArray) && $detailToArray['status'] == 1){

      $detail = $detailToArray['data'];

        $_SESSION['user'] = $detail;

        echo json_encode(array('status' => 1, 'data'=>$detail, 'message'=>'Login Successful'), true);

  } else if(is_array($detailToArray) && $detailToArray['status'] == -1) {

      echo json_encode(array('status'=> -1, 'data'=>[], 'message'=>'username and password not found'), true);

  }
?>