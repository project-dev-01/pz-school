ALTER TABLE `staffs` ADD `staff_qualification_id` VARCHAR(255) NULL AFTER `designation_id`, ADD `stream_type_id` VARCHAR(255) NULL AFTER `staff_qualification_id`, ADD `race` VARCHAR(255) NULL AFTER `stream_type_id`;
ALTER TABLE `staffs` CHANGE `department_id` `department_id` VARCHAR(11) NOT NULL;
ALTER TABLE `staffs` CHANGE `designation_id` `designation_id` VARCHAR(11) NOT NULL;
