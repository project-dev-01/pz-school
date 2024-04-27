<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                2020 - {{ now()->year }} &copy; by <a href="https://paxsuzen.com">Paxsuzen</a>
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->

</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->


</div>
<!-- END wrapper -->

<!-- Vendor js -->
<script src="{{ asset('js/vendor.min.js') }}"></script>
@if(Session::get('role_id') == '1')
<script>
    var backToLogin = "{{ route('super_admin.login') }}";
    var logoutIdle = "{{ route('super_admin.logout') }}";
</script>
@elseif(Session::get('role_id') == '3')
<script>
    var backToLogin = "{{ route('staff.login') }}";
    var logoutIdle = "{{ route('staff.logout') }}";
</script>
@elseif(Session::get('role_id') == '4')
<script>
    var backToLogin = "{{ route('teacher.login') }}";
    var logoutIdle = "{{ route('teacher.logout') }}";
</script>
@elseif(Session::get('role_id') == '5')
<script>
    var backToLogin = "{{ route('parent.login') }}";
    var logoutIdle = "{{ route('parent.logout') }}";
</script>
@elseif(Session::get('role_id') == '6')
<script>
    var backToLogin = "{{ route('student.login') }}";
    var logoutIdle = "{{ route('student.logout') }}";
</script>
@else
<script>
    var backToLogin = "{{ route('admin.login') }}";
    var logoutIdle = "{{ route('admin.logout') }}";
</script>
@endif
<script>
    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;

        return [year, month, day].join('-');
    }
</script>
@if(Session::get('role_id'))
@if(Session::get('role_id') == '5')
<script>
    // update child session
    var updateChildSessionID = "{{ route('navbar.update.child_id') }}";

    var childData = {!!json_encode(Session::get('all_child', [])) !!};

    function showStudentName() {
        // Check screen width
        if (window.innerWidth > 768) { // Adjust the breakpoint as needed
            var studentId = "{{ Session::get('student_id') }}";
            var studentName = document.getElementById('studentName');

            for (var i = 0; i < childData.length; i++) {
                if (childData[i].id == studentId) {
                    studentName.setAttribute('data-original-title', childData[i].name);
                    $(studentName).tooltip('show'); // Show the tooltip
                    break;
                }
            }
        }
    }

    function hideStudentName() {
        // Check screen width
        if (window.innerWidth > 768) { // Adjust the breakpoint as needed
            var studentName = document.getElementById('studentName');
            studentName.removeAttribute('data-original-title'); // Remove the title attribute
            $(studentName).tooltip('hide'); // Hide the tooltip
        }
    }
</script>
@endif
@endif

<script src="{{ asset('js/app.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/custom/common.js') }}"></script>

<!-- <script src="{{ asset('date-picker/jquery-ui.js') }}"></script> -->
<script>
    var token = "{{ Session::get('token') }}";
    // toastr.options.preventDuplicates = true;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + token
        }
    });
    // get states
   
    var get_roll_id = "{{Session::get('role_id')}}";
    if(get_roll_id==1)
    {
        var loginurl = "{{ config('constants.api.superadmin_login') }}";  
    }
    else if(get_roll_id==2)
    {
        var loginurl = "{{ config('constants.api.admin_login') }}";  
    }
    else if(get_roll_id==3)
    {
        var loginurl = "{{ config('constants.api.staff_login') }}";  
    }
    else if(get_roll_id==4)
    {
        var loginurl = "{{ config('constants.api.teacher_login') }}";  
    }
    else if(get_roll_id==5)
    {
        var loginurl = "{{ config('constants.api.parent_login') }}";  
    }
    else if(get_roll_id==6)
    {
        var loginurl = "{{ config('constants.api.student_login') }}";  
    }
    else if(get_roll_id==7)
    {
        var loginurl = "{{ config('constants.api.guest_login') }}";  
    }
    else
    {
        var loginurl = "{{ config('constants.api.homepage') }}";  
    }
    var getStates = "{{ config('constants.api.states') }}";
    var getCity = "{{ config('constants.api.cities') }}";
    var branchByClass = "{{ config('constants.api.branch_by_class') }}";
    var branchBySection = "{{ config('constants.api.branch_by_section') }}";

    var token = "{{ Session::get('token') }}";
    var ref_user_id = "{{ Session::get('ref_user_id') }}";
    var branchID = "{{ Session::get('branch_id') }}";
    var userID = "{{ Session::get('user_id') }}";
    var studentID = "{{ Session::get('student_id') }}";


    var select_employee = "{{ __('messages.select_employee') }}";
    var select_bank = "{{ __('messages.select_bank') }}";
    var all_lang = "{{ __('messages.all') }}";
    var remove = "{{ __('messages.remove') }}";
    var drag_and_drop_to_replace = "{{ __('messages.drag_and_drop_to_replace') }}";
    var drag_and_drop_to_check = "{{ __('messages.drag_and_drop_to_check') }}";
    var oops_went_wrong = "{{ __('messages.oops_went_wrong') }}";
    var no_data_available = "{{ __('messages.no_data_available') }}";
    var filter_from_total_entries = "{{ __('messages.filter_from_total_entries') }}";
    var no_matching_records_found = "{{ __('messages.no_matching_records_found') }}";
    var showing_zero_entries = "{{ __('messages.showing_zero_entries') }}";
    var showing_entries = "{{ __('messages.showing_entries') }}";
    var show_entries = "{{ __('messages.show_entries') }}";
    var datatable_search = "{{ __('messages.datatable_search') }}";
    var show = "{{ __('messages.show') }}";
    var entries = "{{ __('messages.entries') }}";
    var previous = "{{ __('messages.previous') }}";
    var next = "{{ __('messages.next') }}";
    var month = "{{ __('messages.month') }}";
    var today = "{{ __('messages.today') }}";
    var week = "{{ __('messages.week') }}";
    var work_week = "{{ __('messages.work_week') }}";
    var day = "{{ __('messages.day') }}";
    var list = "{{ __('messages.list') }}";
    var calendar_lable_list = "{{ __('messages.calendar_lable_list') }}";
    var locale = "{{ Session::get('locale') }}";
    var calLang = "{{ __('messages.calendar_lang') }}";
    var downloadcsv = "{{ __('messages.download_csv') }}";
    var downloadpdf = "{{ __('messages.download_pdf') }}";
    var select_class = "{{ __('messages.select_class') }}";
    var select_section = "{{ __('messages.select_section') }}";
    var select_subject = "{{ __('messages.select_subject') }}";
    var select_teacher = "{{ __('messages.select_teacher') }}";
    var select_paper = "{{ __('messages.select_paper') }}";
    var select_student = "{{ __('messages.select_student') }}";
    var select_exam = "{{ __('messages.select_exam') }}";
    var select_reason = "{{ __('messages.select_reason') }}";
    var select_status = "{{ __('messages.select_status') }}";
    var select_state = "{{ __('messages.select_state') }}";
    var select_city = "{{ __('messages.select_city') }}";
    var select_type = "{{ __('messages.select_type') }}";
    var select_floor = "{{ __('messages.select_floor') }}";
    var select_hall = "{{ __('messages.select_hall') }}";
    var select_department = "{{ __('messages.select_department') }}";
    var select_designation = "{{ __('messages.select_designation') }}";
    var select_employee_type = "{{ __('messages.select_employee_type') }}";
    var select = "{{ __('messages.select') }}";
    var choose = "{{ __('messages.choose') }}";
    var add_remarks = "{{ __('messages.add_remarks') }}";
    var update = "{{ __('messages.update') }}";
    var untaken = "{{ __('messages.untaken') }}";
    var taken = "{{ __('messages.taken') }}";
    var total_strength = "{{ __('messages.total_strength') }}";
    var subject_average = "{{ __('messages.subject_average') }}";
    var average = "{{ __('messages.average') }}";
    var sl_no_lang = "{{ __('messages.s.no') }}";
    var mark_lang = "{{ __('messages.mark') }}";
    var grade_lang = "{{ __('messages.grade') }}";
    var select_grade = "{{ __('messages.select_grade') }}";
    var class_lang = "{{ __('messages.class') }}";
    var student_name_lang = "{{ __('messages.student_name') }}";
    var subject_name_lang = "{{ __('messages.subject_name') }}";
    var total_student_lang = "{{ __('messages.total_student') }}";
    var total_students_lang = "{{ __('messages.total_students') }}";
    var present_students_lang = "{{ __('messages.present_students') }}";
    var absent_students_lang = "{{ __('messages.absent_students') }}";
    var status_lang = "{{ __('messages.status') }}";
    var remarks_lang = "{{ __('messages.remarks') }}";
    var no_of_present_lang = "{{ __('messages.no_of_present') }}";
    var no_of_absent_lang = "{{ __('messages.no_of_absent') }}";
    var no_of_late_lang = "{{ __('messages.no_of_late') }}";
    var total_school_days_lang = "{{ __('messages.total_school_days') }}";
    var total_holidays_lang = "{{ __('messages.total_holidays') }}";
    var class_teacher_name_lang = "{{ __('messages.class_teacher_name') }}";
    var subject_teacher_name_lang = "{{ __('messages.subject_teacher_name') }}";
    var pass_lang = "{{ __('messages.pass') }}";
    var g_lang = "{{ __('messages.g') }}";
    var gpa_lang = "{{ __('messages.gpa') }}";
    var name_lang = "{{ __('messages.name') }}";
    var roll_no_lang = "{{ __('messages.roll_no') }}";
    var dob_lang = "{{ __('messages.DOB') }}";
    var present_lang = "{{ __('messages.present') }}";
    var absent_lang = "{{ __('messages.absent') }}";
    var name_english_lang = "{{ __('messages.name_english') }}";
    var reason_lang = "{{ __('messages.reason') }}";
    var holiday_lang = "{{ __('messages.holiday') }}";
    var late_lang = "{{ __('messages.late') }}";
    var excused_lang = "{{ __('messages.excused') }}";
    var current_month_lang = "{{ __('messages.current_month') }}";
    var engaging_lang = "{{ __('messages.engaging') }}";
    var hyperactive_lang = "{{ __('messages.hyperactive') }}";
    var quiet_lang = "{{ __('messages.quiet') }}";
    var sleepy_lang = "{{ __('messages.sleeply') }}";
    var uninterested_lang = "{{ __('messages.uninterested') }}";
    var attitude_lang = "{{ __('messages.attitude') }}";
    var all_subject_lang = "{{ __('messages.all_subject') }}";
    var homework_list_lang = "{{ __('messages.homework_list') }}";
    var complete_lang = "{{ __('messages.complete') }}";
    var incomplete_lang = "{{ __('messages.incomplete') }}";
    var late_submission_lang = "{{ __('messages.late_submission') }}";
    var short_test_name_lang = "{{ __('messages.short_test_name') }}";
    var checked_lang = "{{ __('messages.checked') }}";
    var unchecked_lang = "{{ __('messages.unchecked') }}";
    var no_events_to_display_lang = "{{ __('messages.no_events_to_display') }}";
    var approve_lang = "{{ __('messages.approve') }}";
    var reject_lang = "{{ __('messages.reject') }}";
    var pending_lang = "{{ __('messages.pending') }}";
    var upload_lang = "{{ __('messages.upload') }}";
    var allday_lang = "{{ __('messages.all-day') }}";
    var exam_lang = "{{ __('messages.exam') }}";
    var fail_lang = "{{ __('messages.fail') }}";
    var inprogress_lang = "{{ __('messages.inprogress') }}";
    var select_category = "{{ __('messages.select_category') }}";
    var select_sub_category = "{{ __('messages.select_sub_category') }}";
    var class_start_lang = "{{ __('messages.class_start') }}";
    var class_end_lang = "{{ __('messages.class_end') }}";
    var assign_to_lang = "{{ __('messages.assign_to') }}";
    var action_lang = "{{ __('messages.action') }}";
    var total_lang = "{{ __('messages.total') }}";
    var excused_lang = "{{ __('messages.excused') }}";
    var session_lang = "{{ __('messages.session') }}";
    var morning_lang = "{{ __('messages.morning') }}";
    var yearly_lang = "{{ __('messages.yearly') }}";
    var semester_lang = "{{ __('messages.semester') }}";
    var monthly_lang = "{{ __('messages.monthly') }}";
    var education_lang = "{{ __('messages.education') }}";
    var nationality_lang = "{{ __('messages.nationality') }}";
    var occupation_lang = "{{ __('messages.occupation') }}";
    var income_lang = "{{ __('messages.income') }}";
    var address_1_lang = "{{ __('messages.address_1') }}";
    var address_2_lang = "{{ __('messages.address_2') }}";
    var city_lang = "{{ __('messages.city') }}";
    var post_code_lang = "{{ __('messages.post_code') }}";
    var state_lang = "{{ __('messages.state') }}";
    var country_lang = "{{ __('messages.country') }}";
    var mobile_no_lang = "{{ __('messages.mobile_no') }}";
    var race_lang = "{{ __('messages.race') }}";
    var religion_lang = "{{ __('messages.religion') }}";
    var blood_group_lang = "{{ __('messages.blood_group') }}";
    var nric_lang = "{{ __('messages.nric') }}";
    var passport_lang = "{{ __('messages.passport_number') }}";
    var passport_expiry_date_lang = "{{ __('messages.passport_expiry_date') }}";
    var passport_photo_lang = "{{ __('messages.passport_photo') }}";
    var visa_number_lang = "{{ __('messages.visa_number') }}";
    var visa_expiry_date_lang = "{{ __('messages.visa_expiry_date') }}";
    var visa_photo_lang = "{{ __('messages.visa_photo') }}";
    var AttendanceReportLabel = "{{ __('messages.AttendanceReport') }}";
    var addWidgetH = "{{ __('messages.add_widget') }}";
    var leave_type_lang = "{{ __('messages.leave_type') }}";
    var department_lang = "{{ __('messages.department_name') }}";
    var employee_name_lang = "{{ __('messages.employee_name') }}";
    var entitlement_lang = "{{ __('messages.entitlement') }}";
    var taken_lang = "{{ __('messages.taken') }}";
    var balance_lang = "{{ __('messages.balance') }}";
    var warden_name_lang = "{{ __('messages.choose_the_warden_name') }}";
    var choose_lang = "{{ __('messages.choose') }}";

    // academic_session_id
    var academic_session_id = "{{ Session::get('academic_session_id') }}";
    var language_name = "{{ Session::get('language_name') }}";
    var locale_lang = "{{ Cookie::get('locale') }}";
    var employee_check_in_time = "{{ Session::get('check_in_time') }}";
    var employee_check_out_time = "{{ Session::get('check_out_time') }}";
    // branch details
    var branchList = "{{ route('branch.list') }}";
    var branchShow = "{{ route('branch.index') }}";
    var deleteBranch = "{{ route('branch.delete') }}";
    // assign teacher routes
    var branchbyAssignTeacher = "{{ config('constants.api.branch_by_assign_teacher') }}";
    var getsectionAllocation = "{{ config('constants.api.section_by_class') }}";
    // Event details
    var branchByEvent = "{{ config('constants.api.branch_by_event') }}";
    // greeding
    var updateGreddingSession = "{{ route('greetting.session') }}";
    // users routes
    var userList = "{{ route('users.user_list') }}";
    var userShow = "{{ route('users.user') }}";
    var deleteUser = "{{ route('users.delete') }}";

    //forum permission
    var getuserid = "{{config('constants.api.dbvsgetbranchid')}}";
    // notifications
    var readNotifications = "{{ config('constants.api.mark_as_read') }}";
    var allNotifications = "{{ route('unread_notifications') }}";
    var remainderallNotifications = "{{ route('remainder_notifications') }}";
    var allLogout = "{{ route('all_logout') }}";
</script>

<script>
    function sendMarkRequest(id = null) {
        return $.ajax(readNotifications, {
            method: 'POST',
            data: {
                token,
                id
            },
            success: function(res) {
                // console.log("eror")
                // console.log(err)
            },
            error: function(err) {
                // console.log("eror")
                // console.log(err)
            }
        });
    }
    $(document).ready(function() {

        // $('.notification-list-show').css('display', 'none');

        // var sTimeOut = setInterval(function() {
        //     getNotifications();
        // }, 2000);

        var sTimeOut = setInterval(function() {
            $.ajax({
                type: 'GET',
                url: allLogout,
                success: function(res) {
                    if (res.success) {
                        // toastr.error('Logout Successfully');
                        setTimeout(function() {
                            logoutFunc();
                        }, 1000);
                    }
                },
                error: function(err) {
                    console.log("setInterval logout error");
                    console.log(err)
                    // window.location.href =loginurl;
                    
                }
            });
        }, 8000);
        var lastlogout = "{{ route('lastlogout') }}";
        var chatnotification = "{{ route('ChatNotification') }}";
        var sTimeOutq = setInterval(function() {


            $.ajax({
                type: 'GET',
                url: lastlogout,

                success: function(res) {
                    if (res.success) {
                        // alert(res.data);// toastr.error('Logout Successfully');

                    }
                },
                error: function(err) {
                    // console.log("logout error");
                    // console.log(err)
                }
            });
        }, 10000);
        if (get_roll_id == '4' || get_roll_id == '5') {
            var sTimeOutq = setInterval(function() {


                $.ajax({
                    type: 'GET',
                    url: chatnotification,

                    success: function(res) {
                        if (res.success) {

                            //alert(res.data);
                            $('.chat-count').html(res.data[0].count_row);
                        }
                    },
                    error: function(err) {
                        // console.log("logout error");
                        // console.log(err)
                    }
                });
            }, 10000);
        }
        getNotifications();

        function getNotifications() {
            $.ajax({
                type: 'GET',
                url: allNotifications,
                success: function(res) {
                    $(".notification-list-show").html(res.notificationlist);
                    $(".badge-count").text(res.count);
                },
                error: function(err) {
                    // console.log("eror")
                    // console.log(err)
                }
            });
        }
        remainderNotifications();

        function remainderNotifications() {
            $.ajax({
                type: 'GET',
                url: remainderallNotifications,
                success: function(res) {
                    $(".remainder-list-show").html(res.notificationlist);
                    $(".remainder-badge-count").text(res.count);
                },
                error: function(err) {
                    console.log("eror")
                    console.log(err)
                }
            });
        }
        // martk as to read
        $(document).on('click', '.mark-as-read', function() {
            let request = sendMarkRequest($(this).data('id'));
            request.done(() => {
                getNotifications();
            });
        });
        // martk all read
        $(document).on('click', '#mark-all-read', function() {
            let request = sendMarkRequest();
            request.done(() => {
                getNotifications();
            })
        });
    });
</script>
<!-- logoutModal.blade.php -->

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Logout Warning</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Your session is about to expire in <span id="countdownTimer"></span> seconds due to inactivity. Do you want to stay logged in?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Stay Logged In</button>
                <!-- <button type="button" class="btn btn-primary" id="logoutButton">Logout</button> -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        var IDLE_TIMEOUT = 1500; // seconds
        var _idleSecondsTimer = null;
        var _idleSecondsCounter = 0;
        var countdownInterval = null;
        var countdownTime = IDLE_TIMEOUT;

        document.onclick = function() {
            _idleSecondsCounter = 0;
            resetCountdown();
        };

        // document.onmousemove = function() {
        //     _idleSecondsCounter = 0;
        //     resetCountdown();
        // };

        // document.onkeypress = function() {
        //     _idleSecondsCounter = 0;
        //     resetCountdown();
        // };

        _idleSecondsTimer = window.setInterval(checkIdleTime, 1000);
        startCountdown();

        function checkIdleTime() {
            _idleSecondsCounter++;
            if (_idleSecondsCounter >= IDLE_TIMEOUT) {
                window.clearInterval(_idleSecondsTimer);
                $('#logoutModal').modal('show');
            }
        }

        function startCountdown() {
            countdownInterval = setInterval(updateCountdown, 1000);
        }

        function resetCountdown() {
            countdownTime = IDLE_TIMEOUT;
        }

        function updateCountdown() {
            if (countdownTime > 0) {
                $('#countdownTimer').text(countdownTime);
                if (countdownTime === 15) {
                    $('#logoutModal').modal('show');
                }
                countdownTime--;
            } else {
                // $('#logoutModal').modal('hide');
                logoutFunc();
            }
        }


        $('#logoutButton').click(function() {
            logoutFunc();
        });

        // function logoutFunc() {
        //     // Perform logout action here
        //     // This function should handle logout logic
        //     // For example, redirect the user to the logout route
        //     window.location.href = '/logout';
        // }

        // $(document).ready(function() {
        //     var IDLE_TIMEOUT = 60; //seconds
        //     var _idleSecondsTimer = null;
        //     var _idleSecondsCounter = 0;
        //     document.onclick = function() {
        //         _idleSecondsCounter = 0;
        //     };

        //     document.onmousemove = function() {
        //         _idleSecondsCounter = 0;
        //     };

        //     document.onkeypress = function() {
        //         _idleSecondsCounter = 0;
        //     };

        //     _idleSecondsTimer = window.setInterval(CheckIdleTime, 1000);

        //     function CheckIdleTime() {
        //         _idleSecondsCounter++;
        //         if (_idleSecondsCounter >= IDLE_TIMEOUT) {
        //             window.clearInterval(_idleSecondsTimer);
        //             logoutFunc();
        //         }
        //     }
        // });
    });

    function logoutFunc() {
        var formData = new FormData();
        formData.append("idle_timeout", "idle_timeout");
        $.ajax({
            cache: false,
            url: logoutIdle,
            data: formData,
            method: "post",
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function(response) {
                window.location.href = response.redirect_url;
            },
            error: function(err) {
                console.log("'''logut error'''")
                console.log(err);
                // if (response.status === 419) {
                //     // CSRF token mismatch, handle the error here
                //     // You can refresh the page or show an error message
                //     alert('419');
                // } else {
                //     // Handle other errors
                //     alert('in else');
                // }
            }
        });
    }
    // active class scroll sticky
    $(document).ready(function() {
        $('ul#side-menu li a.active').parent().attr('id', 'scrollToView');
		var elementstv = document.getElementById('scrollToView');
		if (elementstv) {
			elementstv.scrollIntoView();
		}
        
    });
</script>