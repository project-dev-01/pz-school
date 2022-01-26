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

<!-- Init js -->
<script src="{{ asset('js/pages/bootstrap-tables.init.js') }}"></script>
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
<script src="{{ asset('js/apexChart/apexcharts.js') }}"></script>
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
                        labels: ["Physics", "Geography", "Maths", "Computer Science", "Computer", "Biology", "Chemistry"],
                        datasets: [{
                                label: "Mid Term",
                                backgroundColor: hexToRGB(colors[0], 0.3),
                                borderColor: colors[0],
                                pointBackgroundColor: colors[0],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: colors[0],
                                data: [65, 59, 90, 81, 56, 55, 40]
                            },
                            {
                                label: "Annual",
                                backgroundColor: hexToRGB(colors[1], 0.3),
                                borderColor: colors[1],
                                pointBackgroundColor: colors[1],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: colors[1],
                                data: [80, 60, 80, 75, 65, 70, 98]
                            }
                        ]
                    };
                    var radarOpts = {
                        maintainAspectRatio: false
                    };
                    charts.push(this.respChart($("#radar-chart-test-marks"), 'Radar', radarChart, radarOpts));
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
                categories: ["Akihiro", "Akiko", "Amaya", "Amida", "Cho", "Daisuke", "Eichi"],
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
    });
</script>