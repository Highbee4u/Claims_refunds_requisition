<?php

session_start();

require '../model/Uom.php';
require '../model/User.php';
require '../model/Requisition.php';
require '../model/Item.php';
require '../model/Department.php';
require '../model/Itemmovement.php';
require '../model/Claim.php';
require '../model/Refund.php';

if (isset($_REQUEST['action'])) {
        
    
    $action = ($_REQUEST['action'] != "" ? $_REQUEST['action'] : "");

    $data = isset($_POST) ? $_POST : "";
    
    switch($action){
        case 'createuom':
            $res = $uom->create($data);
            echo json_encode($res);
        break;
        case 'getauditor':
            $res = $user->fetch_by_criterial(array('user_roleid'=> 1));
            echo json_encode($res);
        break;
        case 'gethr':
            $res = $user->fetch_by_criterial(array('user_roleid'=> 5));
            echo json_encode($res);
        break;
        case 'getapproval':
            $res = $user->fetch_by_criterial(array('user_roleid'=> 2));
            echo json_encode($res);
        break;
        case 'gethr':
            $res = $user->fetch_by_criterial(array('user_roleid'=> 5));
            echo json_encode($res);
        break;
        case 'createrequisitionheader':
            $res = $req->create_requisition_header($data);
            echo json_encode($res);
        break;
        case 'approve':
            $movement = 0;
            $res = $req->approve_requisition($data);
            if($res == 1 && $data['requisitiontype'] == 1){
                $detail = $item->get_stock_item_to_update($data['id']);
                if(!empty($detail)){
                    $response = $item->reduce_inventory($detail);
                    $movement = $itemmovement->create_negative_movement($detail);
                }
            }
            if($data['requisitiontype'] == 1){
                echo json_encode($movement);
            }else{
                echo json_encode($res);
            }
            
        break;
        case 'audit_approve':
            $res = $req->audit_approve($data);
            if($res['status'] == 1 && $data['requisitiontype'] == 1){
                $detail = $item->get_stock_item_to_update($res['reqnumber']);
                if(!empty($detail)){
                    $response = $item->reduce_inventory($detail);
                    $movement = $itemmovement->create_negative_movement($detail);
                }
            }

            if($data['requisitiontype'] == 1){
                echo json_encode($movement);
            }else{
                echo json_encode($res);
            }
            
            
            
        break;
        case 'audit':
            $res = $req->audit_requisition($data);
            echo json_encode($res);
        break;
        case 'getuom':
            $res = $uom->fetch_all();
            echo json_encode($res);
        break;
        case 'createitem':
            $res = $item->create_item($data);
            echo json_encode($res);
        break;
        case 'getitem':
            $res = $item->fetch_by_criterial($data);
            echo json_encode($res);
        break;
        case 'updateitemdetail':
            $res = $item->update_item_details($data);
            echo json_encode($res);
        break;
        case 'createuser':
            $res = $user->register($data);
            echo json_encode($res);
        break;
        case 'logout':
            session_destroy();
            session_unset($_SESSION['user']);
            header("location: ../index.php");
        break;
        case 'getAllItem':
            $res = $item->get_item();
            echo json_encode($res);
            break;
        case 'getUomName':
         
            $res = $item->get_uom_by_item($data);
            echo json_encode($res);
            break;
        case 'add_requisition_detail':
            $res = $req->create_requisition_detail($data);
            echo json_encode($res);
            break;
        case 'deletereqdetail':
            $res = $req->delete_detail($data);
            echo json_encode($res);
            break;
        case 'get_req_detail_by_id':
            $res = $req->get_req_detail_by_id($data);
            echo json_encode($res);
            break;
        case 'update_req_detail':
            
            $res = $req->update_req_detail($data);
            echo json_encode($res);
            break;
        case 'get_sum':

            $res = $req->get_header_sum($data);
            echo json_encode($res);
            break;
        case 'approvalRequest':
            $res = $req->approval_request($data);
            echo json_encode($res);
            break;
        case 'changepassword':
            $res = $user->update_password($data);
            session_destroy();
            session_unset();
            echo json_encode($res);
            break;
        case 'update_user_password':
            $res = $user->reset_password($data);
            echo json_encode($res);
            break;
        case 'returnrequisition':
            $res = $req->return_requisition($data);
            echo json_encode($res);
            break;
        case 'deleteuser':
            $res = $user->delete_user($data);
            echo json_encode($res);
            break;
        case 'getuserbyid':
            $res = $user->fetch_by_criterial($data);
            echo json_encode($res);
        break;
        case 'updateuserdetail':
            $res = $user->updateuserdetail($data);
            echo json_encode($res);
        break;
        case 'deletedepartment':
            $res = $department->delete_department($data);
            echo json_encode($res);
        break;
        case 'createdepartment':
            $res = $department->create($data);
            echo json_encode($res);
        break;
        case 'updatedepartmentdetail':
            $res = $department->updatedepartment($data);
            echo json_encode($res);
        break;
        case 'getdepartmentbyid':
            $res = $department->fetch_by_criterial(array("id"=>$data['id']));
            echo json_encode($res);
        break;
        case 'getdepartment':
            $res = $department->fetch_all();
            echo json_encode($res);
        break;
        case 'deleterequisition':
            $res = $req->delete_requisition($data);
            echo json_encode($res);
        break;
        case 'add_price':
            $res = $req->add_price($data);
            echo json_encode($res);
        break;
        case 'get_release_from_procurement':
            $res = $req->get_release_from_procurement($data);
            echo json_encode($res);
        break;
        case 'create_positive_movement':
            $res = $itemmovement->create_positive_movement($data);
            echo json_encode($res);
        break;
        case 'getItemUom':
            $res = $itemmovement->create_positive_movement($data);
            echo json_encode($res);
        break;
        case 'getstockitembyqty':
            $res = $itemmovement->create_positive_movement($data);
            echo json_encode($res);
        break;
        
        case 'audit_set_approval':
            $res = $req->audit_set_approval($data);
            echo json_encode($res);
        break;
        case 'updatepaymentstatus':
            $res = $req->updatepaymentstatus($data);
            echo json_encode($res);
        break;
        case 'updatepaymentprocessstatus':
            $res = $req->updatepaymentprocessstatus($data);
            echo json_encode($res);
        break;

        // claims

        case 'createclaimsheader':
            $res = $claim->create($data, 'claims_header');
            echo json_encode($res);
        break;
        case 'deleteclaims':
            $res = $claim->delete_claims($data);
            echo json_encode($res);
        break;
        case 'add_claimsdetail':
            $res = $claim->create($data, 'claims_detail');
            if($data['claim_id'] != ""){
                $result = $claim->update_header_total($data['claim_id']);
            }
            echo json_encode($res);
        break;
        case 'update_claim_detail':
            // $res = $claim->update_claim_detail($data, 'claims_detail');
            // if($data['claim_id'] != ""){
            //     $result = $claim->update_header_total($data['claim_id']);
            // }
            echo json_encode($data);
        break;
        case 'delete_claim_detail':
            $res = $claim->delete_claim_detail($data);
            if($data['claim_id'] != ""){
                $result = $claim->update_header_total($data['claim_id']);
            }
            echo json_encode($res);
        break;
        case 'get_claim_detail_by_id':
            $res = $claim->fetch_by_criterial(array("id"=>$data['id']), 'claims_detail');
            echo json_encode($res);
        break;
        case 'claims_approval_request':
            $res = $claim->approval_request(array("id"=>$data['id']));
            echo json_encode($res);
        break;
        case 'approve_claim':
            $res = $claim->approval_claim(array("id"=>$data['id']));
            echo json_encode($res);
        break;
        case 'hod_sent_claims_to_hr':
            $res = $claim->hod_sent_claims_to_hr($data);
            echo json_encode($res);
        break;
        case 'hod_sent_claims_to_auditor':
            $res = $claim->hod_sent_claims_to_auditor($data);
            echo json_encode($res);
        break;
        case 'getuserlist':
            $res = $user->fetch_all();
            echo json_encode($res);
        break;
        case 'createrefundsheader':
            $res = $refund->create($data, 'refunds_header');
            echo json_encode($res);
        break;
        case 'deleterefund':
            $res = $refund->delete_refunds($data);
            echo json_encode($res);
        break;
        case 'add_refundsdetail':
            $res = $refund->create($data, 'refunds_detail');
            if($data['refund_id'] != ""){
                $result = $refund->update_header_total($data['refund_id']);
            }
            echo json_encode($res);
        break;
        case 'delete_refund_detail':
            $res = $refund->delete_refund_detail($data);
            if($res){
                $refund->update_header_total($data['refund_id']);
            }
            echo json_encode($res);
        break;
        case 'refunds_approval_request':
            $res = $refund->approval_request($data);
            echo json_encode($res);
        break;
        case 'refund_auditor_approve':
            $res = $refund->audit_approval_refund($data);
            echo json_encode($res);
        break;
        case 'refund_audit_set_approval':
            $res = $refund->audit_set_approval($data);
            echo json_encode($res);
        break;
        case 'updaterefundpaymentstatus':
            $res = $refund->updatepaymentstatus($data);
            echo json_encode($res);
        break;
        case 'updaterefundpaymentprocessstatus':
            $res = $refund->updatepaymentprocessstatus($data);
            echo json_encode($res);
        break;
        case 'approve_refund':
            $res = $refund->approve_refund($data);
            echo json_encode($res);
        break;
        case 'updatereclaimpaymentstatus':
            $res = $claim->updatepaymentstatus($data);
            echo json_encode($res);
        break;
        case 'updatereclaimpaymentprocessstatus':
            $res = $claim->updatepaymentprocessstatus($data);
            echo json_encode($res);
        break;
        case 'addcategorylist':
            $res = $claim->create($data, 'claims_category');
            echo json_encode($res);
        break;
        case 'getcateorylist':
            $res = $claim->fetch_all_category('claims_category');
            echo json_encode($res);
        break;
        case 'createclaimscategory':
            $res = $claim->create($data, 'claims_category');
            echo json_encode($res);
        break;
        case 'deleteclaimscategory':
            $res = $claim->delete_category($data, 'claims_category');
            echo json_encode($res);
        break;
        case 'get_category':
            $res = $claim->fetch_by_criterial(array("id"=>$data['id']), 'claims_category');
            echo json_encode($res);
        break;
        case 'updateclaimscategory':
            $res = $claim->updateclaimscategory($data, 'claims_category');
            echo json_encode($res);
        break;
        case 'claim_audit_approve':
            $res = $claim->audit_approval_claim($data);
            echo json_encode($res);
        break;
        case 'hr_approve_claim':
            $res = $claim->hr_approve_claim($data);
            echo json_encode($res);
        break;
        case 'audit_set_claim_for_approval':
            $res = $claim->audit_set_approval($data);
            echo json_encode($res);
        break;
        case 'returnclaim':
            $res = $claim->return_claim($data);
            echo json_encode($res);
            break;
        case 'returnrefund':
            $res = $refund->return_refund($data);
            echo json_encode($res);
            break;
        case 'getbcc':
            $res = $user->fetch_by_criterial(array('user_roleid'=> 7));
            echo json_encode($res);
        break;
        case 'gethmo':
            $res = $user->fetch_by_criterial(array('user_roleid'=> 6));
            echo json_encode($res);
        break;
        case 'gethod':
            $res = $user->fetch_by_criterial(array('user_roleid'=> 8));
            echo json_encode($res);
        break;
        case 'refund_hod_set_auditor':
            $res = $refund->hod_set_auditor($data);
            echo json_encode($res);
        break;
        case 'refund_bcc_set_auditor':
            $res = $refund->bcc_set_auditor($data);
            echo json_encode($res);
        break;
        
    }

}
?>