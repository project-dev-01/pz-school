<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                2020 - <script>
                    document.write(new Date().getFullYear())
                    </script> &copy; by <a href="https://paxsuzen.com">Paxsuzen</a>
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
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
@if(Session::get('role_id'))
@if(Session::get('role_id') == '4')
<!-- <script src="{{ asset('js/custom/calendar.js') }}"></script> -->
<script src="{{ asset('js/custom/teacher_calendar.js') }}"></script>
@elseif(Session::get('role_id') == '5')
<script src="{{ asset('js/custom/parent_calendar.js') }}"></script>
@elseif(Session::get('role_id') == '6')
<script src="{{ asset('js/custom/parent_calendar.js') }}"></script>
@else
<script src="{{ asset('js/pages/calendar.init.js') }}"></script>
@endif
@endif
<!-- Plugins js-->
<script src="{{ asset('libs/flatpickr/flatpickr.min.js') }}"></script>
<!-- <script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script> -->

<script src="{{ asset('libs/selectize/js/standalone/selectize.min.js') }}"></script>

<!-- Chart JS -->
<script src="{{ asset('libs/chart.js/Chart.bundle.min.js') }}"></script>

<script src="{{ asset('libs/morris.js06/morris.min.js') }}"></script>
<script src="{{ asset('libs/raphael/raphael.min.js') }}"></script>
<!-- Init  -->
<!-- <script src="{{ asset('js/pages/chartjs.init.js') }}"></script> -->
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
<!-- Bootstrap Tables js -->
<script src="{{ asset('libs/bootstrap-table/bootstrap-table.min.js') }}"></script>
<!-- ApexChart  Js-->
<script src="{{ asset('js/apexChart/apexcharts.js') }}"></script>
<!-- ApeDate Picker  Js-->
<!-- <script src="{{ asset('libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script> -->
<!-- Datepicker -->
<!-- <script src="{{ asset('date-picker/jquery-ui.js') }}"></script> -->
<!-- Table Editable plugin-->
<script src="{{ asset('libs/jquery-tabledit/jquery.tabledit.min.js') }}"></script>
<!-- hightcharts js -->
<script src="{{ asset('js/highcharts/highcharts.js') }}"></script>
<!-- add date range picker -->
<script type="text/javascript" src="{{ asset('js/daterangepicker/daterangepicker.min.js') }}"></script>

<!-- add jquery validation -->
<script src="{{ asset('js/pages/bootstrap-tables.init.js') }}"></script>
<!-- Init js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // section routes
    var sectionList = "{{ route('super_admin.section.list') }}";
    var sectionDetails = "{{ route('section.details') }}";
    var sectionDelete = "{{ route('section.delete') }}";
    // get states
    var getStates = "{{ config('constants.api.states') }}";
    var getCity = "{{ config('constants.api.cities') }}";
    var branchByClass = "{{ config('constants.api.branch_by_class') }}";
    var branchBySection = "{{ config('constants.api.branch_by_section') }}";

    var token = "{{ Session::get('token') }}";
    var branchID = "{{ Session::get('branch_id') }}";
    var userID = "{{ Session::get('user_id') }}";
    // branch details
    var branchList = "{{ route('branch.list') }}";
    var branchShow = "{{ route('branch.index') }}";
    var deleteBranch = "{{ route('branch.delete') }}";

    // section allocation routes
    var sectionAllocationList = "{{ route('super_admin.section_allocation.list') }}";
    var sectionAllocationDetails = "{{ route('section_allocation.details') }}";
    var sectionAllocationDelete = "{{ route('section_allocation.delete') }}";

    // assign teacher routes
    var assignTeacherList = "{{ route('super_admin.assign_teacher.list') }}";
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
    var eventTypeList = "{{ route('super_admin.event_type.list') }}";
    var eventTypeDetails = "{{ route('event_type.details') }}";
    var eventTypeDelete = "{{ route('event_type.delete') }}";

    // Event details
    var eventList = "{{ route('super_admin.event.list') }}";
    var eventDetails = "{{ route('event.details') }}";
    var eventDelete = "{{ route('event.delete') }}";
    var eventPublish = "{{ route('event.publish') }}";
    var branchByEvent = "{{ config('constants.api.branch_by_event') }}";

    
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
<script src="{{ asset('js/custom/classes.js') }}"></script>
<script src="{{ asset('js/custom/event_type.js') }}"></script>
<script src="{{ asset('js/custom/event.js') }}"></script>
<script src="{{ asset('js/custom/assign_teacher.js') }}"></script>
<script src="{{ asset('js/custom/settings.js') }}"></script>
<script src="{{ asset('js/custom/user_list.js') }}"></script>
<script src="{{ asset('js/custom/dashboard.js') }}"></script>
<script src="{{ asset('js/custom/test_result.js') }}"></script>
<script src="{{ asset('js/custom/apex-mixed.js') }}"></script>
<script src="{{ asset('js/custom/attendance.js') }}"></script>
<script src="{{ asset('js/custom/homework.js') }}"></script>
<script src="{{ asset('js/custom/textbox-dynamic-add.js') }}"></script>
<script src="{{ asset('js/custom/common.js') }}"></script>

<script src="{{ asset('js/custom/iconchart.js') }}"></script>
<!-- <script src="{{ asset('js/apexChart/apexcharts.js') }}"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->



<script>
    ! function($) {
        "use strict";

        var ChartJs = function() {
            this.$body = $("body"),
                this.charts = []
        };

        ChartJs.prototype.respChart = function(selector, type, data, options) {

                // get selector by context
                var ctx = selector.get(0).getContext("2d");
                // pointing parent container to make chart js inherit its width
                var container = $(selector).parent();

                //default config
                Chart.defaults.global.defaultFontColor = "#8391a2";
                Chart.defaults.scale.gridLines.color = "#8391a2";

                // this function produce the responsive Chart JS
                function generateChart() {
                    // make chart width fit with its container
                    var ww = selector.attr('width', $(container).width());
                    var chart;
                    switch (type) {
                        case 'Bar':
                            chart = new Chart(ctx, {
                                type: 'bar',
                                data: data,
                                options: options
                            });
                            break;
                        case 'Radar':
                            chart = new Chart(ctx, {
                                type: 'radar',
                                data: data,
                                options: options
                            });
                            break;
                        case 'PolarArea':
                            chart = new Chart(ctx, {
                                data: data,
                                type: 'polarArea',
                                options: options
                            });
                            break;
                    }
                    return chart;
                };
                // run function - render chart at first load
                return generateChart();
            },
            // init various charts and returns
            ChartJs.prototype.initCharts = function() {
                var charts = [];
                var defaultColors = ["#1abc9c", "#f1556c", "#4a81d4", "#e3eaef"];

                if ($('#radar-chart-test-marks').length > 0) {
                    var dataColors = $("#radar-chart-test-marks").data('colors');
                    var colors = dataColors ? dataColors.split(",") : defaultColors.concat();
                    //radar chart
                    var radarChart = {
                        labels: ["Test A Score", "Test B Score", "Test C Score", "Test D Score"],
                        datasets: [{
                                label: "Mid term",
                                backgroundColor: hexToRGB(colors[0], 0.3),
                                borderColor: colors[0],
                                pointBackgroundColor: colors[0],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: colors[0],
                                data: [65, 59, 90, 81]
                            },
                            {
                                label: "Annual",
                                backgroundColor: hexToRGB(colors[1], 0.3),
                                borderColor: colors[1],
                                pointBackgroundColor: colors[1],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: colors[1],
                                data: [80, 60, 80, 75]
                            }
                        ]
                    };
                    var radarOpts = {
                        maintainAspectRatio: false
                    };
                    charts.push(this.respChart($("#radar-chart-test-marks"), 'Radar', radarChart, radarOpts));
                }
                if ($('#radar-chart-test-bystudentmarks').length > 0) {
                    var dataColors = $("#radar-chart-test-bystudentmarks").data('colors');
                    var colors = dataColors ? dataColors.split(",") : defaultColors.concat();
                    //radar chart
                    var radarChart = {
                        labels: ["Mathematics", "History", "Study of the Environment", "Geography", "Natural Sciences", "Civics Education", "Physical Education","English"],
                        datasets: [{
                                label: "Quarterly",
                                backgroundColor: hexToRGB(colors[0], 0.3),
                                borderColor: colors[0],
                                pointBackgroundColor: colors[0],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: colors[0],
                                data: [95.83, 53, 100, 68.75, 54.55, 32.86, 26.32,14.29]
                            },
                            {
                                label: "Annual",
                                backgroundColor: hexToRGB(colors[1], 0.3),
                                borderColor: colors[1],
                                pointBackgroundColor: colors[1],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: colors[1],
                                data: [90.53, 60.85, 80, 75, 40.25, 50.55, 88.85]
                            }
                        ]
                    };
                    var radarOpts = {
                        maintainAspectRatio: false
                    };
                    charts.push(this.respChart($("#radar-chart-test-bystudentmarks"), 'Radar', radarChart, radarOpts));
                }
                if ($('#radar-chart-test-teacher-bystudentmarks').length > 0) {
                    var dataColors = $("#radar-chart-test-teacher-bystudentmarks").data('colors');
                    var colors = dataColors ? dataColors.split(",") : defaultColors.concat();
                    //radar chart
                    var radarChart = {
                        labels: ["A", "A+", "A-", "B+", "B", "C+", "C","D","E","G"],
                        datasets: [{
                                label: "Quarterly",
                                backgroundColor: hexToRGB(colors[0], 0.3),
                                borderColor: colors[0],
                                pointBackgroundColor: colors[0],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: colors[0],
                                data: [0, 41, 16, 12, 4, 20, 0,0,0]
                            },
                            {
                                label: "Annual",
                                backgroundColor: hexToRGB(colors[1], 0.3),
                                borderColor: colors[1],
                                pointBackgroundColor: colors[1],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: colors[1],
                                data: [0, 41, 16, 12, 4, 20, 0,0,0]
                            }
                        ]
                    };
                    var radarOpts = {
                        maintainAspectRatio: false
                    };
                    charts.push(this.respChart($("#radar-chart-test-teacher-bystudentmarks"), 'Radar', radarChart, radarOpts));
                }
                if ($('#radar-chart-test-byclass').length > 0) {
                    var dataColors = $("#radar-chart-test-byclass").data('colors');
                    var colors = dataColors ? dataColors.split(",") : defaultColors.concat();
                    //radar chart
                    var radarChart = {
                        labels: ["I", "II", "III", "IV", "V", "VI", "VII","VIII"],
                        datasets: [{
                                label: "Quarterly",
                                backgroundColor: hexToRGB(colors[0], 0.3),
                                borderColor: colors[0],
                                pointBackgroundColor: colors[0],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: colors[0],
                                data: [95.83, 53, 100, 68.75, 54.55, 32.86, 26.32,14.29]
                            },
                            {
                                label: "Annual",
                                backgroundColor: hexToRGB(colors[1], 0.3),
                                borderColor: colors[1],
                                pointBackgroundColor: colors[1],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: colors[1],
                                data: [90.53, 60.85, 80, 75, 40.25, 50.55, 88.85]
                            }
                        ]
                    };
                    var radarOpts = {
                        maintainAspectRatio: false
                    };
                    charts.push(this.respChart($("#radar-chart-test-byclass"), 'Radar', radarChart, radarOpts));
                }
                if ($('#radar-chart-test-teacher-byclass').length > 0) {
                    var dataColors = $("#radar-chart-test-teacher-byclass").data('colors');
                    var colors = dataColors ? dataColors.split(",") : defaultColors.concat();
                    //radar chart
                    var radarChart = {
                        labels: ["A", "A+", "A-", "B+", "B", "C+", "C","D","E","G"],
                        datasets: [{
                                label: "Quarterly",
                                backgroundColor: hexToRGB(colors[0], 0.3),
                                borderColor: colors[0],
                                pointBackgroundColor: colors[0],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: colors[0],
                                data: [0,41,16,12,4,20,0,0,0,4]
                            },
                            {
                                label: "Annual",
                                backgroundColor: hexToRGB(colors[1], 0.3),
                                borderColor: colors[1],
                                pointBackgroundColor: colors[1],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: colors[1],
                                data: [2,41,16,12,4,20,0,0,0,4]
                            }
                        ]
                    };
                    var radarOpts = {
                        maintainAspectRatio: false
                    };
                    charts.push(this.respChart($("#radar-chart-test-teacher-byclass"), 'Radar', radarChart, radarOpts));
                }
                if ($('#radar-chart-test-bystudent').length > 0) {
                    var dataColors = $("#radar-chart-test-bystudent").data('colors');
                    var colors = dataColors ? dataColors.split(",") : defaultColors.concat();
                    //radar chart
                    var radarChart = {
                        labels: ["A", "A+", "A-", "B", "B+","C","C+","E","G"],
                        datasets: [{
                                label: "Mid Term",
                                backgroundColor: hexToRGB(colors[0], 0.3),
                                borderColor: colors[0],
                                pointBackgroundColor: colors[0],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: colors[0],
                                data:[90, 30, 35, 70,50,0,30,30,10]
                            },
                            {
                                label: "Annual",
                                backgroundColor: hexToRGB(colors[1], 0.3),
                                borderColor: colors[1],
                                pointBackgroundColor: colors[1],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: colors[1],
                                data: [70, 85, 0, 86,60,0,70,70,10]
                            }
                        ]
                    };
                    var radarOpts = {
                        maintainAspectRatio: false
                    };
                    charts.push(this.respChart($("#radar-chart-test-bystudent"), 'Radar', radarChart, radarOpts));
                }
                if ($('#radar-chart-test-teacher-bystudent').length > 0) {
                    var dataColors = $("#radar-chart-test-teacher-bystudent").data('colors');
                    var colors = dataColors ? dataColors.split(",") : defaultColors.concat();
                    //radar chart
                    var radarChart = {
                        labels: ["A", "A+", "A-", "B", "B+","C","C+","E","G"],
                        datasets: [{
                                label: "Mid Term",
                                backgroundColor: hexToRGB(colors[0], 0.3),
                                borderColor: colors[0],
                                pointBackgroundColor: colors[0],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: colors[0],
                                data: [70, 85, 0, 86,60,0,70,70]
                            },
                            {
                                label: "Annual",
                                backgroundColor: hexToRGB(colors[1], 0.3),
                                borderColor: colors[1],
                                pointBackgroundColor: colors[1],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: colors[1],
                                data: [75, 90, 20, 80,50,0,65,60]
                            }
                        ]
                    };
                    var radarOpts = {
                        maintainAspectRatio: false
                    };
                    charts.push(this.respChart($("#radar-chart-test-teacher-bystudent"), 'Radar', radarChart, radarOpts));
                }
                if ($('#radar-chart-test-overall').length > 0) {
                    var dataColors = $("#radar-chart-test-overall").data('colors');
                    var colors = dataColors ? dataColors.split(",") : defaultColors.concat();
                    //radar chart
                    var radarChart = {
                        labels: ["I", "II", "III", "IV", "V", "VI", "VII","VIII"],
                        datasets: [{
                                label: "Quarterly",
                                backgroundColor: hexToRGB(colors[0], 0.3),
                                borderColor: colors[0],
                                pointBackgroundColor: colors[0],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: colors[0],
                                data: [95, 53, 100, 68, 54, 22, 26,14]
                            },
                            {
                                label: "Annual",
                                backgroundColor: hexToRGB(colors[1], 0.3),
                                borderColor: colors[1],
                                pointBackgroundColor: colors[1],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: colors[1],
                                data: [85, 63, 80, 40, 50, 40, 45,30]
                            }
                        ]
                    };
                    var radarOpts = {
                        maintainAspectRatio: false
                    };
                    charts.push(this.respChart($("#radar-chart-test-overall"), 'Radar', radarChart, radarOpts));
                }
                if ($('#radar-analytic').length > 0) {
                    var dataColors = $("#radar-analytic").data('colors');
                    var colors = dataColors ? dataColors.split(",") : defaultColors.concat();
                    //radar chart
                    var radarChart = {
                        labels: ["Skill", "Grammer", "GeoGenius"],
                        datasets: [{
                                label: "Mid term",
                                backgroundColor: hexToRGB(colors[0], 0.3),
                                borderColor: colors[0],
                                pointBackgroundColor: colors[0],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: colors[0],
                                data: [95, 45, 45]
                            },
                            {
                                label: "Annual",
                                backgroundColor: hexToRGB(colors[1], 0.3),
                                borderColor: colors[1],
                                pointBackgroundColor: colors[1],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: colors[1],
                                data: [65, 75, 70]
                            }
                        ]
                    };
                    var radarOpts = {
                        maintainAspectRatio: false
                    };
                    charts.push(this.respChart($("#radar-analytic"), 'Radar', radarChart, radarOpts));
                }  
                return charts;
            },
            //initializing various components and plugins
            ChartJs.prototype.init = function() {
                var $this = this;
                // font
                Chart.defaults.global.defaultFontFamily = 'Nunito,sans-serif';

                // init charts
                $this.charts = this.initCharts();

                // enable resizing matter
                $(window).on('resize', function(e) {
                    $.each($this.charts, function(index, chart) {
                        try {
                            chart.destroy();
                        } catch (err) {}
                    });
                    $this.charts = $this.initCharts();
                });
            },

            //init flotchart
            $.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs
    }(window.jQuery),

    //initializing ChartJs
    function($) {
        "use strict";
        $.ChartJs.init()
    }(window.jQuery);

    /* utility function */

    function hexToRGB(hex, alpha) {
        var r = parseInt(hex.slice(1, 3), 16),
            g = parseInt(hex.slice(3, 5), 16),
            b = parseInt(hex.slice(5, 7), 16);

        if (alpha) {
            return "rgba(" + r + ", " + g + ", " + b + ", " + alpha + ")";
        } else {
            return "rgb(" + r + ", " + g + ", " + b + ")";
        }
    }
</script>

<script>
    ! function(e) {
        "use strict";

        function a() {}
        a.prototype.createBarChart = function(a, t, e, o, r, i) {
            Morris.Bar({
                element: a,
                data: t,
                xkey: e,
                ykeys: o,
                labels: r,
                dataLabels: !1,
                hideHover: "auto",
                resize: !0,
                gridLineColor: "rgba(65, 80, 95, 0.07)",
                barSizeRatio: .2,
                barColors: i
            })
        }, a.prototype.createDonutChart = function(a, t, e) {
            Morris.Donut({
                element: a,
                data: t,
                barSize: .2,
                resize: !0,
                colors: e,
                backgroundColor: "transparent"
            })
        }, a.prototype.init = function() {
            var a = ["#02c0ce"];
            (t = e("#statistics-chart").data("colors")) && (a = t.split(",")), this.createBarChart("statistics-chart", [{
                y: "50",
                a: 2
            }, {
                y: "60",
                a: 5
            }, {
                y: "70",
                a: 3
            }, {
                y: "80",
                a: 1
            }, {
                y: "90",
                a: 1
            }], "y", ["a"], ["Statistics"], a);
            var t;
            a = ["#4fc6e1", "#6658dd", "#ebeff2"];
            (t = e("#lifetime-sales").data("colors")) && (a = t.split(",")), this.createDonutChart("lifetime-sales", [{
                label: " Pass ",
                value: 47
            }, {
                label: " Fail",
                value: 4
            }, {
                label: "InProgress",
                value: 23
            }], a)
        }, e.Dashboard4 = new a, e.Dashboard4.Constructor = a
    }(window.jQuery),
    function() {
                "use strict";
                window.jQuery.Dashboard4.init()
                }();
</script>
<script>
    ! function(e) {
        "use strict";

        function a() {}
        a.prototype.createBarChart = function(a, t, e, o, r, i) {
            var browsersChart = Morris.Bar({
                element: a,
                data: t,
                xkey: e,
                ykeys: o,
                labels: r,
                dataLabels: !1,
                hideHover: "auto",
                resize: !0,
                gridLineColor: "rgba(65, 80, 95, 0.07)",
                barSizeRatio: .2,
                barColors: i
            });
            browsersChart.options.labels.forEach(function(label, i){
    var legendlabel=$('<span style="display: inline-block;">'+label+'</span>')
    var legendItem = $('<div class="mbox"></div>').css('background-color', browsersChart.options.lineColors[i]).append(legendlabel)
    $('#legend').append(legendItem)   
})
        }, a.prototype.init = function() {
            var a = ["#02c0ce"];
            (t = e("#statistics-dynam").data("colors")) && (a = t.split(",")), this.createBarChart("statistics-dynam", [{
                y: "50",
                a: 2
            }, {
                y: "60",
                a: 5
            }, {
                y: "70",
                a: 3
            }, {
                y: "80",
                a: 1
            }, {
                y: "90",
                a: 1
            }], "y", ["a"], ["Statistics"], a);
            var t;
            // a = ["#4fc6e1", "#6658dd", "#ebeff2"];
            (t = a)
        }, e.Dashboard4 = new a, e.Dashboard4.Constructor = a
    }(window.jQuery),
    function() {
                "use strict";
                window.jQuery.Dashboard4.init()
                }();
</script>

<script>
    $(document).ready(function() {
        // console.log("ready!");
        var options = {
            series: [{
                name: 'Maths',
                data: [44, 55, 41, 37, 22, 43, 21]
            }, {
                name: 'English',
                data: [53, 32, 33, 52, 13, 43, 32]
            }, {
                name: 'Physics',
                data: [12, 17, 11, 9, 15, 11, 20]
            }, {
                name: 'Geography',
                data: [9, 7, 5, 8, 6, 9, 4]
            }, {
                name: 'Chemistry',
                data: [25, 12, 19, 32, 25, 24, 10]
            }],
            chart: {
                type: 'bar',
                height: 350,
                stacked: true,
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                },
            },
            stroke: {
                width: 1,
                colors: ['#fff']
            },
            title: {
                text: 'Toppers'
            },
            xaxis: {
                categories: ["William", "James", "Benjamin", "Lucas", "Charlotte", "Sophia", "Amelia", "Isabella", "Mia"],
                labels: {
                    formatter: function(val) {
                        return val;
                    }
                }
            },
            yaxis: {
                title: {
                    text: undefined
                },
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val;
                    }
                }
            },
            fill: {
                opacity: 1
            },
            legend: {
                position: 'top',
                horizontalAlign: 'left',
                offsetX: 40
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart-hor-stack-bar-chart"), options);
        chart.render();

        // new chart
        // var ctx = document.getElementById("radar-chart-ranking-graph").getContext("2d");
        // var data = {
        //     labels: ["January", "February", "March", "April", "May", "June", "July"],
        //     datasets: [{
        //         label: "My First dataset",
        //         fillColor: "rgba(220,220,220,0.2)",
        //         strokeColor: "rgba(220,220,220,1)",
        //         pointColor: "rgba(220,220,220,1)",
        //         pointStrokeColor: "#fff",
        //         pointHighlightFill: "#fff",
        //         pointHighlightStroke: "rgba(220,220,220,1)",
        //         data: [65, 59, 80, 81, 56, 55, 40]
        //     }, {
        //         label: "My Second dataset",
        //         fillColor: "rgba(151,187,205,0.2)",
        //         strokeColor: "rgba(151,187,205,1)",
        //         pointColor: "rgba(151,187,205,1)",
        //         pointStrokeColor: "#fff",
        //         pointHighlightFill: "#fff",
        //         pointHighlightStroke: "rgba(151,187,205,1)",
        //         data: [28, 48, 40, 19, 86, 27, 90]
        //     }]
        // };
        // var MyNewChart=null;
        // $('#quarterlyExam').on('shown.bs.collapse', function () {
        // setTimeout(function() {
        //     if(MyNewChart == null)
        //         MyNewChart = new Chart(ctx).Bar(data);
        // },200);
        // });
        
    });

    
</script>
<script>
    Apex.grid = {
    padding: {
        right: 0,
        left: 0
    }
}, Apex.dataLabels = {
    enabled: !1
};
var randomizeArray = function(e) {
        for (var o, t, a = e.slice(), r = a.length; 0 !== r;) t = Math.floor(Math.random() * r), o = a[--r], a[r] = a[t], a[t] = o;
        return a
    },
    sparklineData = [47, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46],
    colorPalette = ["#00D8B6", "#008FFB", "#FEB019", "#FF4560", "#775DD0"],
    colors = ["#6658dd"];
(dataColors = $("#spark1").data("colors")) && (colors = dataColors.split(","));
var spark1 = {
    chart: {
        type: "area",
        height: 160,
        sparkline: {
            enabled: !0
        }
    },
    stroke: {
        width: 2,
        curve: "straight"
    },
    fill: {
        opacity: .2
    },
    series: [{
        name: "UBold Sales ",
        data: randomizeArray(sparklineData)
    }],
    yaxis: {
        min: 0
    },
    colors: colors,
    title: {
        text: "$424,652",
        offsetX: 10,
        style: {
            fontSize: "22px"
        }
    },
    subtitle: {
        text: "Total Sales",
        offsetX: 10,
        offsetY: 35,
        style: {
            fontSize: "13px"
        }
    }
};
new ApexCharts(document.querySelector("#spark1"), spark1).render();
colors = ["#DCE6EC"];
(dataColors = $("#spark2").data("colors")) && (colors = dataColors.split(","));
var spark2 = {
    chart: {
        type: "area",
        height: 160,
        sparkline: {
            enabled: !0
        }
    },
    stroke: {
        width: 2,
        curve: "straight"
    },
    fill: {
        opacity: .2
    },
    series: [{
        name: "UBold Expenses ",
        data: randomizeArray(sparklineData)
    }],
    yaxis: {
        min: 0
    },
    colors: colors,
    title: {
        text: "$235,312",
        offsetX: 10,
        style: {
            fontSize: "22px"
        }
    },
    subtitle: {
        text: "Expenses",
        offsetX: 10,
        offsetY: 35,
        style: {
            fontSize: "13px"
        }
    }
};
new ApexCharts(document.querySelector("#spark2"), spark2).render();
colors = ["#f672a7"];
(dataColors = $("#spark3").data("colors")) && (colors = dataColors.split(","));
var spark3 = {
    chart: {
        type: "area",
        height: 160,
        sparkline: {
            enabled: !0
        }
    },
    stroke: {
        width: 2,
        curve: "straight"
    },
    fill: {
        opacity: .2
    },
    series: [{
        name: "Net Profits ",
        data: randomizeArray(sparklineData)
    }],
    xaxis: {
        crosshairs: {
            width: 1
        }
    },
    yaxis: {
        min: 0
    },
    colors: colors,
    title: {
        text: "$135,965",
        offsetX: 10,
        style: {
            fontSize: "22px"
        }
    },
    subtitle: {
        text: "Profits",
        offsetX: 10,
        offsetY: 35,
        style: {
            fontSize: "13px"
        }
    }
};
new ApexCharts(document.querySelector("#spark3"), spark3).render();
newcolors = ['#9B59B6', '#E91E63', '#4A6F4B',"#f7b84b", "#4a81d4"];

(dataColors = $("#apex-line-1").data("colors")) && (newcolors = dataColors.split(","));
var options = {
    chart: {
        height: 380,
        type: "line",
        zoom: {
            enabled: !1
        },
        toolbar: {
            show: !1
        }
    },
    colors: newcolors,
    dataLabels: {
        enabled: !0
    },
    stroke: {
        width: [3, 3, 3, 3],
        curve: "smooth"
    },
    series: [{
        name: "English",
        // color:"#9B59B6",
        data: [46, 26, 32, 36, 41]
    },{
        name: "Maths",
        // color:"#E91E63",
        data: [70, 75, 76, 80, 90]
    },{
        name: "Geography",
        // color:"#4A6F4B",
        data: [27, 29, 33, 27, 32]
    },{
        name: "Physics",
        // color:"#f7b84b",
        data: [85, 87, 86, 90, 95]
    },{
        name: "Chemistry",
        // color:"#4a81d4",
        data: [45, 75, 85, 90, 95]
    }],
    title: {
        text: "Marks",
        align: "left",
        style: {
            fontSize: "14px",
            color: "#666"
        }
    },
    grid: {
        row: {
            colors: ["transparent", "transparent"],
            opacity: .2
        },
        borderColor: "#f1f3fa"
    },
    markers: {
        style: "inverted",
        size: 6
    },
    xaxis: {
        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
        title: {
            text: "Month"
        }
    },
    yaxis: {
        title: {
            text: "Subject"
        },
        min: 0,
        max: 100
    },
    legend: {
        position: "top",
        horizontalAlign: "right",
        floating: !0,
        offsetY: -25,
        offsetX: -5
    },
    responsive: [{
        breakpoint: 600,
        options: {
            chart: {
                toolbar: {
                    show: !1
                }
            },
            legend: {
                show: !1
            }
        }
    }]
};
(chart = new ApexCharts(document.querySelector("#apex-line-1"), options)).render();

// test result subject wise result
colors = ["#f672a7"];
(dataColors = $("#subject-avg-chart").data("colors")) && (colors = dataColors.split(","));
options = {
    chart: {
        height: 380,
        type: "line",
        shadow: {
            enabled: !1,
            color: "#bbb",
            top: 3,
            left: 2,
            blur: 3,
            opacity: 1
        }
    },
    stroke: {
        width: 5,
        curve: "smooth"
    },
    series: [{
        name: "English",
        // data: [65,87,65,87]
        data: [70, 83,65,87,65,87,86,65,90,65,99]

    }],
    xaxis: {
        type: "datetime",
        categories: ["1/11/2022", "2/11/2022", "3/11/2022", "4/11/2022", "5/11/2022", "6/11/2022", "7/11/2022", "8/11/2022", "9/11/2022", "10/11/2022", "11/11/2022", "12/11/2022", "1/11/2022", "2/11/2022", "3/11/2022", "4/11/2022", "5/11/2022", "6/11/2022"]
    },
    title: {
        text: "Subject Average",
        align: "left",
        style: {
            fontSize: "14px",
            color: "#666"
        }
    },
    fill: {
        type: "gradient",
        gradient: {
            shade: "dark",
            gradientToColors: colors,
            shadeIntensity: 1,
            type: "horizontal",
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 100, 100, 100]
        }
    },
    markers: {
        size: 4,
        opacity: .9,
        colors: ["#56c2d6"],
        strokeColor: "#fff",
        strokeWidth: 2,
        style: "inverted",
        hover: {
            size: 7
        }
    },
    yaxis: {
        min: 0,
        max: 100,
        title: {
            text: "Average"
        }
    },
    grid: {
        row: {
            colors: ["transparent", "transparent"],
            opacity: .2
        },
        borderColor: "#185a9d"
    },
    responsive: [{
        breakpoint: 600,
        options: {
            chart: {
                toolbar: {
                    show: !1
                }
            },
            legend: {
                show: !1
            }
        }
    }]
};
(chart = new ApexCharts(document.querySelector("#subject-avg-chart"), options)).render();
</script>
<script>
    colors = ["#F5AA26", "#F1556C", "#4FC6E1"];
    (dataColors = $("#late-pie").data("colors")) && (colors = dataColors.split(","));
    options = {
        chart: {
            height: 320,
            type: "pie"
        },
        series: [18, 2, 2],
        labels: ["Present", "Absent", "Late"],
        colors: colors,
        legend: {
            show: !0,
            position: "bottom",
            horizontalAlign: "center",
            verticalAlign: "middle",
            floating: !1,
            fontSize: "14px",
            offsetX: 0,
            offsetY: 7
        },
        responsive: [{
            breakpoint: 600,
            options: {
                chart: {
                    height: 240
                },
                legend: {
                    show: !1
                }
            }
        }]
    };
    (chart = new ApexCharts(document.querySelector("#anylitc-attend"), options)).render();
</script>
<script>

//Start of apex-line-2 Chart    
    colors = ["#39afd1"];
(dataColors = $("#line-23").data("colors")) && (colors = dataColors.split(","));
options = {
    chart: {
        height: 380,
        type: "line",
        zoom: {
            enabled: !1
        },
        toolbar: {
            show: !1
        }
    },
    colors: colors,
    dataLabels: {
        enabled: !0
    },
    stroke: {
        width: [3, 3],
        curve: "smooth"
    },
    
    series: [{       
        name: "Averages",
        data: [10,10,75]
    }],  
    title: {
        text: "Subject Average",
        align: "left",
        style: {
            fontSize: "14px",
            color: "#666"
        }
    },
    grid: {
        row: {
            colors: ["transparent", "transparent"],
            opacity: .2
        },
        borderColor: "#f1f3fa"
    },
    markers: {
        style: "inverted",
        size: 6
    },
    xaxis: {
        type: "datetime",
        categories: ["1/11/2000", "2/11/2000", "3/11/2000", "4/11/2000", "5/11/2000", "6/11/2000", "7/11/2000" ]
    },
    yaxis: {
        title: {
            text: "Average"
        },
        min: 0,
        max: 100
    },
    legend: {
        position: "top",
        horizontalAlign: "right",
        floating: !0,
        offsetY: -25,
        offsetX: -5
    },
    responsive: [{
        breakpoint: 600,
        options: {
            chart: {
                toolbar: {
                    show: !1
                }
            },
            legend: {
                show: !1
            }
        }
    }]
};
   (charts = new ApexCharts(document.querySelector("#line-23"), options)).render(); 
                
</script>
<script>
    ! function(e) {
        "use strict";    
        function a() {}
        a.prototype.createBarChart = function(a, t, e, o, r, i) {
            Morris.Bar({
                element: a,
                data: t,
                xkey: e,
                ykeys: o,
                labels: r,
                dataLabels: !1,
                hideHover: "auto",
                resize: !0,
                gridLineColor: "rgba(65, 80, 95, 0.07)",
                barSizeRatio: .2,
                barColors: i
            })
        }, a.prototype.createDonutChart = function(a, t, e) {
            Morris.Donut({
                element: a,
                data: t,
                barSize: .2,
                resize: !0,
                colors: e,
                backgroundColor: "transparent"
            })
        }, a.prototype.init = function() {
            var a = ["#02c0ce"];
            (t = e("#statistics-analytic").data("colors")) && (a = t.split(",")), this.createBarChart("statistics-analytic", [{
                y: "50",
                a: 2
            }, {
                y: "60",
                a: 5
            }, {
                y: "70",
                a: 3
            }, {
                y: "80",
                a: 1
            }, {
                y: "90",
                a: 1
            }], "y", ["a"], ["Statistics"], a);
            var t;
            a = ["#4fc6e1", "#6658dd", "#ebeff2"];
            (t = e("#lifetime-sales").data("colors")) && (a = t.split(",")), this.createDonutChart("lifetime-sales", [{
                label: " Pass ",
                value: 47
            }, {
                label: " Fail",
                value: 4
            }, {
                label: "InProgress",
                value: 23
            }], a)
        }, e.Dashboard4 = new a, e.Dashboard4.Constructor = a
    }(window.jQuery),
    function() {
        "use strict";
        window.jQuery.Dashboard4.init()
    }();  
</script>
<script>
            $(document).ready(function() {                    
            var colors = ['#6658dd','#1abc9c', '#CED4DC'];
            var dataColors = $("#apex-column-1").data('colors');
            if (dataColors) {
                colors = dataColors.split(",");
            }
            var options = {
                chart: {
                    height: 380,
                    type: 'bar',
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        endingShape: 'rounded',
                        columnWidth: '55%',
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                colors: colors,
                series: [{
                    name: 'Star',
                    data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
                }, {
                    name: 'Heart',
                    data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
                }, {
                    name: 'Smily Happy',
                    data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
                },{
                    name: 'Smily Angry',
                    data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
                }],
                xaxis: {
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                },
                legend: {
                    offsetY: 5,
                },
                yaxis: {
                    title: {
                        text: '$ (thousands)'
                    }
                },
                fill: {
                    opacity: 1

                },
                grid: {
                    row: {
                        colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.2
                    },
                    borderColor: '#f1f3fa',
                    padding: {
                        bottom: 10
                    }
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "$ " + val + " thousands"
                        }
                    }
                }
            }

            var chart = new ApexCharts(
                document.querySelector("#apex-column-1"),
                options
            );

            chart.render();
        });
</script>

