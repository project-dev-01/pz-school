<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('absent_reasons', function (Blueprint $table) {
            $table->index(['id', 'name']);
        });

        Schema::table('academic_year', function (Blueprint $table) {
            $table->index(['id', 'name']);
        });
		 Schema::table('banks', function (Blueprint $table) {
            $table->index(['id', 'name']);
        });
		 Schema::table('calendors', function (Blueprint $table) {
            $table->index(['id', 'title']);
        });
		 Schema::table('chats', function (Blueprint $table) {
            $table->index(['id', 'chat_fromname', 'chat_fromuser', 'chat_content']);
        });
		Schema::table('check_in_out_time', function (Blueprint $table) {
            $table->index(['id', 'check_in', 'check_out']);
        });
		 Schema::table('classes', function (Blueprint $table) {
            $table->index(['id', 'name', 'short_name', 'name_numeric']);
        });
		 Schema::table('educations', function (Blueprint $table) {
            $table->index(['id', 'name']);
        });
		 Schema::table('email_template', function (Blueprint $table) {
            $table->index(['id', 'subject', 'template_body']);
        }); 
		Schema::table('email_types', function (Blueprint $table) {
            $table->index(['id', 'name']);
        });
		Schema::table('employee_types', function (Blueprint $table) {
            $table->index(['id', 'name']);
        });
		Schema::table('emp_department', function (Blueprint $table) {
            $table->index(['id', 'name']);
        });
		Schema::table('events', function (Blueprint $table) {
            $table->index(['id', 'title']);
        });
		 Schema::table('event_types', function (Blueprint $table) {
            $table->index(['id', 'name', 'color']);
        }); 
		Schema::table('exam', function (Blueprint $table) {
            $table->index(['id', 'name']);
        });
		 Schema::table('exam_hall', function (Blueprint $table) {
            $table->index(['id', 'hall_no', 'no_of_seats']);
        }); 
		 Schema::table('exam_papers', function (Blueprint $table) {
            $table->index(['id', 'paper_name', 'score_type', 'subject_weightage']);
        });
		Schema::table('exam_term', function (Blueprint $table) {
            $table->index(['id', 'name']);
        });
		Schema::table('excused_reasons', function (Blueprint $table) {
            $table->index(['id', 'name']);
        });
		 Schema::table('fees_group', function (Blueprint $table) {
            $table->index(['id', 'name', 'description']);
        });
		Schema::table('fees_type', function (Blueprint $table) {
            $table->index(['id', 'name']);
        });
		Schema::table('grade_category', function (Blueprint $table) {
            $table->index(['id', 'name']);
        });
		Schema::table('grade_marks', function (Blueprint $table) {
            $table->index(['id', 'min_mark', 'max_mark']);
        });
		Schema::table('groups', function (Blueprint $table) {
            $table->index(['id', 'name']);
        });
		Schema::table('guest', function (Blueprint $table) {
            $table->index(['id', 'name', 'email']);
        });
		Schema::table('health_logbooks_attend_healthcare', function (Blueprint $table) {
            $table->index(['id', 'name']);
        });
		Schema::table('health_logbooks_health_consult', function (Blueprint $table) {
            $table->index(['id', 'target', 'health_treatment']);
        });
		Schema::table('health_logbooks_illness', function (Blueprint $table) {
            $table->index(['id', 'illness_name', 'illness_treatment']);
        });
		Schema::table('holidays', function (Blueprint $table) {
            $table->index(['id', 'name']);
        });
		Schema::table('homeworks', function (Blueprint $table) {
            $table->index(['id', 'title']);
        });
		Schema::table('hostel', function (Blueprint $table) {
            $table->index(['id', 'name']);
        });
		Schema::table('hostel_block', function (Blueprint $table) {
            $table->index(['id', 'block_name']);
        });
		Schema::table('hostel_category', function (Blueprint $table) {
            $table->index(['id', 'name']);
        });
		Schema::table('hostel_floor', function (Blueprint $table) {
            $table->index(['id', 'floor_name']);
        });
		Schema::table('hostel_groups', function (Blueprint $table) {
            $table->index(['id', 'name']);
        });
		Schema::table('hostel_room', function (Blueprint $table) {
            $table->index(['id', 'name']);
        });
		Schema::table('job_title', function (Blueprint $table) {
            $table->index(['id', 'name']);
        });
		Schema::table('language', function (Blueprint $table) {
            $table->index(['id', 'name']);
        });
		Schema::table('late_reasons', function (Blueprint $table) {
            $table->index(['id', 'name']);
        });
		Schema::table('parent', function (Blueprint $table) {
            $table->index(['first_name', 'last_name','mobile_no','email']);
        });
		Schema::table('staffs', function (Blueprint $table) {
            $table->index(['first_name', 'last_name','mobile_no','email']);
        });
		Schema::table('student_applications', function (Blueprint $table) {
            $table->index(['first_name', 'last_name','register_number','email']);
        });
		Schema::table('students', function (Blueprint $table) {
            $table->index(['first_name', 'last_name','register_no','roll_no','email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absent_reasons', function (Blueprint $table) {
            $table->dropIndex(['id', 'name']);
        });

        Schema::table('academic_year', function (Blueprint $table) {
            $table->dropIndex(['id', 'name']);
        });
		 Schema::table('banks', function (Blueprint $table) {
            $table->dropIndex(['id', 'name']);
        });
		 Schema::table('calendors', function (Blueprint $table) {
            $table->dropIndex(['id', 'title']);
        });
		 Schema::table('chats', function (Blueprint $table) {
            $table->dropIndex(['id', 'chat_fromname', 'chat_fromuser', 'chat_content']);
        });
		Schema::table('check_in_out_time', function (Blueprint $table) {
            $table->dropIndex(['id', 'check_in', 'check_out']);
        });
		 Schema::table('classes', function (Blueprint $table) {
            $table->dropIndex(['id', 'name', 'short_name', 'name_numeric']);
        });
		 Schema::table('educations', function (Blueprint $table) {
            $table->dropIndex(['id', 'name']);
        });
		 Schema::table('email_template', function (Blueprint $table) {
            $table->dropIndex(['id', 'subject', 'template_body']);
        }); 
		Schema::table('email_types', function (Blueprint $table) {
            $table->dropIndex(['id', 'name']);
        });
		Schema::table('employee_types', function (Blueprint $table) {
            $table->dropIndex(['id', 'name']);
        });
		Schema::table('emp_department', function (Blueprint $table) {
            $table->dropIndex(['id', 'name']);
        });
		Schema::table('events', function (Blueprint $table) {
            $table->dropIndex(['id', 'title']);
        });
		 Schema::table('event_types', function (Blueprint $table) {
            $table->dropIndex(['id', 'name', 'color']);
        }); 
		Schema::table('exam', function (Blueprint $table) {
            $table->dropIndex(['id', 'name']);
        });
		 Schema::table('exam_hall', function (Blueprint $table) {
            $table->dropIndex(['id', 'hall_no', 'no_of_seats']);
        }); 
		 Schema::table('exam_papers', function (Blueprint $table) {
            $table->dropIndex(['id', 'paper_name', 'score_type', 'subject_weightage']);
        });
		Schema::table('exam_term', function (Blueprint $table) {
            $table->dropIndex(['id', 'name']);
        });
		Schema::table('excused_reasons', function (Blueprint $table) {
            $table->dropIndex(['id', 'name']);
        });
		 Schema::table('fees_group', function (Blueprint $table) {
            $table->dropIndex(['id', 'name', 'description']);
        });
		Schema::table('fees_type', function (Blueprint $table) {
            $table->dropIndex(['id', 'name']);
        });
		Schema::table('grade_category', function (Blueprint $table) {
            $table->dropIndex(['id', 'name']);
        });
		Schema::table('grade_marks', function (Blueprint $table) {
            $table->dropIndex(['id', 'min_mark', 'max_mark']);
        });
		Schema::table('groups', function (Blueprint $table) {
            $table->dropIndex(['id', 'name']);
        });
		Schema::table('guest', function (Blueprint $table) {
            $table->dropIndex(['id', 'name', 'email']);
        });
		Schema::table('health_logbooks_attend_healthcare', function (Blueprint $table) {
            $table->dropIndex(['id', 'name']);
        });
		Schema::table('health_logbooks_health_consult', function (Blueprint $table) {
            $table->dropIndex(['id', 'target', 'health_treatment']);
        });
		Schema::table('health_logbooks_illness', function (Blueprint $table) {
            $table->dropIndex(['id', 'illness_name', 'illness_treatment']);
        });
		Schema::table('holidays', function (Blueprint $table) {
            $table->dropIndex(['id', 'name']);
        });
		Schema::table('homeworks', function (Blueprint $table) {
            $table->dropIndex(['id', 'title']);
        });
		Schema::table('hostel', function (Blueprint $table) {
            $table->dropIndex(['id', 'name']);
        });
		Schema::table('hostel_block', function (Blueprint $table) {
            $table->dropIndex(['id', 'block_name']);
        });
		Schema::table('hostel_category', function (Blueprint $table) {
            $table->dropIndex(['id', 'name']);
        });
		Schema::table('hostel_floor', function (Blueprint $table) {
            $table->dropIndex(['id', 'floor_name']);
        });
		Schema::table('hostel_groups', function (Blueprint $table) {
            $table->dropIndex(['id', 'name']);
        });
		Schema::table('hostel_room', function (Blueprint $table) {
            $table->dropIndex(['id', 'name']);
        });
		Schema::table('job_title', function (Blueprint $table) {
            $table->dropIndex(['id', 'name']);
        });
		Schema::table('language', function (Blueprint $table) {
            $table->dropIndex(['id', 'name']);
        });
		Schema::table('late_reasons', function (Blueprint $table) {
            $table->dropIndex(['id', 'name']);
        });
		Schema::table('late_reasons', function (Blueprint $table) {
            $table->dropIndex(['id', 'name']);
        });
		Schema::table('parent', function (Blueprint $table) {
            $table->dropIndex(['first_name', 'last_name','mobile_no','email']);
        });
		Schema::table('staffs', function (Blueprint $table) {
            $table->dropIndex(['first_name', 'last_name','mobile_no','email']);
        });
		Schema::table('student_applications', function (Blueprint $table) {
            $table->dropIndex(['first_name', 'last_name','register_number','email']);
        });
		Schema::table('students', function (Blueprint $table) {
            $table->dropIndex(['first_name', 'last_name','register_no','roll_no','email']);
        });
    }
};
