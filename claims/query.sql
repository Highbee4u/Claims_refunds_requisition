CREATE TABLE `claims_header` ( `id` INT NOT NULL AUTO_INCREMENT , `hospital_no` VARCHAR(36) NOT NULL , `Patient_name` VARCHAR(36) NOT NULL , `Payee` VARCHAR(36) NOT NULL , `Amount` DECIMAL(19,4) NOT NULL , `Enteredby` VARCHAR(36) NOT NULL , `Approvedby` VARCHAR(36) NULL , `Approved` TINYINT(1) NULL , `Approveddate` DATE NULL , `Audited` TINYINT(1) NULL , `Auditedby` VARCHAR(36) NULL , `Accounting_status` TINYINT(1) NULL DEFAULT '0' , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `claims_header` CHANGE `Amount` `Amount` DECIMAL(19,4) NOT NULL DEFAULT '0.0000';

CREATE TABLE `requisitionapp`.`claims_detail` ( `id` INT NOT NULL AUTO_INCREMENT , `claim_id` INT NOT NULL , `Amount` DECIMAL(19,4) NOT NULL , `Description` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `claims_header` ADD `Created_date` DATE NULL DEFAULT CURRENT_TIMESTAMP AFTER `Accounting_status`;

ALTER TABLE `claims_header` CHANGE `Audited` `Audited` TINYINT(1) NULL DEFAULT '0';

ALTER TABLE `claims_header` CHANGE `Approved` `Approved` TINYINT(1) NULL DEFAULT '0';

ALTER TABLE `claims_header` ADD `approvalRequest` INT NULL AFTER `Approved`;

CREATE TABLE `refunds_header` ( `id` INT NOT NULL AUTO_INCREMENT , `hospital_no` VARCHAR(36) NOT NULL , `patient_name` VARCHAR(36) NOT NULL , `account_name` VARCHAR(36) NULL , `account_number` VARCHAR(36) NULL , `bank_name` VARCHAR(36) NULL , `enteredby` VARCHAR(36) NOT NULL , `hod_signature` VARCHAR(36) NULL , `audited` TINYINT(1) NULL , `approval` TINYINT(1) NULL , `accountant_status` TINYINT(1) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `refunds_header` ADD `amount` DECIMAL(19,4) NOT NULL DEFAULT '0.0000' AFTER `account_number`;


ALTER TABLE `requisition_header` ADD `payment_status` TINYINT(1) NOT NULL AFTER `requisitiontype`;

ALTER TABLE `requisition_header` ADD `payment_date` DATE NOT NULL AFTER `payment_status`;

ALTER TABLE `refunds_header` ADD `auditedby` TINYINT NOT NULL AFTER `approval`, ADD `approvedby` TINYINT NOT NULL AFTER `auditedby`, ADD `approveddate` DATE NOT NULL AFTER `approvedby`;

ALTER TABLE `refunds_header` CHANGE `auditedby` `auditedby` TINYINT(4) NULL;

ALTER TABLE `refunds_header` CHANGE `approvedby` `approvedby` TINYINT(4) NULL;

ALTER TABLE `refunds_header` CHANGE `approveddate` `approveddate` DATE NULL;

ALTER TABLE `refunds_header` ADD `departmentid` INT NULL AFTER `enteredby`;

CREATE TABLE `requisitionapp`.`refunds_detail` ( `id` INT NOT NULL AUTO_INCREMENT , `refund_id` INT NOT NULL , `amount` DECIMAL(19,4) NOT NULL , `Description` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `refunds_header` ADD `approvalRequest` TINYINT(1) NOT NULL DEFAULT '0' AFTER `approveddate`;

ALTER TABLE `refunds_header` CHANGE `audited` `audited` TINYINT(1) NULL DEFAULT '0';

ALTER TABLE `refunds_header` CHANGE `audited` `audited` TINYINT(1) NOT NULL DEFAULT '0';

ALTER TABLE `refunds_header` CHANGE `payment_date` `payment_date` DATE NULL;

ALTER TABLE `refunds_header` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `claims_header` ADD `staffname` VARCHAR(36) NULL AFTER `Created_date`, ADD `claim_categoryid` INT NULL AFTER `staffname`;

ALTER TABLE `claims_header` CHANGE `hospital_no` `hospital_no` VARCHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL;

ALTER TABLE `claims_header` CHANGE `Patient_name` `Patient_name` VARCHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL;

ALTER TABLE `claims_header` CHANGE `Payee` `Payee` VARCHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL;

CREATE TABLE `requisitionapp`.`claims_category` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(36) NULL , `created_at` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP , `createdby` VARCHAR(36) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `claims_category` ADD `description` TEXT NOT NULL AFTER `name`;

ALTER TABLE `claims_header` ADD `claimtype` INT NOT NULL AFTER `id`;

ALTER TABLE `claims_header` ADD `hrstatus` INT NULL AFTER `staffname`, ADD `hrname` VARCHAR(36) NULL AFTER `hrstatus`;

ALTER TABLE `claims_header` CHANGE `hrname` `hrname` INT NULL DEFAULT NULL;

ALTER TABLE `claims_header` ADD `hrrequired` INT NULL DEFAULT '0' AFTER `hrstatus`;

ALTER TABLE `claims_header` CHANGE `hrstatus` `hrstatus` INT(11) NULL DEFAULT '0';




