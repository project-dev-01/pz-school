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

<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('libs/@fullcalendar/core/main.min.js') }}"></script>
    <script src="{{ asset('libs/@fullcalendar/bootstrap/main.min.js') }}"></script>
    <script src="{{ asset('libs/@fullcalendar/daygrid/main.min.js') }}"></script>
    <script src="{{ asset('libs/@fullcalendar/timegrid/main.min.js') }}"></script>
    <script src="{{ asset('libs/@fullcalendar/list/main.min.js') }}"></script>
    <script src="{{ asset('libs/@fullcalendar/interaction/main.min.js') }}"></script>

<!-- Calendar init -->
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

<!-- <script src="{{ asset('js/validation/validation.js') }}"></script> -->
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
    
    // branch details
    var branchList = "{{ route('branch.list') }}";
    var branchShow = "{{ route('branch.index') }}";
    var deleteBranch = "{{ route('branch.delete') }}";
    
    // section allocation routes
    var sectionAllocationList = "{{ route('section_allocation.list') }}";
    var sectionAllocationDetails = "{{ route('section_allocation.details') }}";
    var sectionAllocationDelete = "{{ route('section_allocation.delete') }}";

    
    // class details
    var classList = "{{ route('class.list') }}";
    var classDetails = "{{ route('class.details') }}";
    var classDelete = "{{ route('class.delete') }}";  

    // department routes
    var departmentList = "{{ route('department.list') }}";
    var departmentDetails = "{{ route('department.details') }}";
    var departmentDelete = "{{ route('department.delete') }}";

      
</script>
<!-- custom js  -->
<!-- <script src="{{ asset('js/custom/classes.js') }}"></script>
<script src="{{ asset('js/custom/user_list.js') }}"></script>
<script src="{{ asset('js/custom/settings.js') }}"></script> -->
<script src="{{ asset('js/custom/section.js') }}"></script>
<script src="{{ asset('js/custom/branch.js') }}"></script>
<script src="{{ asset('js/custom/classes.js') }}"></script>
<script src="{{ asset('js/custom/department.js') }}"></script>
<!-- <script src="{{ asset('js/custom/assign_teacher.js') }}"></script> -->