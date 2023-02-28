$(function () {
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
    StudentLeave_tabel();
    $("#stdGeneralDetails").validate({
        rules: {
            changeStdName: "required",
            to_ldate: "required",
            frm_ldate: "required",
            changelevReasons: "required"
        }
    });

    $('#stdGeneralDetails').on('submit', function (e) {
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
        var std_details = $("#stdGeneralDetails").valid();

        if (std_details === true) {
            var form = this;
            var class_id = $('option:selected', '#changeStdName').attr('data-classid');
            var section_id = $('option:selected', '#changeStdName').attr('data-sectionid');
            var student_id = $("#changeStdName").val();
            var frm_leavedate = $("#frm_ldate").val();
            var to_leavedate = $("#to_ldate").val();
            var reason = $("#changelevReasons").val();
            var reason_text = $('option:selected', '#changelevReasons').text();
            var remarks = $("#remarks").val();
            // var file = $("#file").val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('student_id', student_id);
            formData.append('frm_leavedate', frm_leavedate);
            formData.append('to_leavedate', to_leavedate);
            formData.append('reason', reason);
            formData.append('reason_text', reason_text);
            formData.append('remarks', remarks);
            // formData.append('file', file);
            formData.append('file', $('input[type=file]')[0].files[0]);

            $("#listModeClassID").val(class_id);
            $("#listModeSectionID").val(section_id);
            $("#listModestudentID").val(student_id);
            $("#listModereason").val(reason);
            $("#listModereasontext").val(reason_text);
            //
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    if (response.code == 200) {
                        $('#studentleave-table').DataTable().ajax.reload(null, false);
                        toastr.success('Leave apply sucessfully');
                        $('#stdGeneralDetails')[0].reset();
                        $("#file_name").html("");
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        };
    });
    $('#homework_file').change(function () {
        // var i = $(this).prev('label').clone();
        var file = $('#homework_file')[0].files[0].name;
        $('#file_name').html(file);
    });
    // reverse dob
    function convertDigitIn(str) {
        return str.split('-').reverse().join('-');
    }
    $(".datepick").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
    });
    // get student leave apply
    function StudentLeave_tabel() {
        $('#studentleave-table').DataTable({
            processing: true,
            bDestroy: true,
            info: true,
            // dom: 'lBfrtip',
            dom: "<'row'<'col-sm-2'l><'col-sm-2'B><'col-sm-8'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                {
                    extend: 'csv',
                    text: 'Download CSV',
                    extension: '.csv',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                }
            ],
            ajax: stutdentleaveList,
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
                }
                ,
                {
                    data: 'name',
                    name: 'name'
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
                    data: 'teacher_remarks',
                    name: 'teacher_remarks'
                },
                {
                    data: 'reason',
                    name: 'reason'
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
                // {
                //     "targets": 6,
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
                // },
                {
                    "targets": 4,
                    "render": function (data, type, row, meta) {
                        var document = "";
                        if (data && data != "null") {
                            document = data;
                        } else {
                            document = '';
                        }
                        return document;
                    }
                },
                {
                    "targets": 6,
                    "render": function (data, type, row, meta) {
                        var document = "";
                        if (data) {
                            document = '<a href="' + StudentDocUrl + '/' + data + '" download ><i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i></a>';
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
                {
                    "targets": 9,
                    "render": function (data, type, row, meta) {
                        if (row.document) {
                            return '-';
                        } else {
                            return '<div class="button-list"><a href="javascript:void(0)" class="btn btn-primary-bl waves-effect waves-light" data-id="' + row.id + '"  data-document="' + row.document + '" id="updateIssueFile">Upload</a></div>';
                        }
                    }
                },

            ]
        }).on('draw', function () {
        });
    }
    // updateIssueFile
    $(document).on('click', '#updateIssueFile', function () {
        var id = $(this).data('id');
        var document = $(this).data('document');

        var reissue_file = $("#reissue_file" + id)[0].files[0];
        // formData.append('file', $('input[type=file]')[0].files[0]);
        // return false;
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
                    // $('#studentleave-table').DataTable().ajax.reload(null, false);
                    StudentLeave_tabel();
                    toastr.success(res.message);
                }
                else {
                    toastr.error(res.message);
                }
            }
        });
    });

});