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
            for (var pair of formData.entries()) {
                console.log(pair[0] + ', ' + pair[1]);
            }
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
                        $("#remarks_div").hide();
                    } else {
                        toastr.error(response.message);
                        $("#remarks_div").hide();
                    }
                }
            });
        };
    });
    // change leave reasons
    $('#changelevReasons').on('change', function () {
        var Reasons = $("#changelevReasons").val();
        console.log(Reasons);
        if (Reasons == 3) {
            $("#remarks_div").show();
        }
        else {
            $("#remarks_div").hide();
        }
    });
    $(".datepick").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    // get student leave apply
    $('#staff-leave-list').DataTable({
        processing: true,
        info: true,
        ajax: StaffLeaveList,
        "pageLength": 5,
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
                    if (row.status != "Approve") {
                        var fileUpload = '<div>' +
                            '<input type="file" id="reissue_file' + row.id + '" name="file">' +
                            '</div>';
                    } else {
                        fileUpload = "<p style='text-align: center;''>-</p>";
                    }

                    return fileUpload;
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
        ]
    }).on('draw', function () {
    });
    // updateIssueFile
    $(document).on('click', '#updateIssueFile', function () {
        var id = $(this).data('id');
        var document = $(this).data('document');

        var reissue_file = $("#reissue_file" + id)[0].files[0];
        // formData.append('file', $('input[type=file]')[0].files[0]);

        console.log(id);
        console.log(document);
        console.log(reissue_file);

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