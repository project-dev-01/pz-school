$(function () {
    $('#releive-all-leave-list').DataTable({
        processing: true,
        info: true,
        // dom: 'lBfrtip',
        dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "language": {

            "emptyTable": no_data_available,
            "infoFiltered": filter_from_total_entries,
            "zeroRecords": no_matching_records_found,
            "infoEmpty": showing_zero_entries,
            "info": showing_entries,
            "lengthMenu": show_entries,
            "search": datatable_search,
            "paginate": {
                "next": next,
                "previous": previous
            },
        },
        buttons: [
            {
                extend: 'csv',
                text: downloadcsv,
                extension: '.csv',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }
            },
            {
                extend: 'pdf',
                text: downloadpdf,
                extension: '.pdf',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }

            }
        ],
        ajax: AllLeaveList,
        "pageLength": 10,
        "aLengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
        columns: [
            {
                searchable: false,
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'leave_type_name',
                name: 'leave_type_name'
            },
            {
                data: 'total_leave',
                name: 'total_leave'
            },
            {
                data: 'from_leave',
                name: 'from_leave'
            },
            {
                data: 'to_leave',
                name: 'to_leave'
            },
            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false
            },
        ]
    }).on('draw', function () {
    });
    //reliefAssign
    $(document).on('click', '#reliefAssign', function () {
        var leave_id = $(this).data('id');
        var staff_id = $(this).data('staff_id');
        var from_date = $(this).data('from_date');
        var to_date = $(this).data('to_date');

        // console.log(leave_id);
        // console.log(staff_id);
        // console.log(from_date);
        // console.log(to_date);
        // staffLeaveDetailsShowUrl
        var formData = new FormData();
        formData.append('token', token);
        formData.append('branch_id', branchID);
        formData.append('academic_session_id', academic_session_id);
        formData.append('staff_id', staff_id);
        formData.append('from_date', from_date);
        formData.append('to_date', to_date);
        // formData.append('from_date', '2022-08-30');
        // formData.append('to_date', '2022-09-01');
        $.ajax({
            url: getSubjectsByStaffIdWithDateUrl,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (res) {
                $("#staffLeaveDetails").empty();
                var reliefDetailsTable = "";
                if (res.code == 200) {
                    var dataset = res.data;
                    // var dataset = res.data.leave_teacher;
                    // var teacherList = res.data.teacher;
                    var size = Object.keys(dataset).length;
                    $('#reliefDetailsModal').modal('show');
                    if (size > 0) {
                        Object.keys(dataset).forEach(key => {
                            let leaveDate = moment(key).format('DD-MMM-YYYY');
                            reliefDetailsTable += '<h4 class="header-title">' + leaveDate + '</h4>';
                            reliefDetailsTable += '<div class="table-responsive">' +
                                '<table class="table table-striped table-nowrap">' +
                                '<thead>' +
                                '<tr>' +
                                '<th>' + sl_no_lang + '</th>' +
                                '<th>' + grade_lang + '</th>' +
                                '<th>' + class_lang + '</th>' +
                                '<th>' + subject_name_lang + '</th>' +
                                '<th>' + class_start_lang + '</th>' +
                                '<th>' + class_end_lang + '</th>' +
                                '<th>' + assign_to_lang + '</th>' +
                                '<th>' + action_lang + '</th>' +
                                '</tr>' +
                                '</thead>' +
                                '<tbody>';
                            var reliefSub = dataset[key];
                            let i = 1;
                            if (reliefSub.length > 0) {
                                reliefSub.forEach(function (resp) {
                                    // short test table div start
                                    // let start = moment(resp.start).format('DD-MMM-YYYY hh:mm A');
                                    // let end = moment(resp.end).format('DD-MMM-YYYY hh:mm A');
                                    let start = moment(resp.start).format('hh:mm A');
                                    let end = moment(resp.end).format('hh:mm A');
                                    reliefDetailsTable += '<tr>';
                                    reliefDetailsTable += '<td>' + (i++) + '</td>';
                                    reliefDetailsTable += '<td>' + resp.class_name + '</td>';
                                    reliefDetailsTable += '<td>' + resp.section_name + '</td>';
                                    reliefDetailsTable += '<td>' + resp.subject_name + '</td>';
                                    reliefDetailsTable += '<td>' + start + '</td>';
                                    reliefDetailsTable += '<td>' + end + '</td>';
                                    reliefDetailsTable += '<td><select class="form-control" id="relief_assignment_teacher_id' + resp.id + '">';
                                    reliefDetailsTable += '<option value="">' + select_subject + '</option>';
                                    // reliefDetailsTable += allStaffList;
                                    // console.log(resp.start + '' + resp.end);
                                    // console.log(resp.end);
                                    var teacherList = "";
                                    var teacherList = resp.teacherList;
                                    teacherList.forEach(function (teac) {
                                        if (teac.id == resp.assigned_teacher_id) {
                                            reliefDetailsTable += '<option value="' + teac.id + '" selected>' + teac.teacher_name + '(' + teac.department_name + ')' + '</option>';
                                        } else {
                                            reliefDetailsTable += '<option value="' + teac.id + '">' + teac.teacher_name + '(' + teac.department_name + ')' + '</option>';
                                        }
                                    });
                                    reliefDetailsTable += '</select></td>';
                                    reliefDetailsTable += '<td><button type="button" class="btn btn-primary-bl waves-effect waves-light" data-id="' + resp.id + '" id="assignNewTeacher">Save</button></td>';
                                    reliefDetailsTable += '</tr>';
                                });

                            }
                            reliefDetailsTable += '</tbody>' +
                                '</table></div>';
                        });
                    } else {
                        reliefDetailsTable += '<div class="table-responsive">' +
                            '<table class="table table-striped table-nowrap">' +
                            '<thead>' +
                            '<tr>' +
                            '<th>' + sl_no_lang + '</th>' +
                            '<th>' + grade_lang + '</th>' +
                            '<th>' + class_lang + '</th>' +
                            '<th>' + subject_name_lang + '</th>' +
                            '<th>' + class_start_lang + '</th>' +
                            '<th>' + class_end_lang + '</th>' +
                            '<th>' + assign_to_lang + '</th>' +
                            '<th>' + action_lang + '</th>' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody>';
                        reliefDetailsTable += '<tr><td colspan="8" class="text-center">' + no_data_available + '</td></tr>';
                        reliefDetailsTable += '</tbody>' +
                            '</table></div>';
                    }
                    $("#staffLeaveDetails").append(reliefDetailsTable);
                } else {
                    toastr.error(res.message);
                }
            }
        });
    });
    // assign teacher
    $(document).on('click', '#assignNewTeacher', function () {
        var calendar_id = $(this).data('id');
        var relief_assignment_teacher_id = $("#relief_assignment_teacher_id" + calendar_id).val();

        // console.log("---");
        // console.log(calendar_id);
        // console.log(relief_assignment_teacher_id);
        var formData = new FormData();
        formData.append('token', token);
        formData.append('branch_id', branchID);
        // formData.append('academic_session_id', academic_session_id);
        formData.append('calendar_id', calendar_id);
        formData.append('relief_assignment_teacher_id', relief_assignment_teacher_id);
        $.ajax({
            url: reliefAssignmentOtherTeacher,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (respp) {
                if (respp.code == 200) {
                    toastr.success(respp.message);
                }
                else {
                    toastr.error(respp.message);
                }
            }, error: function (err) {
                toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
            }
        });
    });
});