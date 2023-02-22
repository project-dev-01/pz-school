$(function () {
    $("#frm_ldate").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        minDate: 0
    });
    $("#to_ldate").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
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
            changelevReasons: "required"
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

        if (std_details === true) {
            var form = this;
            var leave_type = $("#leave_type").val();
            var frm_leavedate = $("#frm_ldate").val();
            var to_leavedate = $("#to_ldate").val();
            var reason = $("#changelevReasons").val();
            var remarks = $("#remarks").val();

            var formData = new FormData();
            formData.append('staff_id', ref_user_id);
            formData.append('leave_type', leave_type);
            formData.append('from_leave', frm_leavedate);
            formData.append('to_leave', to_leavedate);
            formData.append('reason', reason);
            formData.append('remarks', remarks);
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
                    } else {
                        toastr.error(response.message);
                        // $("#remarks_div").hide();
                    }
                }
            });
        };
    });
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
    $('#homework_file').change(function () {
        // var i = $(this).prev('label').clone();
        var file = $('#homework_file')[0].files[0].name;
        $('#file_name').html(file);
    });
    $(".datepick").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    // get student leave apply
    $('#staff-leave-list').DataTable({
        processing: true,
        info: true,
        // dom: 'lBfrtip',
        dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-6'i><'col-sm-6'p>>",
        buttons: [
            {
                extend: 'csv',
                text: 'Download CSV',
                extension: '.csv',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }
            },
            {
                extend: 'pdf',
                text: 'Download PDF',
                extension: '.pdf',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }

            }
        ],
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
                        document = '<a href="' + StaffDocUrl + '/' + data + '" download ><i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i></a>';
                    } else {
                        document = '<div>' +
                            '<input type="file" id="reissue_file' + row.id + '" name="file">' +
                            '</div>';
                    }
                    return document;
                }
            },
            {
                "targets": 7,
                "render": function (data, type, row, meta) {
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

});