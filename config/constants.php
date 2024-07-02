<?php
$url = "http://localhost/paxsuzen-api-dev/public/api";
// $url = "https://api.suzen.school/api";
$schoolurl = "http://localhost/school-management-system/public"; // end line don't use "/"
return [
    'branch_id'=>'5',
    'school_name'=>'クアラルンプール日本人学校',
    'school_image'=>'logo_jskl.jpeg',
    'image_url' => "http://localhost/paxsuzen-api-dev/public",
    'cron_secret_key'=> 'S6rSMVixPeupH51AO5mVFjkQJ88bnjOO',
    'domainname'=> $schoolurl,
    'max_freetext'=>'300', // set Free text character in Exam Bulk Upload Validation
    'max_scoremark'=>'100', // set Maximum Mark in Exam Bulk Upload Validation
    'api' => [
        // school login url        
        'homepage'=> $schoolurl.'/home',
        'superadmin_login' => $schoolurl.'/syscont/login',
        'admin_login' => $schoolurl.'/admin/login',
        'staff_login' => $schoolurl.'/staff/login',
        'teacher_login' => $schoolurl.'/teacher/login',
        'parent_login' => $schoolurl.'/parent/login',
        'student_login' => $schoolurl.'/student/login',
        'guest_login' => $schoolurl.'/guest/login',
        // login url
        'login' => $url.'/login',
        'login_guest' => $url.'/login_guest',
        'loginSA' => $url.'/loginSA',
        'login_branch' => $url.'/login_branch',
        // country,state,cities
        'countries' => $url.'/get-countries',
        'states' => $url.'/get-states',
        'cities' => $url.'/get-cities',
        // get roles
        'roles' => $url.'/roles/list',
        //get semester
        'semester' => $url.'/semester/list',
        //get session
        'session' => $url.'/session/list',
        // section url
        'section_add' => $url.'/section/add',
        'section_list' => $url.'/section/list',
        'section_details' => $url.'/section/section-details',
        'section_update' => $url.'/section/update',
        'section_delete' => $url.'/section/delete',
        // branch url
        'branch_add' => $url.'/branch/add',
        'branch_list' => $url.'/branch/list',
        'branch_details' => $url.'/branch/branch-details',
        'branch_update' => $url.'/branch/update',
        'branch_delete' => $url.'/branch/delete',
        // section allocation url
        'allocate_section_add' => $url.'/allocate_section/add',
        'allocate_section_list' => $url.'/allocate_section/list',
        'allocate_section_details' => $url.'/allocate_section/section_allocation-details',
        'allocate_section_update' => $url.'/allocate_section/update',
        'allocate_section_delete' => $url.'/allocate_section/delete',
        // Teacher allocation url
        'assign_teacher_add' => $url.'/assign_teacher/add',
        'assign_teacher_list' => $url.'/assign_teacher/list',
        'assign_teacher_details' => $url.'/assign_teacher/assign_teacher-details',
        'assign_teacher_update' => $url.'/assign_teacher/update',
        'assign_teacher_delete' => $url.'/assign_teacher/delete',
        'branch_by_assign_teacher' => $url.'/branch-by-assign-teacher',
        

        'branch_by_class' => $url.'/branch-by-class',
        'branch_by_section' => $url.'/branch-by-section',
        'section_by_class' => $url.'/section-by-class',
        'subject_by_class' => $url.'/subject-by-class',  
        'subject_by_exam_names' => $url.'/subject-by-exam-names',
        'exam_by_subjects' => $url.'/exam-by-subjects', 
        'exam_by_teacher_subjects' => $url.'/exam-by-teacher-subjects', 
        'subject_by_papers' => $url.'/subject-by-papers', 
        'subject_by_papers_analytics' => $url.'/subject-by-papers-analytics', 
        'timetable_subject' => $url.'/timetable-subject',
        'exam_by_classSection'=>$url.'/exam-by-classSection',
        'exam_by_classSubject'=>$url.'/exam-by-classSubject',
        'tot_grade_calcu_byclass'=>$url.'/tot_grade_calcu_byclass',
        'tot_grade_calcu_bySubject'=>$url.'/tot_grade_calcu_bySubject',
        'tot_grade_calcu_byStudent'=>$url.'/tot_grade_calcu_byStudent',
        'tot_grade_master'=>$url.'/tot_grade_master',
        'all_exams_list'=>$url.'/all_exams_list',
        'all_std_list'=>$url.'/all_std_list',
        'get_grade_bysubject'=>$url.'/get_grade_bysubject',
        'get_paper_list'=>$url.'/get_paper_list',
        
        // class url
        'class_add' => $url.'/classes/add',
        'class_list' => $url.'/classes/list',
        'class_details' => $url.'/classes/class-details',
        'class_update' => $url.'/classes/update',
        'class_delete' => $url.'/classes/delete',
        'classes_list_by_department' => $url.'/classes/list_by_department',
        // subjects url
        'subject_add' => $url.'/subjects/add',
        'subject_list' => $url.'/subjects/list',
        'subject_details' => $url.'/subjects/subjects-details',
        'subject_update' => $url.'/subjects/update',
        'subject_delete' => $url.'/subjects/delete',

        'teacher_class_list' => $url.'teacher/class_list',
        // assign class subjects
        'class_assign_list'=>$url.'/class_assign/list',
        'class_assign_add' => $url.'/class_assign/add',
        'class_assign_details' => $url.'/class_assign/class_assign-details',
        'class_assign_update' => $url.'/class_assign/update',
        'class_assign_delete' => $url.'/class_assign/delete',
        // assign class subjects teacher
        'teacher_assign_sub_list'=>$url.'/teacher_assign/list',
        'teacher_assign_sub_add' => $url.'/teacher_assign/add',
        'teacher_assign_sub_details' => $url.'/teacher_assign/teacher_assign-details',
        'teacher_assign_sub_update' => $url.'/teacher_assign/update',
        'teacher_assign_sub_delete' => $url.'/teacher_assign/delete',
        // get_assign_class_subjects
        'get_assign_class_subjects' => $url.'/get_assign_class_subjects',
        
        // event type url
        'event_type_add' => $url.'/event_type/add',
        'event_type_list' => $url.'/event_type/list',
        'event_type_details' => $url.'/event_type/event_type-details',
        'event_type_update' => $url.'/event_type/update',
        'event_type_delete' => $url.'/event_type/delete',
        'holidays_list_event' => $url.'/event_type/holidays_list_event',
        // event url
        'event_add' => $url.'/event/add',
        'event_list' => $url.'/event/list',
        'event_details' => $url.'/event/event-details',
        'event_update' => $url.'/event/update',
        'event_delete' => $url.'/event/delete',
        'event_publish' => $url.'/event/publish',
        'branch_by_event' => $url.'/branch-by-event',
        'event_list_student' => $url.'/event/list/student',
        // Qualifications
        'qualification/index' => $url.'/qualification/index',
        'qualification_add' => $url.'/qualification/add',
        'qualification_list' => $url.'/qualification/list',
        'qualifications_details' => $url.'/qualifications/qualifications-details',
        'qualifications_update' => $url.'/qualification/update',
        'qualifications_delete' => $url.'/qualification/delete',
        // Staff category
        'staffcategory/index'=> $url.'/staffcategory/index',
        'staffcategory_add' => $url.'/staffcategory/add',
        'staffcategory_list' => $url.'/staffcategory/list',
        'staffcategory_details' => $url.'/staffcategory/staffcategory-details',
        'staffcategory_update' => $url.'/staffcategory/update',
        'staffcategory_delete' => $url.'/staffcategory/delete',
        // department url
        'department_add' => $url.'/department/add',
        'department_list' => $url.'/department/list',
        'department_details' => $url.'/department/department-details',
        'department_update' => $url.'/department/update',
        'department_delete' => $url.'/department/delete',

        // designation url
        'designation_add' => $url.'/designation/add',
        'designation_list' => $url.'/designation/list',
        'designation_details' => $url.'/designation/designation-details',
        'designation_update' => $url.'/designation/update',
        'designation_delete' => $url.'/designation/delete',

        // staff position url
        'staff_position_add' => $url.'/staff_position/add',
        'staff_position_list' => $url.'/staff_position/list',
        'staff_position_details' => $url.'/staff_position/staff_position-details',
        'staff_position_update' => $url.'/staff_position/update',
        'staff_position_delete' => $url.'/staff_position/delete',

        // stream type url
        'stream_type_add' => $url.'/stream_type/add',
        'stream_type_list' => $url.'/stream_type/list',
        'stream_type_details' => $url.'/stream_type/stream_type-details',
        'stream_type_update' => $url.'/stream_type/update',
        'stream_type_delete' => $url.'/stream_type/delete',

        // religion url
        'religion_add' => $url.'/religion/add',
        'religion_list' => $url.'/religion/list',
        'religion_details' => $url.'/religion/religion-details',
        'religion_update' => $url.'/religion/update',
        'religion_delete' => $url.'/religion/delete',

        // race url
        'race_add' => $url.'/race/add',
        'race_list' => $url.'/race/list',
        'race_details' => $url.'/race/race-details',
        'race_update' => $url.'/race/update',
        'race_delete' => $url.'/race/delete',

        //teacher url
        
        'teacher_list' => $url.'/teacher/list',

         // employee url
         'emp_department' => $url.'/employee/department',
         'emp_designation' => $url.'/employee/designation',
         'employee_add' => $url.'/employee/add',
         'employee_list' => $url.'/employee/list',
         'employee_details' => $url.'/employee/employee-details',
         'employee_update' => $url.'/employee/update',
         'employee_delete' => $url.'/employee/delete',

         'get_qualifications' => $url.'/employee/get_qualifications',
         'staff_categories' => $url.'/employee/staff_categories',
         'staff_positions' => $url.'/employee/staff_positions',
         'stream_types' => $url.'/employee/stream_types',
         'religion' => $url.'/employee/religion',
         'races' => $url.'/employee/races',
         // timetable url
        'timetable_add' => $url.'/timetable/add',
        'timetable_list' => $url.'/timetable/list',
        'timetable_edit' => $url.'/timetable/edit',
        'timetable_update' => $url.'/timetable/update',
        'timetable_copy' => $url.'/timetable/copy',

        'timetable_student' => $url.'/timetable/student',
        'timetable_parent' => $url.'/timetable/parent',

        //timetable bulk url
        'timetable_subject_bulk' => $url.'/timetable-subject-bulk',
        'timetable_add_bulk' => $url.'/timetable/add/bulk',

          // settings url
          'change_profile_picture' => $url.'/change-profile-picture',
          'change_logo' => $url.'/settings/logo',
          'get_user' => $url.'/get_user',
          'change_password' => $url.'/change-password',
          'staff_profile_info' => $url.'/settings/staff_profile_info',
          'update_profile_info' => $url.'/update-profile-info',
          'parent_profile_info' => $url.'/settings/parent_profile_info',
          'update_parent_profile_info' => $url.'/update-parent-profile-info',
          'student_profile_info' => $url.'/settings/student_profile_info',
          'update_student_profile_info' => $url.'/update-student-profile-info',
          'change_student_profile_picture' => $url.'/change-student-profile-picture',
          'change_parent_profile_picture' => $url.'/change-parent-profile-picture',

        // report card 
        'get_by_reportcard' => $url.'/get_by_reportcard',

        // forum url
        'forum_cpost' => $url.'/forum/createpost',
        'forum_updatepost' => $url.'/forum/updatepost',   
        'forum_list' => $url.'/forum/list',   
        'forum_edit' => $url.'/forum/edit',
        'forum_delete' => $url.'/forum/delete',
        'forum_threadslist'=>$url.'/forum/threadslist',
        'forum_userthreadslist'=>$url.'/forum/userthreadslist',
        'listcategoryvs'=>$url.'/forum/listcategory',
        'adminlistcategoryvs'=>$url.'/forum/adminlistcategoryvs',
        'category' => $url.'/get-category',  
        'dbnameslist'=>$url.'/get-dbnames', 
        'dbvsgetbranchid'=>$url.'/get-branchid',
        'forum_single_post'=>$url.'/forum/singlepost',
        'forum_single_categ'=>$url.'/forum/singlecateg',
        'forum_user_category_list'=>$url.'/forum/usersinglecateg',
        'forum_post_user_created'=>$url.'/forum/postlistusercreated',
        'forum_categorypost_user_created'=>$url.'/forum/listcategoryusercrd',
        'forum_single_post_replies'=>$url.'/forum/singlepost/replies',
        'like_countadd' => $url.'/forum-likecout',
        'dislike_countadd' => $url.'/forum-discout',
        'heart_countadd' => $url.'/forum-heartcout',
        'view_countadd' => $url.'/forum-viewcout',
        'view_countadd_insert'=> $url.'/forum-viewcout-insert', 
        'replies_insert'=> $url.'/forum-replies-insert',    
        'replike_countadd' =>$url.'/forum-replikecout',
        'repdislike_countadd' =>$url.'/forum-repdislikecout',
        'repheart_countadd'=>$url.'/forum-repfavorits',
        'forum_posts_user_repliesall'=>$url.'/forum/post/allreplies',
        'thread_status_update'=>$url.'/forum/threads/status/update',
        'usernames_autocomplete'=>$url.'/forum/usernames/autocomplete',
        'getdbid_vsuserid'=>$url.'/forum/getuserid',
        // classroom management api details
        // filter api
        'teacher_class' => $url.'/teacher_class',
        'teacher_section' => $url.'/teacher_section',
        'teacher_subject' => $url.'/teacher_subject',
        'get_student_attendance' => $url.'/get_student_attendance',
        'add_student_attendance' => $url.'/add_student_attendance',
        'get_short_test' => $url.'/get_short_test',
        'add_short_test' => $url.'/add_short_test',
        'add_daily_report' => $url.'/add_daily_report',
        'get_daily_report_remarks' => $url.'/get_daily_report_remarks',
        'add_daily_report_remarks' => $url.'/add_daily_report_remarks',
        'get_classroom_widget_data' => $url.'/get_classroom_widget_data',
        'get_testresult_exams' => $url.'/get_testresult_exams',
        'get_testresult_marks_subject_vs' => $url.'/get_testresult_marks_subject_vs',
        'add_daily_report_by_student' => $url.'/add_daily_report_by_student',
        'get_student_attendance_no_subject' => $url.'/get_student_attendance_no_subject',
        'add_student_attendance_no_subject' => $url.'/add_student_attendance_no_subject',
        // get attendance list
        'get_attendance_list' => $url.'/get_attendance_list',
        'get_child_subjects' => $url.'/get_child_subjects',
        'get_attendance_list_teacher' => $url.'/get_attendance_list_teacher',
        'get_attendance_list_teacher_by_subject' => $url.'/get_attendance_list_teacher_by_subject',
        'get_attendance_list_parent' => $url.'/get_attendance_list_parent',
        
        'get_reasons_by_student' => $url.'/get_reasons_by_student',
        'get_birthday_calendor_teacher' => $url.'/get_birthday_calendor_teacher',
        'get_birthday_calendor_admin' => $url.'/get_birthday_calendor_admin',
        
        
        
         // homework url
         'homework_add' => $url.'/homework/add',
         'homework_list' => $url.'/homework/list',
         'homework_details' => $url.'/homework/homework-details',
         'homework_student' => $url.'/homework/student',
         'homework_student_filter' => $url.'/homework/student/filter',
         'homework_submit' => $url.'/homework/submit',
         'homework_view' => $url.'/homework/view',
         'homework_evaluate' => $url.'/homework/evaluate',
         'homework_all_list' => $url.'/homework/all_list',
         // calendor timetable show
         'get_timetable_calendor' => $url.'/get_timetable_calendor',
         'get_event_calendor' => $url.'/get_event_calendor',
         'get_timetable_calendor_student' => $url.'/get_timetable_calendor_student',
         'get_event_calendor_student' => $url.'/get_event_calendor_student',
         'get_event_calendor_admin' => $url.'/get_event_calendor_admin',
         
         
        'get_bulk_calendor_teacher' => $url.'/get_bulk_calendor_teacher',
        'get_bulk_calendor_admin' => $url.'/get_bulk_calendor_admin',
        'get_bulk_calendor_student' => $url.'/get_bulk_calendor_student',

         // exam term url
        'exam_term_add' => $url.'/exam_term/add',
        'exam_term_list' => $url.'/exam_term/list',
        'exam_term_details' => $url.'/exam_term/exam_term-details',
        'exam_term_update' => $url.'/exam_term/update',
        'exam_term_delete' => $url.'/exam_term/delete',

         // exam hall url
         'exam_hall_add' => $url.'/exam_hall/add',
         'exam_hall_list' => $url.'/exam_hall/list',
         'exam_hall_details' => $url.'/exam_hall/exam_hall-details',
         'exam_hall_update' => $url.'/exam_hall/update',
         'exam_hall_delete' => $url.'/exam_hall/delete',

         // exam  url
         'exam_add' => $url.'/exam/add',
         'exam_list' => $url.'/exam/list',
         'exam_details' => $url.'/exam/exam-details',
         'exam_update' => $url.'/exam/update',
         'exam_delete' => $url.'/exam/delete',

         // timetable exam  url
         'exam_timetable_add' => $url.'/exam_timetable/add',
         'exam_timetable_list' => $url.'/exam_timetable/list',
         'exam_timetable_get' => $url.'/exam_timetable/get',
         'exam_timetable_delete' => $url.'/exam_timetable/delete',

        // grade url
        'grade_add' => $url.'/grade/add',
        'grade_list' => $url.'/grade/list',
        'grade_details' => $url.'/grade/grade-details',
        'grade_update' => $url.'/grade/update',
        'grade_delete' => $url.'/grade/delete',
        // grade_category
        'grade_category' => $url.'/grade/category',
                 // get_marks_vs_grade
        'get_marks_vs_grade' => $url.'/get_marks_vs_grade',
        'add_student_marks' => $url.'/add_student_marks',
        'get_subject_division' => $url.'/get_subject_division',
        'add_subject_division'=>$url.'/add_subject_division',
        'get_subject_average' => $url.'/get_subject_average',
        'get_student_subject_mark' => $url.'/get_student_subject_mark',
        'get_student_grade' => $url.'/get_student_grade',
        'get_subject_division_mark' => $url.'/get_subject_division_mark',
        'get_subject_mark_status' => $url.'/get_subject_mark_status',
        'get_pointsresult' => $url.'/get_pointsresult',
                
        // hostel url
        'hostel_add' => $url.'/hostel/add',
        'hostel_list' => $url.'/hostel/list',
        'hostel_details' => $url.'/hostel/hostel-details',
        'hostel_update' => $url.'/hostel/update',
        'hostel_delete' => $url.'/hostel/delete',

        // hostel room url
        'hostel_room_add' => $url.'/hostel_room/add',
        'hostel_room_list' => $url.'/hostel_room/list',
        'hostel_room_details' => $url.'/hostel_room/hostel_room-details',
        'hostel_room_update' => $url.'/hostel_room/update',
        'hostel_room_delete' => $url.'/hostel_room/delete',

        // hostel category url
        'hostel_category_add' => $url.'/hostel_category/add',
        'hostel_category_list' => $url.'/hostel_category/list',
        'hostel_category_details' => $url.'/hostel_category/hostel_category-details',
        'hostel_category_update' => $url.'/hostel_category/update',
        'hostel_category_delete' => $url.'/hostel_category/delete',

        // hostel block url
        'hostel_block_add' => $url.'/hostel_block/add',
        'hostel_block_list' => $url.'/hostel_block/list',
        'hostel_block_details' => $url.'/hostel_block/hostel_block-details',
        'hostel_block_update' => $url.'/hostel_block/update',
        'hostel_block_delete' => $url.'/hostel_block/delete',

        // hostel floor url
        'hostel_floor_add' => $url.'/hostel_floor/add',
        'hostel_floor_list' => $url.'/hostel_floor/list',
        'hostel_floor_details' => $url.'/hostel_floor/hostel_floor-details',
        'hostel_floor_update' => $url.'/hostel_floor/update',
        'hostel_floor_delete' => $url.'/hostel_floor/delete',

        'floor_by_block' => $url.'/floor-by-block',
        'vehicle_by_route' => $url.'/vehicle-by-route',
        'room_by_hostel' => $url.'/room-by-hostel',

        // adminssion url
        'admission_add' => $url.'/admission/add',
        // add_to_do_list
        'add_to_do_list' => $url.'/add_to_do_list',
        'update_to_do_list' => $url.'/update_to_do_list',
        'get_to_do_list' => $url.'/get_to_do_list',
        'get_to_do_row' => $url.'/get_to_do_row',
        'delete_to_do_list' => $url.'/delete_to_do_list',
        'get_to_do_list_dashboard' => $url.'/get_to_do_list_dashboard',
        'read_update_todo' => $url.'/read_update_todo',
        'get_assign_class' => $url.'/get_assign_class',
        'to_do_comments' => $url.'/to_do_comments',
        'get_to_do_teacher' => $url.'/get_to_do_teacher',

        // Student Url
        'teacher_student_list' => $url.'/teacher/student/list',
        'student_list' => $url.'/student/list',
        'student_details' => $url.'/student/student-details',
        'student_update' => $url.'/student/update',
        'student_delete' => $url.'/student/delete',
        'student_settings' => $url.'/student/student_settings',
        'get_student_download_settings' => $url.'/get_student_download_settings',
        'getgraduatestudentlist' => $url.'/student/graduatelist',
        
        'relation_list' => $url.'/relation/list',
        //Parent Url
        'parent_add' => $url.'/parent/add',
        'parent_list' => $url.'/parent/list',
        'parent_update_info_list' => $url.'/parent/update_info/list',
        'parent_update_info_view' => $url.'/parent/update_info/view',
        'parent_student_update' => $url.'/parent/student/update',
        'parent_update_view' => $url.'/parent/update/view',
        'parent_student_update_info_list' => $url.'/parent/student/update_info/list',
        'getParentDetailsAccStudentId'  => $url.'/parent/getParentDetailsAccStudentId',        
        'student_update_info_list' => $url.'/student/update_info/list',
        'student_update_info_view' => $url.'/student/update_info/view',
        'parent_name' => $url.'/parent/name',
        'parent_details' => $url.'/parent/parent-details',
        'parent_update' => $url.'/parent/update',
        'parent_update_info_update' => $url.'/parent/update_info/update',
        'student_update_info_update' => $url.'/student/update_info/update',
        'parent_delete' => $url.'/parent/delete',
        // get_all_teacher_list
        'get_all_teacher_list' => $url.'/get_all_teacher_list',

        'get_homework_list_dashboard' => $url.'/get_homework_list_dashboard',
        'get_test_score_dashboard' => $url.'/get_test_score_dashboard',

        // parent id wise get student
        'get_students_parentdashboard' => $url.'/get_students_parentdashboard',
        //student leave apply 
        'std_leave_apply'=> $url.'/std_leave_apply',
        'std_leave_update'=> $url.'/std_leave_update',
        'call_via_leave_approve'=> $url.'/call_via_leave_approve',
        'get_student_leave_types'=> $url.'/student_leave/get_student_leave_types',
        'get_reasons_by_leave_type'=> $url.'/student_leave/get_reasons_by_leave_type',
        'nursing_or_homeroom'=> $url.'/nursing_or_homeroom',
        // get student leaves
        'get_student_leaves'=> $url.'/get_student_leaves',
        // get leave reasons
        'get_leave_reasons'=>$url.'/get_leave_reasons',
        // get student leave list particular
        'studentleave_delete' => $url.'/studentleave/delete',
        'edit_student_leave_form' => $url.'/studentleave/edit',
        'studentleave_list'=>$url.'/studentleave_list',
        'get_all_student_leaves'=>$url.'/get_all_student_leaves',
        'leave_type_wise_get_all_reason'=>$url.'/leave_type_wise_get_all_reason',
        
        // teacher leave approve
        'teacher_leave_approve'=>$url.'/teacher_leave_approve',
        'leave_reupload_file'=>$url.'/std_leave_apply/reupload_file',
        'staff_leave_reupload_file'=>$url.'/staff_leave_apply/reupload_file',
        // leave type url
        'leave_type_add' => $url.'/leave_type/add',
        'leave_type_list' => $url.'/leave_type/list',
        'leave_type_details' => $url.'/leave_type/leave_type-details',
        'leave_type_update' => $url.'/leave_type/update',
        'leave_type_delete' => $url.'/leave_type/delete',
        // staff leave assign url
        'staff_leave_assign_add' => $url.'/staff_leave_assign/add',
        'staff_leave_assign_list' => $url.'/staff_leave_assign/list',
        'staff_leave_assign_details' => $url.'/staff_leave_assign/staff_leave_assign-details',
        'staff_leave_assign_update' => $url.'/staff_leave_assign/update',
        'staff_leave_assign_delete' => $url.'/staff_leave_assign/delete',

        // transport route url
        'transport_route_add' => $url.'/transport_route/add',
        'transport_route_list' => $url.'/transport_route/list',
        'transport_route_details' => $url.'/transport_route/transport_route-details',
        'transport_route_update' => $url.'/transport_route/update',
        'transport_route_delete' => $url.'/transport_route/delete',

        // transport stoppage url
        'transport_stoppage_add' => $url.'/transport_stoppage/add',
        'transport_stoppage_list' => $url.'/transport_stoppage/list',
        'transport_stoppage_details' => $url.'/transport_stoppage/transport_stoppage-details',
        'transport_stoppage_update' => $url.'/transport_stoppage/update',
        'transport_stoppage_delete' => $url.'/transport_stoppage/delete',

        // transport assign url
        'transport_assign_add' => $url.'/transport_assign/add',
        'transport_assign_list' => $url.'/transport_assign/list',
        'transport_assign_details' => $url.'/transport_assign/transport_assign-details',
        'transport_assign_update' => $url.'/transport_assign/update',
        'transport_assign_delete' => $url.'/transport_assign/delete',
        // employee-leave
        'get_leave_types'=>$url.'/employee-leave/get_leave_types',
        'staff_apply_leave'=>$url.'/employee-leave/apply',
        'staff_leave_history'=>$url.'/employee-leave/leave_history',
        'staff_leave_approved'=>$url.'/employee-leave/approved',
        'get_all_staff_details'=>$url.'/get_all_staff_details',
        'assign_leave_approval'=>$url.'/employee-leave/assign_leave_approval',
        'leave_approval_history_by_staff'=>$url.'/employee-leave/leave_approval_history_by_staff',
        'staff_leave_details'=>$url.'/employee-leave/leave_details',
        'leave_taken_history'=>$url.'/employee-leave/leave_taken_history',
        
        'employee_attendance_list'=>$url.'/attendance/employee_list',
        'employee_attendance_add'=>$url.'/attendance/employee_add',
        'employee_attendance_report'=>$url.'/attendance/employee_report',

        // add task in calendor
        'calendor_add_task_calendor'=>$url.'/calendor/add-task-calendor',
        'calendor_list_task_calendor'=>$url.'/calendor/list-task-calendor',
        'calendor_edit_task_calendor'=>$url.'/calendor/edit-task-calendor',
        'calendor_update_task_calendor'=>$url.'/calendor/update-task-calendor',
        'calendor_delete_task_calendor'=>$url.'/calendor/delete-task-calendor',
        
        // education url
        'education_add' => $url.'/education/add',
        'education_list' => $url.'/education/list',
        'education_details' => $url.'/education/education-details',
        'education_update' => $url.'/education/update',
        'education_delete' => $url.'/education/delete',
        
        'employee_by_department' => $url.'/employee_by_department',
         // analytics url
         'get_student_list_by_class_section' => $url.'/get_student_list/by_class_section',
         'get_attendance_late_graph' => $url.'/get_attendance_late_graph',
         'get_homework_graph_by_student' => $url.'/get_homework_graph_by_student',
         'get_attitude_graph_by_student' => $url.'/get_attitude_graph_by_student',
         'get_short_test_by_student' => $url.'/get_short_test_by_student',
         'get_subject_average_by_student' => $url.'/get_subject_average_by_student',
         'get_exam_marks_by_student' => $url.'/get_exam_marks_by_student',
         'get_student_by_all_subjects' => $url.'/get_student_by_all_subjects',
         'get_class_section_by_student' => $url.'/get_class_section_by_student',
         // get schedule exam details calendar
         'get_schedule_exam_details' => $url.'/get_schedule_exam_details',
         'get_schedule_exam_details_by_teacher' => $url.'/get_schedule_exam_details_by_teacher',
         'get_schedule_exam_details_by_student' => $url.'/get_schedule_exam_details_by_student',
         
        'reset_password' => $url.'/reset_password',
        'reset_password_validation' => $url.'/reset_password_validation',
        'reset_password_expired_link' => $url.'/reset/password_expired_link',
        'termination_student' => $url.'/termination/student',
        'reset_expire_reset_password' => $url.'/reset/expire_reset_password',
        // notifications
        'unread_notifications' => $url.'/unread_notifications',
        'mark_as_read' => $url.'/mark_as_read',

        // transport vehicle url
        'transport_vehicle_add' => $url.'/transport_vehicle/add',
        'transport_vehicle_list' => $url.'/transport_vehicle/list',
        'transport_vehicle_details' => $url.'/transport_vehicle/transport_vehicle-details',
        'transport_vehicle_update' => $url.'/transport_vehicle/update',
        'transport_vehicle_delete' => $url.'/transport_vehicle/delete',
        // get absent late excuse
        'get_absent_late_excuse' => $url.'/get_absent_late_excuse',
        // get teacher absent  excuse
        'get_teacher_absent_excuse' => $url.'/get_teacher_absent_excuse',

        
        //group calendor url
        'get_event_group_calendor' => $url.'/get_event_group_calendor',
        'get_event_group_calendor_student' => $url.'/get_event_group_calendor_student',
        'get_event_group_calendor_parent' => $url.'/get_event_group_calendor_parent',
        'get_event_group_calendor_admin' => $url.'/get_event_group_calendor_admin',

        

        // group url
        'group_add' => $url.'/group/add',
        'group_list' => $url.'/group/list',
        'group_details' => $url.'/group/group-details',
        'group_update' => $url.'/group/update',
        'group_delete' => $url.'/group/delete',

        // hostel group url
        'hostel_group_add' => $url.'/hostel_group/add',
        'hostel_group_list' => $url.'/hostel_group/list',
        'hostel_group_details' => $url.'/hostel_group/hostel_group-details',
        'hostel_group_update' => $url.'/hostel_group/update',
        'hostel_group_delete' => $url.'/hostel_group/delete',

        //  Name url
        
        'staff_name' => $url.'/staff/name',
        'student_name' => $url.'/student/name',

        
        'get_semester_session' => $url.'/get_semester_session',
        // exam paper
        'exam_paper_add' => $url.'/exam_paper/add',
        'exam_paper_list' => $url.'/exam_paper/list',
        'exam_paper_details' => $url.'/exam_paper/exam-paper-details',
        'exam_paper_update' => $url.'/exam_paper/update',
        'exam_paper_delete' => $url.'/exam_paper/delete',
        // exam paper
        'grade_category_add' => $url.'/grade_category/add',
        'grade_category_list' => $url.'/grade_category/list',
        'grade_category_details' => $url.'/grade_category/grade-category-details',
        'grade_category_update' => $url.'/grade_category/update',
        'grade_category_delete' => $url.'/grade_category/delete',
        // get class by all subjects
        'classes_by_all_subjects' => $url.'/classes/all_subjects',
        // paper type list
        'get_paper_type' => $url.'/paper_type/list',

        
        'employee_punchcard' => $url.'/employee/punchcard',
        'employee_punchcard_check' => $url.'/employee/punchcard/check',
        // exam schedule list student,parent
        'exam_timetable_student_parent' => $url.'/exam_timetable/student_parent',
        'exam_timetable_get_student_parent' => $url.'/exam_timetable/get_student_parent',
        // exam result by class
        'exam_results_get_subject_by_class' => $url.'/exam_results/get_subject_by_class',
        // exam results by subjects
        'exam_results_get_class_by_section' => $url.'/exam_results/get_class_by_section',
        // exam results by individual
        'student_result'=>$url.'/getbyresult',
        // exam results by overall
        'tot_grade_calcu_overall'=>$url.'/tot_grade_calcu_overall',

        // absent_reason url
        'absent_reason_add' => $url.'/absent_reason/add',
        'absent_reason_list' => $url.'/absent_reason/list',
        'absent_reason_details' => $url.'/absent_reason/absent-reason-details',
        'absent_reason_update' => $url.'/absent_reason/update',
        'absent_reason_delete' => $url.'/absent_reason/delete',

        // late_reason url
        'late_reason_add' => $url.'/late_reason/add',
        'late_reason_list' => $url.'/late_reason/list',
        'late_reason_details' => $url.'/late_reason/late-reason-details',
        'late_reason_update' => $url.'/late_reason/update',
        'late_reason_delete' => $url.'/late_reason/delete',

        // excused_reason url
        'excused_reason_add' => $url.'/excused_reason/add',
        'excused_reason_list' => $url.'/excused_reason/list',
        'excused_reason_details' => $url.'/excused_reason/excused-reason-details',
        'excused_reason_update' => $url.'/excused_reason/update',
        'excused_reason_delete' => $url.'/excused_reason/delete',

        // semester url
        'semester_add' => $url.'/semester/add',
        'semester_list' => $url.'/semester/list',
        'semester_details' => $url.'/semester/semester-details',
        'semester_update' => $url.'/semester/update',
        'semester_delete' => $url.'/semester/delete',
        // academic year url
        'academic_year_add' => $url.'/academic_year/add',
        'academic_year_list' => $url.'/academic_year/list',
        'academic_year_details' => $url.'/academic_year/academic_year_details',
        'academic_year_update' => $url.'/academic_year/update',
        'academic_year_delete' => $url.'/academic_year/delete',
        // add promotion
        'get_student_by_class_section_sem_ses' => $url.'/get_student_list/by_class_section_sem_ses',
        'promotion_add' => $url.'/promotion/add',

         // global setting url
         'global_setting_add' => $url.'/global_setting/add',
         'global_setting_list' => $url.'/global_setting/list',
         'global_setting_details' => $url.'/global_setting/global_setting-details',
         'global_setting_update' => $url.'/global_setting/update',
         'global_setting_delete' => $url.'/global_setting/delete',
 
         //check class room availablity
         'class_room_check' => $url.'/class_room_check',
         // relief_assignment
         'get_all_leave_relief_assignment' => $url.'/get_all_leave_relief_assignment',
         'get_subjects_by_staff_id_with_date' => $url.'/get_subjects_by_staff_id_with_date',
         'relief_assignment_other_teacher' => $url.'/relief_assignment_other_teacher',
         'get_staff_list_by_timeslot' => $url.'/get_staff_list_by_timeslot',
         'get_calendar_details_timetable' => $url.'/get_calendar_details_timetable',


         //count
         'employee_count' => $url.'/employee_count',
         'student_count' => $url.'/student_count',
         'parent_count' => $url.'/parent_count',
         'teacher_count' => $url.'/teacher_count',
         'student_leave_count' => $url.'/student_leave_count',
 
         //all logout
         'all_logout' => $url.'/all_logout',
         'logout' => $url.'/logout',
         // copy academic to next session
         'acdemic_copy_assign_teacher' => $url.'/acdemic/copy/assign_teacher',
         'acdemic_copy_grade_assign' => $url.'/acdemic/copy/grade_assign',
         'acdemic_copy_subject_teacher_assign' => $url.'/acdemic/copy/subject_teacher_assign',
         // copy exam master to next session
         'exam_master_copy_exam_setup' => $url.'/exam_master/copy/exam_setup',
         'exam_master_copy_exam_paper' => $url.'/exam_master/copy/exam_paper',
         
         'category_list_by_soap_type' => $url.'/soap/category/list',
         'sub_category_list_by_category' => $url.'/soap/sub_category/list',
         'notes_list_by_sub_category' => $url.'/soap/filter_by_notes',
 
         //soap url
         'soap_list' => $url.'/soap/list',
         'soap_add' => $url.'/soap/add',
         'soap_delete' => $url.'/soap/delete',
         
         // soap category url
         'soap_category_add' => $url.'/soap_category/add',
         'soap_category_list' => $url.'/soap_category/list',
         'soap_category_details' => $url.'/soap_category/soap_category-details',
         'soap_category_update' => $url.'/soap_category/update',
         'soap_category_delete' => $url.'/soap_category/delete',
         
         // soap sub category url
         'soap_sub_category_add' => $url.'/soap_sub_category/add',
         'soap_sub_category_list' => $url.'/soap_sub_category/list',
         'soap_sub_category_details' => $url.'/soap_sub_category/soap_sub_category-details',
         'soap_sub_category_update' => $url.'/soap_sub_category/update',
         'soap_sub_category_delete' => $url.'/soap_sub_category/delete',
 
         // soap notes url
         'soap_notes_add' => $url.'/soap_notes/add',
         'soap_notes_list' => $url.'/soap_notes/list',
         'soap_notes_details' => $url.'/soap_notes/soap_notes-details',
         'soap_notes_update' => $url.'/soap_notes/update',
         'soap_notes_delete' => $url.'/soap_notes/delete',
         // soap subject url
         'soap_subject_add' => $url.'/soap_subject/add',
         'soap_subject_list' => $url.'/soap_subject/list',
         'soap_subject_details' => $url.'/soap_subject/soap_subject-details',
         'soap_subject_update' => $url.'/soap_subject/update',
         'soap_subject_delete' => $url.'/soap_subject/delete',
          // get exam paper results
         'get_exam_paper_res' => $url.'/get_exam_paper_results',
          // download excel
         'exam_timetable_list_download' => $url.'/exam_timetable/list/download',
         'staff_attendance_export' => $url.'/staff_attendance/export',
         'student_attendance_export' => $url.'/student_attendance/export',
         'student_attendance_export_subject' => $url.'/student_attendance/export/subject',
         'student_attendance_export_parent' => $url.'/student_attendance/export/parent',
         
         'old_soap_student_list' => $url.'/old_soap_student/list',
         'soap_student_list' => $url.'/soap_student/list',
         'student_soap_list' => $url.'/student_soap_list',

         'soap_log_list' => $url.'/soap_log/list',
         
        // payment mode url
        'payment_mode_add' => $url.'/payment_mode/add',
        'payment_mode_list' => $url.'/payment_mode/list',
        'payment_mode_details' => $url.'/payment_mode/payment_mode-details',
        'payment_mode_update' => $url.'/payment_mode/update',
        'payment_mode_delete' => $url.'/payment_mode/delete',
        
         
        // payment status url
        'payment_status_add' => $url.'/payment_status/add',
        'payment_status_list' => $url.'/payment_status/list',
        'payment_status_details' => $url.'/payment_status/payment_status-details',
        'payment_status_update' => $url.'/payment_status/update',
        'payment_status_delete' => $url.'/payment_status/delete',
        
        // fees type url
        'fees_type_add' => $url.'/fees_type/add',
        'fees_type_list' => $url.'/fees_type/list',
        'fees_type_details' => $url.'/fees_type/fees_type-details',
        'fees_type_update' => $url.'/fees_type/update',
        'fees_type_delete' => $url.'/fees_type/delete',

        // fees group url
        'fees_group_add' => $url.'/fees_group/add',
        'fees_group_list' => $url.'/fees_group/list',
        'fees_group_details' => $url.'/fees_group/fees_group-details',
        'fees_group_update' => $url.'/fees_group/update',
        'fees_group_delete' => $url.'/fees_group/delete',
        'fees_type_group' => $url.'/fees/fees_type_group',
        
        'get_student_details' => $url.'/get_student_details',
        'add_fees_allocation' => $url.'/fees/fees_allocation',
        'student_fees_history' => $url.'/fees/student_fees_history',
        'fees_allocated_students' => $url.'/fees/fees_allocated_students',
        'get_fees_allocated_students' => $url.'/fees/get_fees_allocated_students',
        'fees_details' => $url.'/fees/fees-details',
        'fees_delete' => $url.'/fees/delete',
        'fees_update' => $url.'/fees/update',
        'change_payment_mode' => $url.'/fees/change_payment_mode',
        'fee_active_tab_details' => $url.'/fees/active_tab_details',
        'fees_get_pay_mode_id' => $url.'/fees/get_pay_mode_id',
        'fees_status_check' => $url.'/fees/fees_status_check',
        // add score rank modules
        'all_exam_subject_scores' => $url.'/all_exam_subject_scores',
        'all_exam_subject_ranks' => $url.'/all_exam_subject_ranks',
        'exam_subject_mark_high_low_avg' => $url.'/exam_subject_mark_high_low_avg',
        'exam_by_student'=> $url.'/exam-by-student',
        'get_marks_by_student'=> $url.'/get-marks-by-student',
        'get_ten_student'=> $url.'/get-ten-student',

        'class_teacher_classes'=> $url.'/class_teacher_classes',
        'class_teacher_sections'=> $url.'/class_teacher_sections',

        'import_employee'=> $url.'/importcsv/employee',
        'import_parent'=> $url.'/importcsv/parent',
        'import_student'=> $url.'/importcsv/student',
        'import_child_health'=> $url.'/importcsv/child_health',
        'chat_parent_list'=> $url.'/chat/get_parent_list',
        'chat_teacher_list'=> $url.'/chat/get_teacher_list',
        'chat_group_list'=> $url.'/chat/get_group_list',
        'get_teacher_assign_parent_list'=> $url.'/chat/get_teacher_assign_parent_list',
        'chat_parentgroup_list'=> $url.'/chat/get_parentgroup_list',
        'parent_chat_teacher_list'=> $url.'/chat/parent_chat_teacher_list',
        'tchat'=> $url.'/chat/storechat',
        'pchat'=> $url.'/chat/storechat',
		    'tdelchat'=> $url.'/chat/deletechat',
        'pdelchat'=> $url.'/chat/deletechat',
        'chatlists'=> $url.'/chat/chatlist',		
        'pchatlists'=> $url.'/chat/pchatlist',	
        'groupchatlists'=> $url.'/chat/groupchatlists',
        
        'get_like_column_name'=> $url.'/get_like_column_name',
        'faq_email'=> $url.'/faq/email',
        // 2fa
        'two_fa_generate_secret_qr'=> $url.'/2fa/two_fa_generate_secret_qr',
        'two_fa_otp_valid'=> $url.'/2fa/two_fa_otp_valid',
        'update_two_fa_secret'=> $url.'/2fa/update_two_fa_secret',
        
        'get_school_type'=> $url.'/get_school_type',
        'get_home_page_details'=> $url.'/get_home_page_details',

        
        'application_add'=> $url.'/application/add',
        'application_verify'=> $url.'/application/verify',
        'application_list'=> $url.'/application/list',
        'application_details'=> $url.'/application/application-details',
        'get_application_guardian_details'=> $url.'/get_application_guardian_details',
        'application_approve'=> $url.'/application/approve',
        'application_update'=> $url.'/application/update',
        'application_delete'=> $url.'/application/delete',
        'application_email'=> $url.'/application/email',

        'application_grade_list'=> $url.'/application/grade/list',
        'application_relation_list'=> $url.'/application/relation/list',
        'application_academic_year_list'=> $url.'/application/academic_year/list',
       
        'forum_image_store'=> $url.'/forum_image_store',
        'get_languages'=> $url.'/get_languages',
        'lastlogout'=> $url.'/lastlogout',
        'chatnotification'=> $url.'/chatnotification', 
          
         // check in out time url
         'check_in_out_time_list' => $url.'/check_in_out_time/list',
         'check_in_out_time_details' => $url.'/check_in_out_time/check_in_out_time-details',
         'check_in_out_time_update' => $url.'/check_in_out_time/update',
         // holidays url
        'holidays_add' => $url.'/holidays/add',
        'holidays_list' => $url.'/holidays/list',
        'holidays_details' => $url.'/holidays/holidays-details',
        'holidays_update' => $url.'/holidays/update',
        'holidays_delete' => $url.'/holidays/delete',
        'all_student_ranking' => $url.'/all_student/ranking',
        
         // Login Activity url

        'login_activity_list' => $url.'/login_list',
        
        // bank_account url
        'bank_account_add' => $url.'/bank_account/add',
        'bank_account_list' => $url.'/bank_account/list',
        'bank_account_details' => $url.'/bank_account/bank_account-details',
        'bank_account_update' => $url.'/bank_account/update',
        'bank_account_delete' => $url.'/bank_account/delete',
        'bank_account_status' => $url.'/bank_account/status',

        // bank url
        'bank_add' => $url.'/bank/add',
        'bank_list' => $url.'/bank/list',
        'bank_details' => $url.'/bank/bank-details',
        'bank_update' => $url.'/bank/update',
        'bank_delete' => $url.'/bank/delete',
        'work_week' => $url.'/work/week',
        'work_week_get' => $url.'/work/week/get',
        'work_week_update' => $url.'/work/week/update',
        'get_public_holidays' => $url.'/get_public_holidays',
        
        'get_parent_fees_list' => $url.'/fees/get_parent_fees_list',
        'parent_fees_history' => $url.'/fees/parent_fees_history',
        'get_today_schedules_admin' => $url.'/get_today_schedules_admin',
        'get_today_schedules_teacher' => $url.'/get_today_schedules_teacher',
        'job_title_list' => $url.'/job_title/list',
        'employee_type_list' => $url.'/employee_type/list',
        'grade_list_by_departmentId' => $url.'/grade_list_by_department',
        //buletin board
        'buletin_board_list' => $url.'/buletin_board/list',
        'buletin_board_add' => $url.'/buletin_board/add',
        'buletin_board_usernames'=>$url.'/buletin_board/usernames',
        'buletin_board_delete' => $url.'/buletin_board/delete',
        'buletin_board_details' => $url.'/buletin_board/buletin_board-details',
        'buletin_board_update' => $url.'/buletin_board/update',
        'get_student_details_buletin_board' => $url.'/get_student_details_buletin_board',
        'get_parent_details_buletin_board'  => $url.'/get_parent_details_buletin_board',
        'bulletin_board_cronJob' => $url.'/bulletin_board/cronJob',

        'get_bulletin_parent' => $url.'/buletin_board/list/parent',
        'get_bulletin_imp_parent' => $url.'/buletin_board/imp_list/parent',
        'bulletin_star' => $url.'/bulletin_board/bulletin_star',

        'get_bulletin_teacher' => $url.'/buletin_board/list/teacher',
        'get_bulletin_imp_teacher' => $url.'/buletin_board/imp_list/teacher',
        'bulletin_star_teacher' => $url.'/bulletin_board/bulletin_star_teacher',

        'get_bulletin_student' => $url.'/buletin_board/list/student',
        'get_bulletin_imp_student' => $url.'/buletin_board/imp_list/student',
        'bulletin_star_student' => $url.'/bulletin_board/bulletin_star_student',

        //retired person
        'retired_list' => $url.'/retired/list',
        'leave_taken_history_by_staff' => $url.'/employee-leave/leave_taken_history_by_staff',
        'view_student_leave_details_row' => $url.'/view_student_leave_details_row',
        //add promotion bulk
        'promotion_data_bulk' => $url.'/get_student_list/promotion_data_bulk',
        'promotion_bulk_import_save' => $url.'/get_student_list/promotion_bulk_import_save',
        'promotion_bulk_student_list' => $url.'/get_student_list/promotion_bulk_student_list',
        'promotion_unassigned_student_list' => $url.'/get_student_list/promotion_unassigned_student_list',
        'promotion_termination_student_list' => $url.'/get_student_list/promotion_termination_student_list',
        'promotion_prepared_Data_add' => $url.'/get_student_list/promotion_prepared_Data_add',
        'promotion_get_data_freezed' =>  $url.'/get_student_list/promotion_get_data_freezed',
        'get_studentList_Unassigned_Freezed' => $url.'/get_student_list/get_studentList_Unassigned_Freezed',
        'promotion_Status_Data_add'=> $url.'/get_student_list/promotion_Status_Data_add',
        'promotion_Final_Data_add'=> $url.'/get_student_list/promotion_Final_Data_add',
        'promotion_download_csv'=> $url.'/get_student_list/promotion_download_csv',
        // Menu List
        'menus_list' => $url.'/menus/list',      
        'menuaccess_list' => $url.'/menus/accesslist',                     
        'addmenu' => $url.'/menus/add',                     
        'setpermission' => $url.'/menus/setpermission',        
        'menu_details' => $url.'/menus/menu_details',
        'menu_update' => $url.'/menus/update',        
        'menuaccess_permission' => $url.'/menus/getpermission', 
        'get_login_menuroute' => $url.'/menus/get_login_menuroute', 

        // event type url
        'school_role_add' => $url.'/school_role/add',
        'school_role_list' => $url.'/school_role/lists',
        'school_role_details' => $url.'/school_role/school_role-details',
        'school_role_update' => $url.'/school_role/update',
        'school_role_delete' => $url.'/school_role/delete',
        'portal_roles' => $url.'/school_role/portal_roles',
        

        //School Role Permissions
        'school_menurole_details' => $url.'/menus/getschool_menuroleDetails', 
        'schoolmenuaccess_list' => $url.'/menus/schoolaccesslist',       
        'setschoolpermission' => $url.'/menus/setschoolpermission',
        'getschoolroleaccess' => $url.'/menus/getschoolroleaccess', 
        'deleteschoolpermission' => $url.'/menus/deleteschoolpermission', 
        'getschoolroleaccessroute' => $url.'/menus/getschoolroleaccessroute',
        
        
        
        // email type url
        'email_type_add' => $url.'/email_type/add',
        'email_type_list' => $url.'/email_type/list',
        'email_type_details' => $url.'/email_type/email_type-details',
        'email_type_update' => $url.'/email_type/update',
        'email_type_delete' => $url.'/email_type/delete',
        
        // email template url
        'email_template_add' => $url.'/email_template/add',
        'email_template_list' => $url.'/email_template/list',
        'email_template_details' => $url.'/email_template/email_template-details',
        'email_template_update' => $url.'/email_template/update',
        'email_template_delete' => $url.'/email_template/delete',

        
        // form field url
        'form_field'=> $url.'/form_field',
        'form_field_add' => $url.'/form_field/add',
        'form_field_list' => $url.'/form_field/list',
        'form_field_details' => $url.'/form_field/form_field-details',
        'form_field_update' => $url.'/form_field/update',
        'form_field_delete' => $url.'/form_field/delete',

        
        // termination url
        'termination_add' => $url.'/termination/add',
        'termination_list' => $url.'/termination/list',
        'termination_details' => $url.'/termination/termination-details',
        'termination_update' => $url.'/termination/update',
        'termination_update_admin' => $url.'/termination/update/admin',
        'termination_delete' => $url.'/termination/delete',

        //expense
        
        'fees_expense_export' => $url.'/fees/expense/export',
        'fees_expense_update' => $url.'/fees/expense/update',
        'get_fees_expense_students' => $url.'/fees/get_fees_expense_students',
        'import_expense'=> $url.'/importcsv/expense',
        //  Exam Report
        'exam_studentslist' => $url.'/exam_result/students',
        'exam_individualstudentslist' => $url.'/exam_result/exam_individualstudentslist',
        'get_subjectlist' => $url.'/exam_result/get_subjectlist',        
        'get_mainsubjectlist' => $url.'/exam_result/get_mainsubjectlist',
        'getsubjecpapertlist' => $url.'/exam_result/getsubjecpapertlist',
        'getsem_studentattendance' => $url.'/getsem_studentattendance',
        
        'get_jsklsubjectlist' => $url.'/exam_result/get_jsklsubjectlist', 
        'getjsklexampaper_list' => $url.'/exam_result/getjsklexampaper_list',
        'examsubject_by_papers' => $url.'/examsubject-by-papers',             
        'get_subject_wise_paper_list' => $url.'/exam_result/get_subject_wise_paper_list',             

        'exam_papermarks' => $url.'/exam_result/papermark',  
        'import_exam'=> $url.'/importcsv/exam',
        'exam_student_list'=> $url.'/exam/exam_student_list',        
        'exam_file_name'=> $url.'/exam/exam_file_name',          
        'mark_comparison'=> $url.'/exam/mark_comparison',         
        'examuploadmark'=> $url.'/exam/examuploadmark',             
        'get_overallsubjectlist' => $url.'/exam_result/get_overallsubjectlist',
        'get_overallpaperlist' => $url.'/exam_result/get_overallpaperlist',
        'getpaperoverallmarklist' => $url.'/exam_result/getpaperoverallmarklist',
        
        
        'exammark-by-papers'=> $url.'/exammark-by-papers', 
        'adhocexam_file_name'=> $url.'/exam/adhocexam_file_name', 
        'adhocexam_student_list'=> $url.'/exam/adhocexam_student_list',                     
        'adhocmark_comparison'=> $url.'/exam/adhocmark_comparison',         
        'adhocexamuploadmark'=> $url.'/exam/adhocexamuploadmark',    

        'stuexam_marklist' => $url.'/exam_result/stuexam_marklist',
        'stuexam_spmarklist' => $url.'/exam_result/stuexam_spmarklist',
        'stuexam_avgmarklist' => $url.'/exam_result/stuexam_avgmarklist',
        'studentmonthly_attendance' => $url.'/exam_result/studentmonthly_attendance',        
        'getmonthlyholidays' => $url.'/getmonthlyholidays',
        'studentclasssection' => $url.'/studentclasssection',        
        'stuoverall_marklist' => $url.'/exam_result/stuoverall_marklist',        
        'stuoverall_spmarklist' => $url.'/exam_result/stuoverall_spmarklist',
        
        'studentacyear_attendance' => $url.'/exam_result/studentacyear_attendance',        
        'getacyearholidays' => $url.'/getacyearholidays',  
        
        // Student Image Upload
        
        'addstupicture'=> $url.'/student/addstupicture',
        'download_student_list_information' => $url.'/download_student_list_information',
        'get_student_attendance_by_day' => $url.'/get_student_attendance_by_day',
        'add_student_attendance_by_day' => $url.'/add_student_attendance_by_day',
        //health logBooks
        'health_logbooks' => $url.'/getHealthLogbooks',
        'health_logbooks_add' => $url.'/health_logbooks_add',
        'health_logbooks_partc_add' => $url.'/health_logbooks_partc_add',
        'health_logbook_delete' => $url.'/health_logbook_delete',
        'health_logbook_edit'  => $url.'/health_logbook_edit',
        'health_logbook_update' => $url.'/health_logbook_update',
        'health_logbook_export' => $url.'/health_logbook_export',
        'health_logbook_leave_summary' => $url.'/health_logbook_leave_summary',
        'injury_list' => $url.'/injury_list',
        'illness_list' => $url.'/illness_list',
        'healthConsult_list' => $url.'/healthConsult_list',
        //shortcut links
        'shortcutLink_add' => $url.'/shortcutLink/add',
        'shortcutLink_list' => $url.'/shortcutLink/list',
        'shortcutLink_details' => $url.'/shortcutLink/shortcutLink-details',
        'shortcutLink_update' => $url.'/shortcutLink/update',
        'shortcutLink_delete' => $url.'/shortcutLink/delete',
        'bulletinBoard_Dashboard' =>  $url.'/bulletinBoard_Dashboard',
        'bulletinBoard_teacher_Dashboard'=>  $url.'/bulletinBoard_teacher_Dashboard',
        'settings_attendance_report' => $url.'/settings_attendance_report',
        'get_settings_attendance_report' => $url.'/get_settings_attendance_report',
        'getlogmodifyusers' => $url.'/getlogmodifyusers',
        'getlogmodifytables' => $url.'/getlogmodifytables',
        'log_modifylist'=> $url.'/log_modifylist',
        'getpdf_report'=>$url.'/getpdf_report',
        'getacyeardates'=>$url.'/getacyeardates',
        //add
        'absent_attendance_report'=> $url.'/absent_attendance_report',
        'student_plan_to_leave'=> $url.'/student_plan_to_leave',
        'student_transfer_list'=> $url.'/student_transfer_list',
        'student_new_joining_list'=> $url.'/student_new_joining_list',
        'hide_unhide_dashboard'=> $url.'/hide_unhide_dashboard',
        'get_data_hide_unhide_dashboard'=> $url.'/get_data_hide_unhide_dashboard',
        'staff_leave_history_dashboard'=> $url.'/staff_leave_history_dashboard',

        //Student Personal Interview
        
        'personalinterviewstore'=> $url.'/personalinterview/store',
        'personalinterviewstore'=> $url.'/personalinterview/store',
        'getInterviewData'=> $url.'/personalinterview/data',
        'interviewstudent_list'=> $url.'/personalinterview/list',        
        'singlestudent_report'=> $url.'/personalinterview/individual',     
        'classstudent_report'=> $url.'/personalinterview/overall',
        //child health

         //student interview list
         'student_interview_list'=> $url.'/student_interview_list',
         'student_interview_add' => $url.'/student_interview_add',
         'student_interview_edit' => $url.'/student_interview_edit',
         'student_interview_update' => $url.'/student_interview_update',
         'student_interview_addComment' => $url.'/student_interview_addComment',
         'get_student_list_interview' => $url.'/get_student_list_interview',
        
        'child_health_list' => $url.'/child_health/list',
        'child_health_details' => $url.'/child_health/child_health-details',
        'child_health_export' => $url.'/child/health/export',

        
        'getec_marks' => $url.'/exam_result/getec_marks',
        'get_subject_details' => $url.'/exam_result/get_subject_details',
        'getec_teacher' => $url.'/exam_result/getec_teacher',        
        'getsubjectpapermarks' => $url.'/exam_result/getsubjectpapermark',
        'stuexam_ppmarklist' => $url.'/exam_result/stuexam_ppmarklist',        
        'stuexam_ppavgmarklist' => $url.'/exam_result/stuexam_ppavgmarklist',   
        'classteacher_principal' => $url.'/exam_result/classteacher_principal',  
        'getpaperoverallmarklist1' => $url.'/exam_result/getpaperoverallmarklist1',

        'change_user_status' => $url.'/change_user_status',
        //student Medical 
        'student_medical_record_add' => $url.'/student_medical_record_add',
        'get_student_medical_record' => $url.'/get_student_medical_record',
        'get_student_medical_record_admin' => $url.'/get_student_medical_record_admin',
        'get_allergies_name_list' => $url.'/get_allergies_name_list',
        'student_medical_report_pdf' => $url.'/student_medical_report_pdf',
        'stuexam_ppmarkchartlist' => $url.'/exam_result/stuexam_ppmarkchartlist',
        'stuexam_pptotmarkchartlist' => $url.'/exam_result/stuexam_pptotmarkchartlist',
        
      ]

];
