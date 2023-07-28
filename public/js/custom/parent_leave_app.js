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
            var classObj = {
                class_id:class_id,
                section_id:section_id,
                student_id: student_id,
                frm_leavedate: frm_leavedate,
                to_leavedate: to_leavedate,
                reason: reason,
                reason_text: reason_text,
                academic_session_id: academic_session_id
            };
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
            console.log(classObj);
            setLocalStorageForparentleaveapply(classObj);
        };
    });
    function setLocalStorageForparentleaveapply(classObj) {

        var leaveapplyDetails  = new Object();
        leaveapplyDetails.class_id = classObj.class_id;
        leaveapplyDetails.section_id = classObj.section_id;
        leaveapplyDetails.student_id = classObj.student_id;
        leaveapplyDetails.frm_leavedate = classObj.frm_leavedate;
        leaveapplyDetails.to_leavedate = classObj.to_leavedate;
        leaveapplyDetails.reason = classObj.reason;
        // here to attached to avoid localStorage other users to add
        leaveapplyDetails.branch_id = branchID;
        leaveapplyDetails.role_id = get_roll_id;
        leaveapplyDetails.user_id = ref_user_id;
        var leaveapplyClassArr = [];
        leaveapplyClassArr.push(leaveapplyDetails);
        if (get_roll_id == "5") {
            // Parent
            localStorage.removeItem("parent_leaveapply_details");
            localStorage.setItem('parent_leaveapply_details', JSON.stringify(leaveapplyClassArr));
        }
        
        return true;
    }
    $('#leave_file').change(function () {
        var file = $('#leave_file')[0].files[0];
        if (file.size > 2097152) {
            $('#file_name').text("File greater than 2Mb");
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
        if (file.size > 2097152) {
            toastr.error("File greater than 2Mb");
            $(this).val('');
        }
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
                    }
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
                    title: function () {
                        return leave_status_txt;
                    },

                    customize: function (doc) {
                        doc.pageMargins = [50, 50, 50, 50];
                        doc.defaultStyle.fontSize = 10;
                        doc.styles.tableHeader.fontSize = 12;
                        doc.styles.title.fontSize = 14;
                        // Remove spaces around page title
                        doc.content[0].text = doc.content[0].text.trim();
                        // Create a Header
                        // doc['title']=(function(page, pages) {
                        //     return {
                        //         columns: [

                        //             {
                        //                 // This is the right column
                        //                 bold: true,
                        //                 fontSize: 20,
                        //                 color: 'Blue',
                        //                 fillColor: '#fff',
                        //                 alignment: 'center',
                        //                 text: leave_status_txt
                        //             }
                        //         ],
                        //         margin:  [50, 15,0,0]
                        //     }
                        // });
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
                                '<input type="file" id="reissue_file' + row.id + '" name="file" class="reissue_file">' +
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
                            return '<div class="button-list"><a href="javascript:void(0)" class="btn btn-primary-bl waves-effect waves-light" data-id="' + row.id + '"  data-document="' + row.document + '" id="updateIssueFile">' + upload_lang + '</a></div>';
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
    if (get_roll_id == "5") {
    if ((parent_leaveapply_storage)) {
        if (parent_leaveapply_storage) {
            var parentleaveapplyStorage = JSON.parse(parent_leaveapply_storage);
            if (parentleaveapplyStorage.length == 1) {
               
                var class_id, section_id, student_id,frm_leavedate, to_leavedate, reason,reason_text,userBranchID, userRoleID, userID;
                parentleaveapplyStorage.forEach(function (user) {
                    class_id = user.class_id;
                    section_id = user.section_id; 
                    student_id = user.student_id;
                    frm_leavedate = user.frm_leavedate;
                    to_leavedate = user.to_leavedate; 
                    reason = user.reason;
                    reason_text = user.reason_text;
                    userBranchID = user.branch_id;
                    userRoleID = user.role_id;
                    userID = user.user_id;
                });
                if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                  
                    $('select[name^="changeStdName"] option[value=' + student_id + ']').attr("selected","selected");
                    //$("#frm_ldate").val(frm_ldate);
                    //$("#to_ldate").val(to_ldate);
                    $("#frm_ldate").datepicker("setDate", frm_leavedate);
                    $("#to_ldate").datepicker("setDate", to_leavedate);
                    $('select[name^="changelevReasons"] option[value=' + reason + ']').attr("selected","selected");
                  
                    $("#listModeClassID").val(class_id);
                    $("#listModeSectionID").val(section_id);
                    $("#listModestudentID").val(student_id);
                    $("#listModereason").val(reason);
                    $("#listModereasontext").val(reason_text);
                }
            }
        }
    }
}
});