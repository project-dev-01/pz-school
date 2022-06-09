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

-- 17-05-2022
ALTER TABLE `staffs` ADD `first_name` VARCHAR(255) NOT NULL AFTER `staff_id`, ADD `last_name` VARCHAR(255) NULL AFTER `first_name`, ADD `employment_status` VARCHAR(255) NULL AFTER `last_name`;
ALTER TABLE `staffs` CHANGE `staff_id` `staff_id` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `department_id` `department_id` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `designation_id` `designation_id` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `joining_date` `joining_date` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `birthday` `birthday` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `gender` `gender` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `religion` `religion` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `city` `city` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `state` `state` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `country` `country` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `post_code` `post_code` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `present_address` `present_address` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `permanent_address` `permanent_address` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `mobile_no` `mobile_no` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;


-- 20-05-2022
ALTER TABLE `staffs` CHANGE `birthday` `birthday` DATE NOT NULL;
ALTER TABLE `hostel_category` DROP `description`, DROP `type`;
ALTER TABLE `hostel_room` DROP `category_id`;
ALTER TABLE `hostel_room` ADD `block` VARCHAR(255) NULL AFTER `hostel_id`, ADD `floor` VARCHAR(255) NULL AFTER `block`;

-- 30-05-2022
ALTER TABLE `subject_assigns` ADD `type` ENUM('0','1') NOT NULL AFTER `teacher_id`;
ALTER TABLE `teacher_allocations` ADD `type` ENUM('0','1','2') NOT NULL AFTER `teacher_id`;
-- 1-6-2022
ALTER TABLE `timetable_class` CHANGE `teacher_id` `teacher_id` VARCHAR(255) NOT NULL;
ALTER TABLE `calendors` CHANGE `teacher_id` `teacher_id` VARCHAR(255) NULL DEFAULT NULL;

-- 06-01-2022
ALTER TABLE `calendors` ADD `description` TEXT NULL AFTER `end`;
ALTER TABLE `calendors` ADD `login_id` INT NULL AFTER `description`;
ALTER TABLE `calendors` ADD `task_color` VARCHAR(255) NULL AFTER `description`;
