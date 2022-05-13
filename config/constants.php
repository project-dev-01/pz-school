<?php
$url = "http://localhost/school-management-system/public/api";
return [

    'api' => [
        // login url
        'login' => $url.'/login',
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
        'timetable_subject' => $url.'/timetable-subject',
        'exam_by_classSection'=>$url.'/exam-by-classSection',
        'exam_by_classSubject'=>$url.'/exam-by-classSubject',
        'student_result'=>$url.'/getbyresult',
        'tot_grade_calcu_byclass'=>$url.'/tot_grade_calcu_byclass',
        'tot_grade_calcu_bySubject'=>$url.'/tot_grade_calcu_bySubject',
        'tot_grade_calcu_byStudent'=>$url.'/tot_grade_calcu_byStudent',
        'tot_grade_calcu_byStdsubjectdiv'=>$url.'/tot_grade_calcu_byStdsubjectdiv',
        'tot_grade_calcu_overall'=>$url.'/tot_grade_calcu_overall',
        'tot_grade_master'=>$url.'/tot_grade_master',
        'all_exams_list'=>$url.'/all_exams_list',
        'all_std_list'=>$url.'/all_std_list',
        'all_bysubject_list'=>$url.'/all_bysubject_list',
        'get_grade_bysubject'=>$url.'/get_grade_bysubject',
        // class url
        'class_add' => $url.'/classes/add',
        'class_list' => $url.'/classes/list',
        'class_details' => $url.'/classes/class-details',
        'class_update' => $url.'/classes/update',
        'class_delete' => $url.'/classes/delete',
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

        // event url
        'event_add' => $url.'/event/add',
        'event_list' => $url.'/event/list',
        'event_details' => $url.'/event/event-details',
        'event_update' => $url.'/event/update',
        'event_delete' => $url.'/event/delete',
        'event_publish' => $url.'/event/publish',
        'branch_by_event' => $url.'/branch-by-event',
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

        'timetable_student' => $url.'/timetable/student',
        'timetable_parent' => $url.'/timetable/parent',

          // settings url
          'change_profile_picture' => $url.'/change-profile-picture',
          'change_logo' => $url.'/settings/logo',
          'get_user' => $url.'/get_user',
          'change_password' => $url.'/change-password',
          'update_profile_info' => $url.'/update-profile-info',
        // report card 
        'get_by_reportcard' => $url.'/get_by_reportcard',

        // forum url
        'forum_cpost' => $url.'/forum/createpost',   
        'forum_list' => $url.'/forum/list',
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
        
        // get attendance list
        'get_attendance_list' => $url.'/get_attendance_list',
        'get_child_subjects' => $url.'/get_child_subjects',
        'get_attendance_list_teacher' => $url.'/get_attendance_list_teacher',
        'get_reasons_by_student' => $url.'/get_reasons_by_student',
        
        
        
         // homework url
         'homework_add' => $url.'/homework/add',
         'homework_list' => $url.'/homework/list',
         'homework_details' => $url.'/homework/homework-details',
         'homework_student' => $url.'/homework/student',
         'homework_student_filter' => $url.'/homework/student/filter',
         'homework_submit' => $url.'/homework/submit',
         'homework_view' => $url.'/homework/view',
         'homework_evaluate' => $url.'/homework/evaluate',
         // calendor timetable show
         'get_timetable_calendor' => $url.'/get_timetable_calendor',
         'get_event_calendor' => $url.'/get_event_calendor',
         'get_timetable_calendor_student' => $url.'/get_timetable_calendor_student',
         'get_event_calendor_student' => $url.'/get_event_calendor_student',
         'get_event_calendor_admin' => $url.'/get_event_calendor_admin',
         

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

        // grade url
        'grade_add' => $url.'/grade/add',
        'grade_list' => $url.'/grade/list',
        'grade_details' => $url.'/grade/grade-details',
        'grade_update' => $url.'/grade/update',
        'grade_delete' => $url.'/grade/delete',
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
        

        // get transport list
        'transport_list' => $url.'/transport/list',

        // get hostel list
        'hostel_list' => $url.'/hostel/list',

        
        'vehicle_by_route' => $url.'/vehicle-by-route',
        'room_by_hostel' => $url.'/room-by-hostel',

        // adminssion url
        'admission_add' => $url.'/admission/add',
        // add_to_do_list
        'add_to_do_list' => $url.'/add_to_do_list',
        'get_to_do_list' => $url.'/get_to_do_list',
        'get_to_do_row' => $url.'/get_to_do_row',
        'delete_to_do_list' => $url.'/delete_to_do_list',
        'get_to_do_list_dashboard' => $url.'/get_to_do_list_dashboard',
        'read_update_todo' => $url.'/read_update_todo',
        'get_assign_class' => $url.'/get_assign_class',
        'to_do_comments' => $url.'/to_do_comments',
        'get_to_do_teacher' => $url.'/get_to_do_teacher',

        // Student Url
        'student_list' => $url.'/student/list',
        'student_details' => $url.'/student/student-details',
        'student_update' => $url.'/student/update',
        'student_delete' => $url.'/student/delete',

        //Parent Url
        'parent_add' => $url.'/parent/add',
        'parent_list' => $url.'/parent/list',
        'parent_details' => $url.'/parent/parent-details',
        'parent_update' => $url.'/parent/update',
        'parent_delete' => $url.'/parent/delete',
        // get_all_teacher_list
        'get_all_teacher_list' => $url.'/get_all_teacher_list',

        'get_homework_list_dashboard' => $url.'/get_homework_list_dashboard',
        'get_test_score_dashboard' => $url.'/get_test_score_dashboard',

        // parent id wise get student
        'get_students_parentdashboard' => $url.'/get_students_parentdashboard',
        //student leave apply 
        'std_leave_apply'=> $url.'/std_leave_apply',
        // get student leaves
        'get_student_leaves'=> $url.'/get_student_leaves',
        // get leave reasons
        'get_leave_reasons'=>$url.'/get_leave_reasons',
        // get student leave list particular
        'studentleave_list'=>$url.'/studentleave_list',
        // teacher leave approve
        'teacher_leave_approve'=>$url.'/teacher_leave_approve',
    ]

];
