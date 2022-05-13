ALTER TABLE `staffs` ADD `staff_qualification_id` VARCHAR(255) NULL AFTER `designation_id`, ADD `stream_type_id` VARCHAR(255) NULL AFTER `staff_qualification_id`, ADD `race` VARCHAR(255) NULL AFTER `stream_type_id`;
ALTER TABLE `staffs` CHANGE `department_id` `department_id` VARCHAR(11) NOT NULL;
ALTER TABLE `staffs` CHANGE `designation_id` `designation_id` VARCHAR(11) NOT NULL;

-- 10-5-2022
ALTER TABLE `subjects` ADD `subject_type_2` VARCHAR(255) NULL AFTER `subject_type`;
ALTER TABLE `subjects` ADD `exam_exclude` TINYINT(255) NOT NULL AFTER `subject_color_calendor`;
-- 12-5-2022
ALTER TABLE `staffs` CHANGE `blood_group` `blood_group` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;
-- 12-5-2022
ALTER TABLE `staffs` ADD `city` VARCHAR(255) NOT NULL AFTER `blood_group`, ADD `state` VARCHAR(255) NOT NULL AFTER `city`, ADD `country` VARCHAR(255) NOT NULL AFTER `state`, ADD `post_code` VARCHAR(255) NOT NULL AFTER `country`;
ALTER TABLE `staffs` ADD `height` VARCHAR(255) NULL AFTER `religion`, ADD `weight` VARCHAR(255) NULL AFTER `height`, ADD `allergy` VARCHAR(255) NULL AFTER `weight`;
ALTER TABLE `staffs` ADD `short_name` VARCHAR(255) NULL AFTER `name`;
