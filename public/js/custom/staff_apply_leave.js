$(function () {
    // $(".number_validation").keypress(function(){
    //     console.log(123)
    //     var regex = new RegExp("^[0-9-+]");
    //     var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
    //     if (!regex.test(key)) {
    //         event.preventDefault();
    //         return false;
    //     }
    // });
    $("#start_time, #end_time").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "h:i K", // 12-hour format with AM/PM
    });

    // check min data validation
    var check_in_date = flatpickr("#start_time", {
        enableTime: !0, noCalendar: !0, dateFormat: "H:i",
        onChange: function (selectedDates, dateStr, instance) {
            check_out_date.set('minTime', selectedDates[0]);
            $("#end_time").val("");
        }
    });

    var check_out_date = flatpickr("#end_time", {
        enableTime: !0, noCalendar: !0, dateFormat: "H:i"
    });
    $('#leave_request').on('change', function (e) {
        var daysOrHour = $('#leave_request').val();
        if (daysOrHour == "Hours") {
            // let fromDateval = $(".taskfromDate").val();
            // $(".taskToDate").val(fromDateval);
            $(".dateSlotShow").hide();
            $(".timeSlotShow").show();
        } else {
            $(".dateSlotShow").show();
            $(".timeSlotShow").hide();
        }
    });
    $("#leave_date").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
        minDate: 0
    });
    $("#frm_ldate").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
        minDate: 0
    });
    $("#to_ldate").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
        minDate: 0
    });
    // StudentLeave_tabel();
    // reverse dob
    function convertDigitIn(str) {
        return str.split('-').reverse().join('-');
    }

    $("#staffLeaveApply").validate({
        rules: {
            leave_type: "required",
            changeStdName: "required",
            to_ldate: "required",
            frm_ldate: "required",
            changelevReasons: "required",
            total_leave: "required",
            leave_date: "required",
            start_time: "required",
            end_time: "required",
            
        }
    });

    $('#staffLeaveApply').on('submit', function (e) {
        e.preventDefault();

        var start = convertDigitIn($("#frm_ldate").val());
        var end = convertDigitIn($("#to_ldate").val());
        let startDate = new Date(start);
        let endDate = new Date(end);
        if (startDate > endDate) {
            toastr.error("To date should be greater than leave from");
            $("to_ldate").val("");
            return false;
        }
        var std_details = $("#staffLeaveApply").valid();
        // console.log("std_details")
        // console.log(std_details)
        // return false;
        if (std_details === true) {
            // Disable submit button and change text to "Please wait..."
            $('#submitButton').prop('disabled', true).text('Please wait...');

            var form = this;
            var leave_type = $("#leave_type").val();
            var frm_leavedate = $("#frm_ldate").val();
            var to_leavedate = $("#to_ldate").val();
            var reason = $("#changelevReasons").val();
            var total_leave = $("#total_leave").val();
            var remarks = $("#remarks").val();
            var leave_request = $("#leave_request").val();
            var leave_date = $("#leave_date").val();
            var start_time = $("#start_time").val();
            var end_time = $("#end_time").val();

            // var classObj = {
            //     leave_type: leave_type,
            //     reason: reason,
            //     academic_session_id: academic_session_id,
            //     userID: userID,
            // };
            // setLocalStorageForLeaveApply(classObj);

            var formData = new FormData();
            formData.append('staff_id', ref_user_id);
            formData.append('leave_type', leave_type);
            formData.append('from_leave', frm_leavedate);
            formData.append('to_leave', to_leavedate);
            formData.append('reason', reason);
            formData.append('remarks', remarks);
            formData.append('total_leave', total_leave);
            formData.append('leave_request', leave_request);
            formData.append('leave_date', leave_date);
            formData.append('start_time', start_time);
            formData.append('end_time', end_time);
            formData.append('academic_session_id', academic_session_id);
            // formData.append('file', file);
            formData.append('file', $('input[type=file]')[0].files[0]);
            // Display the key/value pairs
            // for (var pair of formData.entries()) {
            //     console.log(pair[0] + ', ' + pair[1]);
            // }
            // return false;
            //
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                // data: new FormData(form),
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    if (response.code == 200) {
                        $('#staff-leave-list').DataTable().ajax.reload(null, false);
                        toastr.success('Leave apply sucessfully');
                        $('#staffLeaveApply')[0].reset();
                        // $("#remarks_div").hide();
                        // $('#file_name').text("");
                        $("#file_name").html("");
                        location.reload();
                    } else {
                        toastr.error(response.message);
                        // $("#remarks_div").hide();
                    }
                    // Enable submit button and restore original text
                    $('#submitButton').prop('disabled', false).text('Submit');

                }
            });
        };
    });

    // function setLocalStorageForLeaveApply(classObj) {

    //     var leaveApplyDetails = new Object();
    //     leaveApplyDetails.reason = classObj.reason;
    //     leaveApplyDetails.leave_type = classObj.leave_type;
    //     // here to attached to avoid localStorage other users to add
    //     leaveApplyDetails.branch_id = branchID;
    //     leaveApplyDetails.role_id = get_roll_id;
    //     leaveApplyDetails.user_id = ref_user_id;
    //     var leaveApplyClassArr = [];
    //     leaveApplyClassArr.push(leaveApplyDetails);
    //     if (get_roll_id == "4") {
    //         // teacher
    //         localStorage.removeItem("teacher_leave_apply_details");
    //         localStorage.setItem('teacher_leave_apply_details', JSON.stringify(leaveApplyClassArr));
    //     }
    //     return true;
    // }
    // if localStorage
    // if (typeof teacher_leave_apply_storage !== 'undefined') {
    //     if ((teacher_leave_apply_storage)) {
    //         if (teacher_leave_apply_storage) {
    //             var teacherLeaveApplyStorage = JSON.parse(teacher_leave_apply_storage);
    //             if (teacherLeaveApplyStorage.length == 1) {
    //                 var leave_type, reason, userBranchID, userRoleID, userID;
    //                 teacherLeaveApplyStorage.forEach(function (user) {
    //                     leave_type = user.leave_type;
    //                     reason = user.reason;
    //                     userBranchID = user.branch_id;
    //                     userRoleID = user.role_id;
    //                     userID = user.user_id;
    //                 });
    //                 if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
    //                     $("#leave_type").val(leave_type);
    //                     $("#changelevReasons").val(reason);
    //                 }
    //             }
    //         }
    //     }
    // }
    // change leave reasons
    // $('#changelevReasons').on('change', function () {
    //     var Reasons = $("#changelevReasons").val();
    //     console.log(Reasons);
    //     if (Reasons == 3) {
    //         $("#remarks_div").show();
    //     }
    //     else {
    //         $("#remarks_div").hide();
    //     }
    // });
    $('#leave_file').change(function () {
        var file = $('#leave_file')[0].files[0];
        if (file.size > 10485760) { // 10MB = 10 * 1024 * 1024 bytes
            $('#file_name').text("File greater than 10Mb");
            $("#file_name").addClass("error");
            $('#leave_file').val('');
        } else {
            $("#file_name").removeClass("error");
            $('#file_name').text(file.name);
        }
    });


    $(document).on('change', '.reissue_file', function () {
        console.log(12343333)
        var file = $(this)[0].files[0];
        if (file.size > 10485760) { // 10MB = 10 * 1024 * 1024 bytes
            toastr.error("File greater than 10Mb");
            $(this).val('');
        }
    });
    $(".datepick").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
    });
    // get student leave apply
    $('#staff-leave-list').DataTable({
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
                charset: 'utf-8',
                bom: true,
                exportOptions: {
                    columns: 'th:not(:last-child)'
                },
                enabled: false, // Initially disable CSV button
            },
            {
                extend: 'pdf',
                text: downloadpdf,
                extension: '.pdf',
                charset: 'utf-8',
                bom: true,
                exportOptions: {
                    columns: 'th:not(:last-child)'
                },
                enabled: false, // Initially disable PDF button

                customize: function (doc) {
                    doc.pageMargins = [50, 50, 50, 50];
                    doc.defaultStyle.fontSize = 10;
                    doc.styles.tableHeader.fontSize = 12;
                    doc.styles.title.fontSize = 14;
                    // Remove spaces around page title
                    doc.content[0].text = doc.content[0].text.trim();
                    /*// Create a Header
                    doc['header']=(function(page, pages) {
                        return {
                            columns: [
                                
                                {
                                    // This is the right column
                                    bold: true,
                                    fontSize: 20,
                                    color: 'Blue',
                                    fillColor: '#fff',
                                    alignment: 'center',
                                    text: header_txt
                                }
                            ],
                            margin:  [50, 15,0,0]
                        }
                    });*/
                    // Create a footer

                    doc['footer'] = (function (page, pages) {
                        return {
                            columns: [
                                { alignment: 'left', text: [footer_txt], width: 400 },
                                {
                                    // This is the right column
                                    alignment: 'right',
                                    text: ['page ', { text: page.toString() }, ' of ', { text: pages.toString() }],
                                    width: 100

                                }
                            ],
                            margin: [50, 0, 0, 0]
                        }
                    });

                }

            }
        ],
        initComplete: function () {
            var table = this;
            $.ajax({
                url: StaffLeaveList,
                success: function(data) {
                    console.log(data.data.length);
                    if (data && data.data.length > 0) {
                        console.log('ok');
                        $('#staff-leave-list_wrapper .buttons-csv').removeClass('disabled');
                        $('#staff-leave-list_wrapper .buttons-pdf').removeClass('disabled');  // Enable all buttons if at least one record exists
                    } else {
                        console.log(data);
                        $('#staff-leave-list_wrapper .buttons-csv').addClass('disabled');
                        $('#staff-leave-list_wrapper .buttons-pdf').addClass('disabled');               
                    }
                },
                error: function() {
                    console.log('error');
                    // Handle error if necessary
                }
            });
        },
        ajax: StaffLeaveList,
        "pageLength": 10,
        "aLengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
        columns: [
            {
                "targets": 0,
                "render": function (data, type, row, meta) {
                    return meta.row + 1;
                }
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
                data: 'from_leave',
                name: 'from_leave'
            },
            {
                data: 'to_leave',
                name: 'to_leave'
            },
            {
                data: 'reason_name',
                name: 'reason_name'
            },
            {
                data: 'document',
                name: 'document'
            },
            {
                data: 'level_one_staff_remarks',
                name: 'level_one_staff_remarks'
            },
            {
                data: 'remarks',
                name: 'remarks'
            },
            {
                data: 'status',
                name: 'status',
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false
            },
        ],
        columnDefs: [
            {
                "targets": 6,
                "render": function (data, type, row, meta) {
                    var document = "";
                    if (data) {
                        document = '<a href="' + StaffDocUrl + data + '" download ><i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i></a>';
                    } else {
                        document = '<div>' +
                            '<input type="file" id="reissue_file' + row.id + '" name="file" class="reissue_file">' +
                            '</div>';
                    }
                    return document;
                }
            },
            {
                "targets": 9,
                "render": function (data, type, row, meta) {
                    console.log("data");
                    console.log(data);
                    var badgeColor = "";
                    if (data == "Approve") {
                        badgeColor = "badge-success";
                    }
                    if (data == "Reject") {
                        badgeColor = "badge-danger";
                    }
                    if (data == "Pending") {
                        badgeColor = "badge-warning";
                    }
                    var status = '<span class="badge ' + badgeColor + ' badge-pill">' + data + '</span>';
                    return status;
                }
            },
            // {
            //     "targets": 8,
            //     "render": function (data, type, row, meta) {
            //         if (row.status != "Approve") {
            //             var fileUpload = '<div>' +
            //                 '<input type="file" id="reissue_file' + row.id + '" name="file">' +
            //                 '</div>';
            //         } else {
            //             fileUpload = "<p style='text-align: center;''>-</p>";
            //         }

            //         return fileUpload;
            //     }
            // }
        ]
    }).on('draw', function () {
    });
    // updateIssueFile
    $(document).on('click', '#updateIssueFile', function () {
        var id = $(this).data('id');
        var document = $(this).data('document');

        var reissue_file = $("#reissue_file" + id)[0].files[0];
        // formData.append('file', $('input[type=file]')[0].files[0]);

        var formData = new FormData();
        formData.append('id', id);
        formData.append('document', document);
        formData.append('file', reissue_file);
        $.ajax({
            url: reuploadFileUrl,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (res) {
                if (res.code == 200) {
                    $('#staff-leave-list').DataTable().ajax.reload(null, false);
                    toastr.success(res.message);
                }
                else {
                    toastr.error(res.message);
                }
            }
        });
    });
    const getBusinessDays = (startDate, endDate) => {
        const start = new Date(startDate);
        const end = new Date(endDate);
        const current = new Date(startDate);
        const dates = [];

        while (current <= end) {
            if (current.getDay() !== 6 && current.getDay() !== 0) {
                dates.push(new Date(current));
            }

            current.setDate(current.getDate() + 1);
        }

        return dates.length;
    }
    $("#to_ldate").on('change', function () {
        let frm_ldate = $("#frm_ldate").val();
        let to_ldate = $("#to_ldate").val();
        const businessDays = getBusinessDays(convertDigitIn(frm_ldate), convertDigitIn(to_ldate));
        $("#total_leave").val(businessDays);
    });
    // reverse dob
    function convertDigitIn(str) {
        return str.split('-').reverse().join('-');
    }
});