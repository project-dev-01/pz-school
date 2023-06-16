$(function () {
    AllLeaveListShow(leave_status = "All");
    // get all leave list
    function AllLeaveListShow(leave_status) {
        $('#all-leave-list').DataTable({
            processing: true,
            bDestroy: true,
            // dom: 'Bfrtip',
            // buttons: [
            //     'copyHtml5',
            //     'excelHtml5',
            //     'csvHtml5',
            //     'pdfHtml5'
            // ],
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

            
                customize: function (doc) {
                doc.pageMargins = [50,50,50,50];
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
                
                doc['footer']=(function(page, pages) {
                    return {
                        columns: [
                            { alignment: 'left', text: [ footer_txt ],width:400} ,
                            {
                                // This is the right column
                                alignment: 'right',
                                text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }],
                                width:100

                            }
                        ],
                        margin: [50, 0,0,0]
                    }
                });
                
            }
        }
            ],
            "ajax": {
                url: AllLeaveList,
                cache: false,
                dataType: "json",
                // data: { month:getSelectedMonth },
                // data: formData,
                data: { staff_id: ref_user_id, leave_status: leave_status },
                type: "GET",
                // contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                // processData: true, // NEEDED, DON'T OMIT THIS
                // headers: {
                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                "dataSrc": function (json) {
                    return json.data;
                },
                error: function (error) {
                    // console.log("error")
                    // console.log(error)
                    // noDataAvailable(error);
                }
            },

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
                // {
                //     data: 'assiner_remarks',
                //     name: 'assiner_remarks'
                // },
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
                    "targets": 3,
                    "render": function (data, type, row, meta) {
                        return data;
                    }
                },
                {
                    "targets": 8,
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
                    "targets": 7,
                    "render": function (data, type, row, meta) {
                        var document = '<a href="' + leaveFilesUrl + '/' + data + '" download name="student_leave_upd[' + meta.row + ']"><i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i></a>';
                        return document;
                    }
                },
                // {
                //     "targets": 9,
                //     "render": function (data, type, row, meta) {

                //         var addremarks = '<textarea style="display:none;" class="addRemarksAdmin" data-id="' + row.id + '" id="addRemarksAdmin' + row.id + '" >' + (row.assiner_remarks !== "null" ? row.assiner_remarks : "") + '</textarea>' +
                //             '<button type="button" data-id="' + row.id + '" class="btn btn-outline-info waves-effect waves-light" data-toggle="modal" data-target="#LeaveRemarksPopup">Add Remarks</button>';
                //         return addremarks;
                //     }
                // }
            ]
        }).on('draw', function () {
        });
    }
    // add remarks model
    $('#LeaveRemarksPopup').on('show.bs.modal', e => {
        $("#leave_remarks").focus();
        var $button = $(e.relatedTarget);
        var lev_tbl_ID = $button.attr('data-id');
        var levRemarks = $button.closest('td').find('textarea').val();
        var checknullRemarks = (levRemarks !== "null") ? levRemarks : "";
        $("#leave_tbl_id").val(lev_tbl_ID);
        $("#leave_remarks").val(checknullRemarks);
    });

    $('#leave_RemarksSave').on('click', function () {
        var studenetlevtblID = $('#leave_tbl_id').val();
        var leave_remarks = $('#leave_remarks').val();
        var compain_remarks_tblID = leave_remarks;
        $('#addRemarksAdmin' + studenetlevtblID).val(compain_remarks_tblID);
        $('#LeaveRemarksPopup').modal('hide');
    });
    // approved leave
    // $(document).on('click', '#approvedLeave', function () {
    //     var leave_id = $(this).data('id');
    //     var status = $("#leavestatus" + leave_id).val();

    //     var assiner_remarks = $("#addRemarksAdmin" + leave_id).val();

    //     var formData = new FormData();
    //     formData.append('token', token);
    //     formData.append('branch_id', branchID);
    //     formData.append('leave_id', leave_id);
    //     formData.append('status', status);
    //     formData.append('assiner_remarks', assiner_remarks);
    //     formData.append('staff_id', ref_user_id);
    //     // for(var pair of formData.entries()){
    //     //     console.log(pair[0]+ ', ' + pair[1]); 
    //     // }
    //     // return false;
    //     $.ajax({
    //         url: leaveApprovedUrl,
    //         method: "post",
    //         data: formData,
    //         processData: false,
    //         dataType: 'json',
    //         contentType: false,
    //         success: function (res) {
    //             if (res.code == 200) {
    //                 $('#all-leave-list').DataTable().ajax.reload(null, false);
    //                 toastr.success(res.message);
    //             }
    //             else {
    //                 toastr.error(res.message);

    //             }
    //         }
    //     });

    // });
    $(document).on('click', '#approvedLeave', function () {
        var leave_id = $("#leave_id").val();
        var status = $("#leave_status_name").val();

        var assiner_remarks = $("#assiner_remarks").val();

        var formData = new FormData();
        formData.append('token', token);
        formData.append('branch_id', branchID);
        formData.append('academic_session_id', academic_session_id);
        formData.append('leave_id', leave_id);
        formData.append('status', status);
        formData.append('assiner_remarks', assiner_remarks);
        formData.append('staff_id', ref_user_id);
        $.ajax({
            url: leaveApprovedUrl,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (res) {
                if (res.code == 200) {
                    toastr.success(res.message);
                    $('#all-leave-list').DataTable().ajax.reload(null, false);
                    $('#DetailsModal').modal('hide');
                }
                else {
                    toastr.error(res.message);
                }
            }
        });

    });
    //viewDetails
    $(document).on('click', '#viewDetails', function () {
        var leave_id = $(this).data('id');
        var staff_id = $(this).data('staff_id');
        // staffLeaveDetailsShowUrl
        var formData = new FormData();
        formData.append('token', token);
        formData.append('branch_id', branchID);
        formData.append('leave_id', leave_id);
        formData.append('staff_id', staff_id);
        formData.append('academic_session_id', academic_session_id);

        $.ajax({
            url: staffLeaveDetailsShowUrl,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (res) {
                if (res.code == 200) {
                    // $('#all-leave-list').DataTable().ajax.reload(null, false);
                    // toastr.success(res.message);
                    // DetailsModal
                    var leave_details = res.data.leave_details;
                    var leave_type_details = res.data.leave_type_details;
                    $('#DetailsModal').modal('show');
                    $('#leave_id').val(leave_details.id);
                    $('#staffName').html(leave_details.name);
                    $('#leaveDates').html(leave_details.from_leave + " / " + leave_details.to_leave);
                    $('#noOfDays').html(leave_details.date_diff + 1);
                    $('#applyDate').html(leave_details.created_at);
                    $('#leaveType').html(leave_details.leave_type_name);
                    $('#reason').html(leave_details.reason_name);
                    // document
                    var badgeColor = "";
                    if (leave_details.status == "Approve") {
                        badgeColor = "badge-success";
                    }
                    if (leave_details.status == "Reject") {
                        badgeColor = "badge-danger";
                    }
                    if (leave_details.status == "Pending") {
                        badgeColor = "badge-warning";
                    }
                    var status = '<span class="badge ' + badgeColor + ' badge-pill">' + leave_details.status + '</span>';
                    var document = '<a href="' + leaveFilesUrl + '/' + leave_details.document + '" download ><i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i></a>';
                    $('#documents').html(document);
                    $('#remarks').html(leave_details.remarks);
                    $('#leave_status').html(status);
                    // set value
                    $('#assiner_remarks').val(leave_details.assiner_remarks);
                    $('#leave_status_name').val(leave_details.status);
                    $('#alreadyTakenLeave tbody').empty();
                    // $('#myModal').modal('hide');
                    var takenLeaveDetails = "";
                    if (leave_type_details.length > 0) {
                        $.each(leave_type_details, function (key, val) {
                            var used_leave = 0;
                            if(val.used_leave){
                                used_leave = val.used_leave;
                            }
                            var bal = val.total_leave - val.used_leave;
                            takenLeaveDetails += '<tr>' +
                                '<td>' + val.leave_name + '</td>' +
                                '<td>' + val.total_leave + '</td>' +
                                '<td>' + used_leave + '</td>' +
                                '<td>' +  bal + '</td>' +
                                '</tr>';

                        });
                    } else {
                        takenLeaveDetails += '<tr><td colspan="4" style="text-align: center;"> '+no_data_available+'</td></tr>';

                    }
                    $('#alreadyTakenLeave tbody').append(takenLeaveDetails);
                }
                else {
                    // toastr.error(res.message);

                }
            }
        });
    });
    // all Leave Filter
    $('#allLeaveFilter').on('submit', function (e) {
        e.preventDefault();
        var leave_status = $("#changeLeaveSts").val();
        AllLeaveListShow(leave_status);
    });
});