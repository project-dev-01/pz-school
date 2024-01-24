@extends('layouts.admin-layout')
@section('title',' ' . __('messages.work_week') . '')
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}">

<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">

@endsection
@section('content')
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<style>
    .ui-datepicker {
        width: 21.4em;
    }

    @media screen and (min-device-width: 320px) and (max-device-width: 660px) {
        .ui-datepicker {
            width: 14.4em;
        }
    }

    @media screen and (min-device-width: 360px) and (max-device-width: 740px) {
        .ui-datepicker {
            width: 17.4em;
        }
    }

    @media screen and (min-device-width: 375px) and (max-device-width: 667px) {
        .ui-datepicker {
            width: 18.6em;
        }
    }

    @media screen and (min-device-width: 390px) and (max-device-width: 844px) {
        .ui-datepicker {
            width: 19.8em;
        }
    }

    @media screen and (min-device-width: 412px) and (max-device-width: 915px) {
        .ui-datepicker {
            width: 21.5em;
        }
    }

    @media screen and (min-device-width: 540px) and (max-device-width: 720px) {
        .ui-datepicker {
            width: 31.3em;
        }
    }

    @media screen and (min-device-width: 768px) and (max-device-width: 1024px) {
        .ui-datepicker {
            width: 13.2em;
        }
    }

    @media screen and (min-device-width: 820px) and (max-device-width: 1180px) {
        .ui-datepicker {
            width: 14.3em;
        }
    }
</style>
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                </div>
                <h4 class="page-title">Dashboard Hide/Unhide</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">

            <!--Last Leave Taken -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv">Dashboard Hide/Unhide<h4>
                            </li>
                        </ul><br>

                        <div class="DemoBS2">
                            <!-- Toogle Buttons -->

                            <div>

                                <div class="container">
                                    <div class="row">
                                        <button type="button" name="add" id="add" class="btn btn-primary" style="margin: 18px;border-color: #0ABAB5;
    background-color: #6FC6CC; margin-left: 25px;margin-bottom: 0px;">Add Hide/Unhide</button>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <form name="add_name" id="add_name">
                                                    <table class="table table-borderless" id="dynamic_field">
                                                        <tr>
                                                            <td class="col-md-10">
                                                                <!-- <button type="button" name="name[]" class="form-control name_list" class="btn btn-default" data-toggle="modal" data-target="#standard-modal">+</button>-->
                                                            </td>

                                                        </tr>
                                                    </table>

                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $("#toggle-btn").click(function() {
                                        $("#toggle-example").collapse('toggle'); // toggle collapse
                                    });
                                });

                                $(document).ready(function() {

                                    var i = 1;
                                    var length;
                                    //var addamount = 0;
                                    var addamount = 700;

                                    $("#add").click(function() {

                                        // <!--
                                        // var rowIndex = $('#dynamic_field').find('tr').length;
                                        // -- >
                                        // <
                                        // !--console.log('rowIndex: ' + rowIndex);
                                        // -- >
                                        // <
                                        // !--console.log('amount: ' + addamount);
                                        // -- >
                                        // <
                                        // !--
                                        // var currentAmont = rowIndex * 700;
                                        // -- >
                                        // <
                                        // !--console.log('current amount: ' + currentAmont);
                                        // -- >
                                        // <
                                        // !--addamount += currentAmont;
                                        // -- >

                                        // addamount += 700;
                                        // console.log('amount: ' + addamount);
                                        // i++;
                                        var temp = "";

                                        // temp += '<tr id="\' + i + \'"><td class="col-md-10"><button type="button" name="name[]" class="form-control name_list" data-toggle="modal" data-target="#standard-modal" style="height: 50px;border-radius: 10px;border: 1px solid #18161652;background-color: transparent;"/>Attendance Report (Kindergarden, Grade 1, Class 1, Daily)</button></td><td class="col-md-2" style="padding:15px;"><button type="button" name="remove" id="\' + i + \'" class="glyphicon glyphicon-triangle-bottom"  style="background-color: transparent;border: 1px solid #18161652;height: 50px;border-radius: 10px;width: 45px;"><i class="fe-arrow-up"></i></button> <button type="button" name="remove" id="\' + i + \'" class="glyphicon glyphicon-triangle-bottom" style="background-color: transparent;border: 1px solid #18161652;height: 50px;border-radius: 10px;width: 45px;"> <i class="fe-arrow-down"></i></button></td></tr>';


                                        // temp += '<tr class="widget" id="' + i + '" data-id="' + i + '" data-order="' + i + '">' +
                                        //     '<td class="col-md-4">' +
                                        //     '<input type="text" placeholder="widget name" name="name[]" class="form-control" style="background-color: transparent;border: 1px solid #18161652;height: 50px;border-radius: 10px;width: 45px;"/>' +
                                        //     '</td>' +
                                        //     '<td class="col-md-10">' +
                                        //     '<button type="button" name="name[]" class="form-control name_list" data-toggle="modal" data-target="#standard-modal" style="height: 50px;border-radius: 10px;border: 1px solid #18161652;background-color: transparent;"/>' +
                                        //     'Attendance Report (Kindergarden, Grade 1, Class 1, Daily)</button>' +
                                        //     '</td>' +
                                        //     '<td class="col-md-2" style="padding:15px;">' +
                                        //     '<button type="button" onclick="moveWidget(this, "up")" name="remove" id="' + i + '" class="glyphicon glyphicon-triangle-bottom"  style="background-color: transparent;border: 1px solid #18161652;height: 50px;border-radius: 10px;width: 45px;">' +
                                        //     '<i class="fe-arrow-up"></i>' +
                                        //     '</button>' +
                                        //     '<button type="button" onclick="moveWidget(this, "down") name="remove" id="' + i + '" class="glyphicon glyphicon-triangle-bottom" style="background-color: transparent;border: 1px solid #18161652;height: 50px;border-radius: 10px;width: 45px;">' +
                                        //     '<i class="fe-arrow-down"></i>' +
                                        //     '</button>' +
                                        //     '</td>' +
                                        //     '</tr>';
                                        var temp = '<tr class="widget" id="' + i + '" data-id="' + i + '" data-order="' + i + '">' +
                                            // '<td class="col-md-4">' +
                                            // '<input type="text" placeholder="widget name" name="name[]" class="form-control" style="background-color: transparent;border: 1px solid #18161652;height: 50px;border-radius: 10px;width: 45px;"/>' +
                                            // '</td>' +
                                            '<td class="col-md-10">' +
                                            '<button type="button" name="name[]" data-widgetID="' + i + '"+ class="form-control name_list" style="height: 50px;border-radius: 10px;border: 1px solid #18161652;background-color: transparent;"/>' +
                                            '</button>' +
                                            '</td>' +
                                            '<td class="col-md-2" style="padding:15px;">' +
                                            '<button type="button" onclick="moveWidget(this, \'up\')" name="remove" id="' + i + '" class="glyphicon glyphicon-triangle-bottom"  style="background-color: transparent;border: 1px solid #18161652;height: 50px;border-radius: 10px;width: 45px;">' +
                                            '<i class="fe-arrow-up"></i>' +
                                            '</button>' +
                                            '<button type="button" onclick="moveWidget(this, \'down\')" name="remove" id="' + i + '" class="glyphicon glyphicon-triangle-bottom" style="background-color: transparent;border: 1px solid #18161652;height: 50px;border-radius: 10px;width: 45px;">' +
                                            '<i class="fe-arrow-down"></i>' +
                                            '</button>' +
                                            '</td>' +
                                            '</tr>';

                                        $('#dynamic_field').append(temp);
                                    });

                                    // function moveWidget(button, direction) {
                                    //     const widget = button.closest('.widget');
                                    //     const widgetId = widget.dataset.id;
                                    //     const widgetOrder = parseInt(widget.dataset.order);

                                    //     const otherWidget = direction === 'up' ? widget.previousElementSibling : widget.nextElementSibling;
                                    //     if (otherWidget) {
                                    //         const otherWidgetId = otherWidget.dataset.id;
                                    //         const otherWidgetOrder = parseInt(otherWidget.dataset.order);

                                    //         // Swap order values
                                    //         widget.dataset.order = otherWidgetOrder;
                                    //         otherWidget.dataset.order = widgetOrder;

                                    //         // Update visual order
                                    //         widget.style.order = otherWidgetOrder;
                                    //         otherWidget.style.order = widgetOrder;

                                    //         // Update order in the database (you need an AJAX request here)
                                    //         updateOrderInDatabase(widgetId, otherWidgetId, widgetOrder, otherWidgetOrder);
                                    //     }
                                    // }
                                    //$(document).on('click', '.btn_remove', function(){  
                                    //  addamount -= 700;
                                    // console.log('amount: ' + addamount);

                                    //  <!-- var rowIndex = $('#dynamic_field').find('tr').length;	 -->
                                    // <!-- addamount -= (700 * rowIndex); -->
                                    // <!-- console.log(addamount); -->

                                    //  var button_id = $(this).attr("id");     
                                    // $('#row'+button_id+'').remove();  
                                    // });



                                    $("#submit").on('click', function(event) {
                                        var formdata = $("#add_name").serialize();
                                        console.log(formdata);

                                        event.preventDefault()

                                        $.ajax({
                                            url: "action.php",
                                            type: "POST",
                                            data: formdata,
                                            cache: false,
                                            success: function(result) {
                                                alert(result);
                                                $("#add_name")[0].reset();
                                            }
                                        });

                                    });
                                });
                            </script>


                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>
            </div>
        </div>
    </div>

    <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Dashboard Menu</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Dashboard Details</th>
                                            <th>Action</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Attendance Report</td>
                                            <td><button class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#standard-modals">Add</button></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Calendar</td>
                                            <td><button class="btn btn-success waves-effect waves-light">Add</button></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Task</td>
                                            <td><button class="btn btn-success waves-effect waves-light">Add</button></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Student Transferred List</td>
                                            <td><button class="btn btn-success waves-effect waves-light">Add</button></td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Shortcut Links</td>
                                            <td><button class="btn btn-success waves-effect waves-light">Add</button></td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Bulletin Board</td>
                                            <td><button class="btn btn-success waves-effect waves-light">Add</button></td>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->




    <div id="standard-modals" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Add Attendance Report</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">
                                            Attendance Report
                                            <h4>
                                    </li>
                                </ul><br>
                                <br>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="facultySelect">Faculty</label>
                                                <select id="facultySelect" class="form-control" name="semester_id">
                                                    <option value="facultyA">Select the Faculty</option>
                                                    <option value="facultyB">All</option>
                                                    <option value="0">Kindergarden</option>
                                                    <option value="0">Primary</option>
                                                    <option value="0">Secondary</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="gradeSelect">Grade</label>
                                                <select id="gradeSelect" class="form-control" name="semester_id">
                                                    <option value="grade1">Select the Grade</option>
                                                    <option value="grade2">Grade 1</option>
                                                    <option value="0">Grade 2</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="classSelect">Class</label>
                                                <select id="classSelect" class="form-control" name="semester_id">
                                                    <option value="classA">Select the Class</option>
                                                    <option value="classB">Class 1</option>
                                                    <option value="0">Class 2</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="classSelect">Period</label>
                                                <select id="classSelect" class="form-control" name="semester_id">
                                                    <option value="classA">Select the period</option>
                                                    <option value="classB">Daily</option>
                                                    <option value="0">Monthly</option>
                                                    <option value="0">Semester</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Button to fetch and display attendance information -->
                                    <div class="form-group text-right m-b-0">
                                        <button class="btn btn-success waves-effect waves-light">Add</button>
                                    </div>
                                    <!-- Display the attendance information -->
                                </div>
                                <div class="">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div id="attendanceInfo">

                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end col -->

                                </div>
                                <!-- end row-->
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endsection
    @section('scripts')
    <!-- plugin js -->
    <script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
    <script>
        toastr.options.preventDuplicates = true;
    </script>
    <!-- button js added -->
    <script src="{{ asset('buttons-datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('buttons-datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('buttons-datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('buttons-datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
    <!-- validation js -->
    <script src="{{ asset('js/validation/validation.js') }}"></script>

    <script>
        // Get PDF Footer Text

        var header_txt = "{{ __('messages.all_leaves') }}";
        var footer_txt = "{{ session()->get('footer_text') }}";
        // Get PDF Header & Footer Text End
    </script>
    <script src="{{ asset('js/custom/dashboard_widget_hide.js') }}"></script>
    @endsection