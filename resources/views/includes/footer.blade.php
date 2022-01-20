<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                2015 - <script>
                    document.write(new Date().getFullYear())
                </script> &copy; by <a href="https://aibots.my/">Aibots Sdn Bhd</a>
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
<script src="{{ asset('libs/mohithg-switchery/switchery.min.js') }}"></script>
<script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>


<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('libs/@fullcalendar/core/main.min.js') }}"></script>
    <script src="{{ asset('libs/@fullcalendar/bootstrap/main.min.js') }}"></script>
    <script src="{{ asset('libs/@fullcalendar/daygrid/main.min.js') }}"></script>
    <script src="{{ asset('libs/@fullcalendar/timegrid/main.min.js') }}"></script>
    <script src="{{ asset('libs/@fullcalendar/list/main.min.js') }}"></script>
    <script src="{{ asset('libs/@fullcalendar/interaction/main.min.js') }}"></script>

<!-- Calendar init -->
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
    <script src="{{ asset('js/pages/calendar.init.js') }}"></script>
<!-- Plugins js-->
<script src="{{ asset('libs/flatpickr/flatpickr.min.js') }}"></script>
<!-- <script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script> -->

<script src="{{ asset('libs/selectize/js/standalone/selectize.min.js') }}"></script>

<!-- Dashboar 1 init js-->
<!-- <script src="{{ asset('js/pages/dashboard-1.init.js') }}"></script> -->

<!-- App js-->
<script src="{{ asset('js/app.min.js') }}"></script>

<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<!-- Add croptool plugin -->
<script src="{{ asset('ijaboCropTool/ijaboCropTool.min.js') }}"></script>
<!-- Add date picker -->
<!-- <script src="{{ asset('date-picker/jquery-3.6.0.js') }}"></script> -->
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>

<!-- <script src="{{ asset('js/validation/validation.js') }}"></script> -->
<!-- test js for datatable download -->
<!-- <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script> -->

<script>
    toastr.options.preventDuplicates = true;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // section routes
    var sectionList = "{{ route('section.list') }}";
    var sectionDetails = "{{ route('section.details') }}";
    var sectionDelete = "{{ route('section.delete') }}";
    // get states
    var getStates = "{{ config('constants.api.states') }}";
    var getCity = "{{ config('constants.api.cities') }}";
    var branchByClass = "{{ config('constants.api.branch_by_class') }}";
    var branchBySection = "{{ config('constants.api.branch_by_section') }}";

    var token = "{{ Session::get('token') }}";
    var userID = "{{ Session::get('user_id') }}";
    // branch details
    var branchList = "{{ route('branch.list') }}";
    var branchShow = "{{ route('branch.index') }}";
    var deleteBranch = "{{ route('branch.delete') }}";
    
    // section allocation routes
    var sectionAllocationList = "{{ route('section_allocation.list') }}";
    var sectionAllocationDetails = "{{ route('section_allocation.details') }}";
    var sectionAllocationDelete = "{{ route('section_allocation.delete') }}";

    // assign teacher routes
    var assignTeacherList = "{{ route('assign_teacher.list') }}";
    var assignTeacherDetails = "{{ route('assign_teacher.details') }}";
    var assignTeacherUpdate = "{{ route('assign_teacher.update') }}";
    var deleteAssignTeacher = "{{ route('assign_teacher.delete') }}";
    var branchbyAssignTeacher = "{{ config('constants.api.branch_by_assign_teacher') }}";
    var getsectionAllocation = "{{ config('constants.api.section_by_class') }}";    
    // class details
    var classList = "{{ route('class.list') }}";
    var classDetails = "{{ route('class.details') }}";
    var classDelete = "{{ route('class.delete') }}";  
    // Event type details
    var eventTypeList = "{{ route('event_type.list') }}";
    var eventTypeDetails = "{{ route('event_type.details') }}";
    var eventTypeDelete = "{{ route('event_type.delete') }}"; 

    // Event details
    var eventList = "{{ route('event.list') }}";
    var eventDetails = "{{ route('event.details') }}";
    var eventDelete = "{{ route('event.delete') }}"; 
    var eventPublish = "{{ route('event.publish') }}"; 
    var branchByEvent = "{{ config('constants.api.branch_by_event') }}";
        // department routes
    var departmentList = "{{ route('department.list') }}";
    var departmentDetails = "{{ route('department.details') }}";
    var departmentDelete = "{{ route('department.delete') }}";

    // designation routes
    var designationList = "{{ route('designation.list') }}";
    var designationDetails = "{{ route('designation.details') }}";
    var designationDelete = "{{ route('designation.delete') }}";
    
    // employee
    var empDepartment = "{{ config('constants.api.emp_department') }}";
    var empDesignation = "{{ config('constants.api.emp_designation') }}";
    var employeeList = "{{ route('employee.list') }}";
    var employeeShow = "{{ route('super_admin.listemployee') }}";
        // settings url
    var profileUpdateStg = "{{ config('constants.api.change_profile_picture') }}";
    var updateSettingSession = "{{ route('settings.updateSettingSession') }}";
    var profilePath = "{{ asset('users/images') }}";
    
    // users routes
    var userList = "{{ route('users.user_list') }}";
    var userShow = "{{ route('users.user') }}";
    var deleteUser = "{{ route('users.delete') }}";
</script>
<!-- custom js  -->
<!-- <script src="{{ asset('js/custom/classes.js') }}"></script>
<script src="{{ asset('js/custom/user_list.js') }}"></script>
<script src="{{ asset('js/custom/settings.js') }}"></script> -->
<script src="{{ asset('js/custom/section.js') }}"></script>
<script src="{{ asset('js/custom/branch.js') }}"></script>
<script src="{{ asset('js/custom/classes.js') }}"></script>
<script src="{{ asset('js/custom/department.js') }}"></script>
<script src="{{ asset('js/custom/event_type.js') }}"></script>
<script src="{{ asset('js/custom/event.js') }}"></script>
<script src="{{ asset('js/custom/designation.js') }}"></script>
<script src="{{ asset('js/custom/employee.js') }}"></script>
<script src="{{ asset('js/custom/assign_teacher.js') }}"></script>
<script src="{{ asset('js/custom/settings.js') }}"></script>
<script src="{{ asset('js/custom/user_list.js') }}"></script>
<script src="{{ asset('js/custom/dashboard.js') }}"></script>