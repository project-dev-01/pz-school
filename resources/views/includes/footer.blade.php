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
</script>
@endif
@endif

<script src="{{ asset('js/app.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

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
    var class_lang = "{{ __('messages.class') }}";
    var student_name_lang = "{{ __('messages.student_name') }}";
    var subject_name_lang = "{{ __('messages.subject_name') }}";
    var total_student_lang = "{{ __('messages.total_student') }}";
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


    // settings url
    // var profileUpdateStg = "{{ config('constants.api.change_profile_picture') }}";
    // var updateSettingSession = "{{ route('settings.updateSettingSession') }}";
    // var profilePath = "{{ asset('users/images') }}";
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

<script type="text/javascript">
    var url = "{{ route('changeLang') }}";
    // var langArray = [];
    // $('.vodiapicker option').each(function() {
    //     var img = $(this).attr("data-thumbnail");
    //     var text = this.innerText;
    //     var value = $(this).val();
    //     var item = '<li><img src="' + img + '" alt="" value="' + value + '"/><span>' + text + '</span></li>';
    //     langArray.push(item);
    // })

    // $('#a').html(langArray);

    // //Set the button value to the first el of the array
    // $('.btn-select').html(langArray[0]);
    // $('.btn-select').attr('value', 'en');

    // change button stuff on click
    $('#a li').click(function() {

        var img = $(this).find('img').attr("src");
        var value = $(this).find('img').attr('value');

        window.location.href = url + "?lang=" + value;
        var text = this.innerText;
        var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
        $('.btn-select').html(item);
        $('.btn-select').attr('value', value);
        $(".b").toggle();
    });

    $(".btn-select").click(function() {
        $(".b").toggle();
    });

    //check local storage for the lang
    if (locale_lang) {
        if (locale_lang == "japanese") {
            //find an item with value of sessionLang\
            var img = "{{ config('constants.image_url').'/common-asset/images/JPN.png' }}";
            var value = "japanese";
            var text = "日本語";
            var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
            $('.btn-select').html(item);
            $('.btn-select').attr('value', value);
        } else if (locale_lang == "malay") {
            var img = "{{ config('constants.image_url').'/common-asset/images/MAL.png' }}";
            var value = "malay";
            var text = "Malay";
            var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
            $('.btn-select').html(item);
            $('.btn-select').attr('value', value);
        } else {
            var img = "{{ config('constants.image_url').'/common-asset/images/USA.png' }}";
            var value = "en";
            var text = "English";
            var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
            $('.btn-select').html(item);
            $('.btn-select').attr('value', value);
        }
    } else if (language_name) {
        if (language_name == "japanese") {
            //find an item with value of sessionLang\
            var img = "{{ config('constants.image_url').'/common-asset/images/JPN.png' }}";
            var value = "japanese";
            var text = "日本語";
            var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
            $('.btn-select').html(item);
            $('.btn-select').attr('value', value);
        } else if (language_name == "malay") {
            var img = "{{ config('constants.image_url').'/common-asset/images/MAL.png' }}";
            var value = "malay";
            var text = "Malay";
            var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
            $('.btn-select').html(item);
            $('.btn-select').attr('value', value);
        } else {
            var img = "{{ config('constants.image_url').'/common-asset/images/USA.png' }}";
            var value = "en";
            var text = "English";
            var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
            $('.btn-select').html(item);
            $('.btn-select').attr('value', value);
        }
    } else {
        if (locale == "japanese") {
            //find an item with value of sessionLang\
            var img = "{{ config('constants.image_url').'/common-asset/images/JPN.png' }}";
            var value = "japanese";
            var text = "日本語";
            var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
            $('.btn-select').html(item);
            $('.btn-select').attr('value', value);
        } else if (locale == "malay") {
            var img = "{{ config('constants.image_url').'/common-asset/images/MAL.png' }}";
            var value = "malay";
            var text = "Malay";
            var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
            $('.btn-select').html(item);
            $('.btn-select').attr('value', value);
        } else {
            var img = "{{ config('constants.image_url').'/common-asset/images/USA.png' }}";
            var value = "en";
            var text = "English";
            var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
            $('.btn-select').html(item);
            $('.btn-select').attr('value', value);
        }
    }
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
                    // console.log("logout error");
                    // console.log(err)
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
        getNotifications();

        function getNotifications() {
            $.ajax({
                type: 'GET',
                url: allNotifications,
                success: function(res) {
                    console.log("res")
                    console.log(res)
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
                    console.log("res")
                    console.log(res)
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
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        var IDLE_TIMEOUT = 1500; //seconds
        var _idleSecondsTimer = null;
        var _idleSecondsCounter = 0;
        document.onclick = function() {
            _idleSecondsCounter = 0;
        };

        document.onmousemove = function() {
            _idleSecondsCounter = 0;
        };

        document.onkeypress = function() {
            _idleSecondsCounter = 0;
        };

        _idleSecondsTimer = window.setInterval(CheckIdleTime, 1000);

        function CheckIdleTime() {
            _idleSecondsCounter++;
            if (_idleSecondsCounter >= IDLE_TIMEOUT) {
                window.clearInterval(_idleSecondsTimer);
                logoutFunc();
            }
        }
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
        document.getElementById("scrollToView").scrollIntoView();
    });
</script>