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
<script src="{{ asset('public/js/vendor.min.js') }}"></script>
<script src="{{ asset('public/libs/mohithg-switchery/switchery.min.js') }}"></script>

<script src="{{ asset('public/libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('public/libs/apexcharts/apexcharts.min.js') }}"></script>
<!-- <script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
<script src="https://apexcharts.com/samples/assets/ohlc.js"></script> -->

<!-- init js -->
<!-- <script src="{{ asset('public/js/pages/apexcharts.init.js') }}"></script> -->

<!-- plugin js -->
<script src="{{ asset('public/libs/moment/min/moment.min.js') }}"></script>

@if(Session::get('role_id') == '1')
<script>
    var logoutIdle = "{{ route('super_admin.logout') }}";
</script>
@elseif(Session::get('role_id') == '3')
<script>
    var logoutIdle = "{{ route('staff.logout') }}";
</script>
@elseif(Session::get('role_id') == '4')
<script>
    var logoutIdle = "{{ route('teacher.logout') }}";
</script>
@elseif(Session::get('role_id') == '5')
<script>
    var logoutIdle = "{{ route('parent.logout') }}";
</script>
@elseif(Session::get('role_id') == '6')
<script>
    var logoutIdle = "{{ route('student.logout') }}";
</script>
@else
<script>
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
<!-- Calendar init -->
<!-- <script src="{{ asset('public/js/pages/form-advanced.init.js') }}"></script> -->
@if(Session::get('role_id'))
@if(Session::get('role_id') == '4')
@elseif(Session::get('role_id') == '5')
<script src="{{ asset('public/js/custom/parent_calendar.js') }}"></script>
<script>
    // update child session
    var updateChildSessionID = "{{ route('navbar.update.child_id') }}";
</script>
@else
<!-- <script src="{{ asset('public/js/pages/calendar.init.js') }}"></script> -->
@endif
@endif
<!-- Plugins js-->
<script src="{{ asset('public/libs/flatpickr/flatpickr.min.js') }}"></script>
<!-- <script src="{{ asset('public/libs/apexcharts/apexcharts.min.js') }}"></script> -->

<script src="{{ asset('public/libs/selectize/js/standalone/selectize.min.js') }}"></script>

<!-- Chart JS -->
<script src="{{ asset('public/libs/chart.js/Chart.bundle.min.js') }}"></script>

<script src="{{ asset('public/libs/morris.js06/morris.min.js') }}"></script>
<script src="{{ asset('public/libs/raphael/raphael.min.js') }}"></script>
<!-- Init  -->
<!-- <script src="{{ asset('public/js/pages/chartjs.init.js') }}"></script> -->
<!-- Dashboar 1 init js-->
<!-- <script src="{{ asset('public/js/pages/dashboard-1.init.js') }}"></script> -->
<!-- App js-->
<script src="{{ asset('public/js/app.min.js') }}"></script>

<script src="{{ asset('public/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/toastr/toastr.min.js') }}"></script>
<!-- Add croptool plugin -->
<!-- <script src="{{ asset('public/ijaboCropTool/ijaboCropTool.min.js') }}"></script> -->
<!-- Add date picker -->
<!-- <script src="{{ asset('public/date-picker/jquery-3.6.0.js') }}"></script> -->
<script src="{{ asset('public/date-picker/jquery-ui.js') }}"></script>

<!-- <script src="{{ asset('public/js/validation/validation.js') }}"></script> -->
<!-- test js for datatable download -->
<!-- <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script> -->
<script src="{{ asset('public/buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- Bootstrap Tables js -->
<script src="{{ asset('public/libs/bootstrap-table/bootstrap-table.min.js') }}"></script>
<!-- ApexChart  Js-->
<!-- <script src="{{ asset('public/js/apexChart/apexcharts.js') }}"></script> -->
<!-- ApeDate Picker  Js-->
<!-- <script src="{{ asset('public/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script> -->
<!-- Datepicker -->
<!-- <script src="{{ asset('public/date-picker/jquery-ui.js') }}"></script> -->
<!-- Table Editable plugin-->
<script src="{{ asset('public/libs/jquery-tabledit/jquery.tabledit.min.js') }}"></script>
<!-- hightcharts js -->
<!-- <script src="{{ asset('public/js/highcharts/highcharts.js') }}"></script> -->
<!-- add date range picker -->
<script type="text/javascript" src="{{ asset('public/js/daterangepicker/daterangepicker.min.js') }}"></script>

<!-- add jquery validation -->
<!-- <script src="{{ asset('public/js/pages/bootstrap-tables.init.js') }}"></script> -->
<!-- Init js -->
<script src="{{ asset('public/js/validation/validation.js') }}"></script>

<script src="{{ asset('public/country/js/countrySelect.js') }}"></script>
<script>
    var token = "{{ Session::get('token') }}";
    toastr.options.preventDuplicates = true;
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
    
    
    var select_employee = "{{ __('messages.select_employee') }}";
    var all_lang = "{{ __('messages.all') }}";
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
    var day = "{{ __('messages.day') }}";
    var list = "{{ __('messages.list') }}";
    var locale = "{{ Session::get('locale') }}";
    var calLang = "{{ __('messages.calendar_lang') }}";
    console.log('123',calLang)
    var downloadcsv = "{{ __('messages.download_csv') }}";
    var downloadpdf = "{{ __('messages.download_pdf') }}";
    var userID = "{{ Session::get('user_id') }}";
    var studentID = "{{ Session::get('student_id') }}";
    var select_class = "{{ __('messages.select_class') }}";
    var select_section = "{{ __('messages.select_section') }}";
    var select_subject = "{{ __('messages.select_subject') }}";
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
    
    
    // academic_session_id
    var academic_session_id = "{{ Session::get('academic_session_id') }}";
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
    // var profilePath = "{{ asset('public/users/images') }}";
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
    var allLogout = "{{ route('all_logout') }}";
</script>
<!-- custom js  -->
<script src="{{ asset('public/js/custom/settings.js') }}"></script>
<!-- <script src="{{ asset('public/js/custom/user_list.js') }}"></script> -->
<script src="{{ asset('public/js/custom/dashboard.js') }}"></script>
<!-- <script src="{{ asset('public/js/custom/test_result.js') }}"></script> -->
<!-- <script src="{{ asset('public/js/custom/apex-mixed.js') }}"></script> -->
<script src="{{ asset('public/js/custom/common.js') }}"></script>
<!-- <script src="{{ asset('public/js/custom/iconchart.js') }}"></script> -->
<!-- <script src="{{ asset('public/js/apexChart/apexcharts.js') }}"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->

<script type="text/javascript">
    

    var url = "{{ route('changeLang') }}";
    var langArray = [];
    $('.vodiapicker option').each(function(){
        var img = $(this).attr("data-thumbnail");
        var text = this.innerText;
        var value = $(this).val();
        var item = '<li><img src="'+ img +'" alt="" value="'+value+'"/><span>'+ text +'</span></li>';
        langArray.push(item);
        })

        $('#a').html(langArray);

        //Set the button value to the first el of the array
        $('.btn-select').html(langArray[0]);
        $('.btn-select').attr('value', 'en');

        //change button stuff on click
        $('#a li').click(function(){
            
        var img = $(this).find('img').attr("src");
        var value = $(this).find('img').attr('value');
        
    console.log('value',value)
        window.location.href = url + "?lang=" + value;
        var text = this.innerText;
        var item = '<li><img src="'+ img +'" alt="" /><span >'+ text +'</span></li>';
        $('.btn-select').html(item);
        $('.btn-select').attr('value', value);
        $(".b").toggle();
        //console.log(value);
    });

    $(".btn-select").click(function(){
            $(".b").toggle();
        });

    //check local storage for the lang
    console.log('en',locale)
    if (locale=="japanese"){
        //find an item with value of sessionLang\
        var img = "{{ asset('public/images/JPN.png') }}";
        var value = "japanese";
        var text = "JPN";
        var item = '<li><img src="'+ img +'" alt="" /><span >'+ text +'</span></li>';
        $('.btn-select').html(item);
        $('.btn-select').attr('value', value);
    } else {
        var img = "{{ asset('public/images/USA.png') }}";
        var value = "en";
        var text = "ENG";
        var item = '<li><img src="'+ img +'" alt="" /><span >'+ text +'</span></li>';
        $('.btn-select').html(item);
        $('.btn-select').attr('value', value);
    }
</script>
<!-- <script>
    

    var url = "{{ route('changeLang') }}";

    $(".changeLang").change(function() {
        if($(this).val()=="United States"){
                var lang = "en";
        }else{
            var lang = "japanese";
        }
        window.location.href = url + "?lang=" + lang;
    });
        if(locale=="en"){
            var selectedCountry = "us"x
        }else if(locale=="japanese"){
            var selectedCountry = "jp"
        }
    $("#countryLang").countrySelect({
        onlyCountries: ['us','jp'],
        defaultCountry:selectedCountry,
        responsiveDropdown: true
    });
</script> -->
<script>
    function sendMarkRequest(id = null) {
        return $.ajax(readNotifications, {
            method: 'POST',
            data: {
                token,
                id
            }
        });

    }
    $(document).ready(function() {

        // $('.notification-list-show').css('display', 'none');

        // var sTimeOut = setInterval(function() {
        //     getNotifications();
        // }, 2000);

        // var sTimeOut = setInterval(function() {
        //     $.ajax({
        //         type: 'GET',
        //         url: allLogout,
        //         success: function(res) {
        //             if (res.code == 200) {
        //                 if (res.role == 1) {
        //                     window.location.href = "{{ route('super_admin.login')}}";
        //                 } else if (res.role == 2) {
        //                     window.location.href = "{{ route('admin.login')}}";
        //                 } else if (res.role == 3) {
        //                     window.location.href = "{{ route('staff.login')}}";
        //                 } else if (res.role == 4) {
        //                     window.location.href = "{{ route('teacher.login')}}";
        //                 } else if (res.role == 5) {
        //                     window.location.href = "{{ route('parent.login')}}";
        //                 } else if (res.role == 6) {
        //                     window.location.href = "{{ route('student.login')}}";
        //                 }
        //             }

        //         },
        //         error: function(err) {
        //             // console.log("eror")
        //             // console.log(err)
        //         }
        //     });
        // }, 8000);
        // getAllLogout();
        // function getAllLogout() {
        //     $.ajax({
        //         type: 'GET',
        //         url: allLogout,
        //         success: function(res) {
        //             if(res.code==200) {
        //                 if(res.role==2) {
        //                 url_name = "{{ route('admin.logout') }}"
        //                 $.ajax({
        //                     type: 'post',
        //                     url: url_name,
        //                     success: function(ress) {

        //                         console.log('out',ress)

        //                     },
        //                 });
        //             }
        //         }
        //         },
        //         error: function(err) {
        //             // console.log("eror")
        //             // console.log(err)
        //         }
        //     });
        // }

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
<script>
    /*
     *   this script is for manage the logout of timeout
     *   if user is inactive for 15 min
     *   he will be logout : 
     *
     * */
    var timeout;
    document.onmousemove = function() {
        clearTimeout(timeout);
        timeout = setTimeout(function() {
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
                }
            });
        }, 60000 * 60);
    };
</script>