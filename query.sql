ALTER TABLE `requisition_header` ADD `auditeddate` DATETIME NULL AFTER `payment_date`, ADD `approveddate` DATETIME NULL AFTER `auditeddate`, ADD `procapproveddate` DATETIME NULL AFTER `approveddate`;

ALTER TABLE `requisition_header` ADD `returneddate` DATETIME NULL AFTER `procapproveddate`;

UPDATE `requisition_header` SET `auditeddate` = reqdate, `approveddate` = reqdate WHERE `approved` = 1 AND `audited` = 1;

UPDATE `requisition_header` SET `auditeddate` = reqdate  WHERE `approved` = 0 AND `audited` = 1;

UPDATE `requisition_header` SET `procapproveddate` = reqdate  WHERE `approved` = 0 AND `audited` = 0 AND `awaiting_price` = 0;

ALTER TABLE `requisition_header` ADD `returnedby` INT NULL AFTER `return`;

ALTER TABLE `refunds_header` ADD `returneddate` DATETIME NULL AFTER `hodrequired`,  ADD `auditeddate` DATETIME NULL AFTER `auditeddate`, ADD `hodapproveddate` DATETIME NULL AFTER `auditeddate`;

ALTER TABLE `refunds_header` ADD `bccapproveddate` DATETIME NULL AFTER `hodapproveddate`;

ALTER TABLE `claims_header` ADD `returneddate` DATETIME NULL;  

ALTER TABLE `claims_header` ADD `auditeddate` DATETIME NULL; 

ALTER TABLE `claims_header` ADD `hodapproveddate` DATETIME NULL;

ALTER TABLE `claims_header` CHANGE `hodapproveddate` `hrapproveddate` DATETIME NULL DEFAULT NULL;

ALTER TABLE `refunds_header` ADD `returnedby` INT NULL AFTER `returned`;

ALTER TABLE `requisition_header` ADD `paidby` INT NULL AFTER `returneddate`;

ALTER TABLE `claims_header` ADD `hodname` INT NULL AFTER `hod`;


ALTER TABLE `refunds_header` ADD `paidby` INT NULL AFTER `bccapproveddate`;

ALTER TABLE `refunds_header` ADD `payment_process_status` INT NOT NULL DEFAULT '0' AFTER `paidby`;

ALTER TABLE `refunds_header` CHANGE `payment_process_status` `payment_process_status` INT(11) NULL DEFAULT '0';

ALTER TABLE `claims_header` ADD `payment_process_status` INT NULL DEFAULT '0' AFTER `hrapproveddate`;

ALTER TABLE `requisition_header` ADD `payment_process_status` INT NULL DEFAULT '0' AFTER `paidby`;

UPDATE `requisition_header` SET `payment_process_status` = 1 WHERE `payment_status` = 1 

ALTER TABLE `claims_header` ADD `paidby` INT NULL AFTER `payment_process_status`;

DELETE FROM `claims_header` WHERE id NOT IN (SELECT claim_id FROM claims_detail);

DELETE FROM `refunds_header` WHERE id NOT IN (SELECT refund_id FROM refunds_detail);

DELETE FROM `requisition_header` WHERE reqnumber NOT IN (SELECT reqnumber FROM requisition_detail);

ALTER TABLE `claims_header` ADD `hod` INT NOT NULL DEFAULT '0' AFTER `paidby`;

ALTER TABLE `claims_header` CHANGE `Approveddate` `Approveddate` DATETIME NULL DEFAULT NULL;

UPDATE `claims_header` SET `auditeddate` = `Created_date` WHERE `Audited` = 1;

UPDATE `refunds_header` SET `auditeddate` = `approveddate` WHERE `audited` = 1;

UPDATE refunds_header SET `hodapproveddate` = approveddate WHERE approval = 1 AND hodrequired = 1;

ALTER TABLE `refunds_header` CHANGE `approveddate` `approveddate` DATETIME NULL DEFAULT NULL;







