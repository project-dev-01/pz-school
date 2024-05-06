$(function () { 

    $("#department").on('change', function (e) {
        e.preventDefault();
        var department = $(this).val();
        $("#employee").empty();
        $("#employee").append('<option value="">'+select_employee+'</option>');
        $.post(employeeByDepartment, { token: token, branch_id: branchID, department_id: department }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#employee").append('<option value="' + val.id + '">' + val.first_name + ' ' + val.last_name + '</option>');
                });
            }
        }, 'json');
    });
    staffLeaveAssignTable();
    $("#staffLeaveAssignForm").validate({
        rules: {
            staff_id: "required",
            leave_type: "required",
            leave_days: "required",
            academic_session_id: "required",
        }
    });
    $("#edit-staff-leave-assign-form").validate({
        rules: {
            staff_id: "required",
            leave_type: "required",
            leave_days: "required",
            academic_session_id: "required",
        }
    });
    // add staffLeaveAssign
    $('#staffLeaveAssignForm').on('submit', function (e) {
        e.preventDefault();
        console.log('123')
        var leaveCheck = $("#staffLeaveAssignForm").valid();
        if (leaveCheck === true) {
            var form = this;

            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#staff-leave-assign-table').DataTable().ajax.reload(null, false);
                        $('.addStaffLeaveAssign').modal('hide');
                        $('.addStaffLeaveAssign').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all StaffLeaveAssign table
    function staffLeaveAssignTable() {
        $('#staff-leave-assign-table').DataTable({
            processing: true,
            info: true,
            bDestroy: true,
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
                    enabled: false, // Initially disable PDF button
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
            initComplete: function () {
                var table = this;
                $.ajax({
                    url: staffLeaveAssignList,
                    data: function (d) {
                        d.department = $('#department').val(),
                            d.employee = $('#employee').val()
                    },
                    success: function(data) {
                        console.log(data.data.length);
                        if (data && data.data.length > 0) {
                            console.log('ok');
                            $('#staff-leave-assign-table_wrapper .buttons-csv').removeClass('disabled');
                            $('#staff-leave-assign-table_wrapper .buttons-pdf').removeClass('disabled');  // Enable all buttons if at least one record exists
                        } else {
                            console.log(data);
                            $('#staff-leave-assign-table_wrapper .buttons-csv').addClass('disabled');
                            $('#staff-leave-assign-table_wrapper .buttons-pdf').addClass('disabled');               
                        }
                    },
                    error: function() {
                        console.log('error');
                        // Handle error if necessary
                    }
                });
            },
            ajax: {
                url: staffLeaveAssignList,
                data: function (d) {
                    d.department = $('#department').val(),
                        d.employee = $('#employee').val()
                }
            },
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
                }
                ,
                {
                    data: 'staff_name',
                    name: 'staff_name'
                },
                {
                    data: 'leave_type',
                    name: 'leave_type'
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
    }
    // get row
    $(document).on('click', '#editStaffLeaveAssignBtn', function () {
        var id = $(this).data('id');

        $('.editStaffLeaveAssign').find('form')[0].reset();
        $.post(staffLeaveAssignDetails, { id: id }, function (data) {
            $('.editStaffLeaveAssign').find('input[name="id"]').val(data.data.id);
            $('.editStaffLeaveAssign').find('select[name="staff_id"]').val(data.data.staff_id);
            $('.editStaffLeaveAssign').find('select[name="leave_type"]').val(data.data.leave_type);
            $('.editStaffLeaveAssign').find('input[name="leave_days"]').val(data.data.leave_days);
            $('.editStaffLeaveAssign').find('select[name="academic_session_id"]').val(data.data.academic_session_id);
            $('.editStaffLeaveAssign').modal('show');
        }, 'json');
        console.log(id);
    });
    // update StaffLeaveAssign
    $('#edit-staff-leave-assign-form').on('submit', function (e) {
        
        $('.leave_days').each(function () {
            $(this).rules("add", {
                required: true
            })
        });
        e.preventDefault();
        var edt_leaveCheck = $("#edit-staff-leave-assign-form").valid();
        if (edt_leaveCheck === true) {

            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 0) {
                        $.each(data.error, function (prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {

                        if (data.code == 200) {
                            toastr.success(data.message);
                            window.location.href = staffLeaveAssignIndex;
                        } else {
                            toastr.error(data.message);
                            window.location.href = staffLeaveAssignIndex;
                        }
                    }
                }
            });
        }
    });
    // delete StaffLeaveAssignDelete
    $(document).on('click', '#deleteStaffLeaveAssignBtn', function () {
        var id = $(this).data('id');
        var url = staffLeaveAssignDelete;
        swal.fire({
            title: deleteTitle + '?',
            html: deleteHtml,
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonText: deletecancelButtonText,
            confirmButtonText: deleteconfirmButtonText,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#556ee6',
            width: 400,
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                $.post(url, {
                    id: id
                }, function (data) {
                    if (data.code == 200) {
                        $('#staff-leave-assign-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    $("#staffLeaveAssignFilter").validate({
        rules: {
            department: "required",
        }
    });
    $('#staffLeaveAssignFilter').on('submit', function (e) {
        e.preventDefault();
        var department = $("#department").val(); 
        var employee = $("#employee").val();
        var classObj = {
            department: department,
            employee:employee
        };
        setLocalStorageadminstaffLeaveAssign(classObj);
        var filterCheck = $("#staffLeaveAssignFilter").valid();

        if (filterCheck === true) {
            staffLeaveAssignTable();
        }

    });
    
    function setLocalStorageadminstaffLeaveAssign(classObj) {

        var adminstaffLeaveAssignDetails = new Object();
        adminstaffLeaveAssignDetails.department = classObj.department;
        adminstaffLeaveAssignDetails.employee = classObj.employee;
        // here to attached to avoid localStorage other users to add
        adminstaffLeaveAssignDetails.branch_id = branchID;
        adminstaffLeaveAssignDetails.role_id = get_roll_id;
        adminstaffLeaveAssignDetails.user_id = ref_user_id;
        var  adminstaffLeaveAssignClassArr = [];
        adminstaffLeaveAssignClassArr.push(adminstaffLeaveAssignDetails);
        if (get_roll_id == "2") {
            // Admin
            
            localStorage.removeItem("admin_staffleaveassign_details");
            localStorage.setItem('admin_staffleaveassign_details', JSON.stringify(adminstaffLeaveAssignClassArr));
        }
        return true;
    }
    if (get_roll_id == "2") {
        if (typeof admin_staffleaveassign_storage !== 'undefined') {
            if ((admin_staffleaveassign_storage)) {
                if (admin_staffleaveassign_storage) {
    
                    console.log('test')
                    var adminstaffleaveassignStorage = JSON.parse(admin_staffleaveassign_storage);
                    if (adminstaffleaveassignStorage.length == 1) {
                        var department, employee, userBranchID, userRoleID, userID;
                        adminstaffleaveassignStorage.forEach(function (user) {
                            department = user.department;
                            employee = user.employee;
                            userBranchID = user.branch_id;
                            userRoleID = user.role_id;
                            userID = user.user_id;
                        });
                        if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                            $("#department").val(department);
                            $("#employee").empty();
                            $("#employee").append('<option value="">'+select_employee+'</option>');
                            $.post(employeeByDepartment, { token: token, branch_id: branchID, department_id: department }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        var selected=(employee==val.id)?'Selected':'';
                                        $("#employee").append('<option value="' + val.id + '" '+ selected +'>' + val.first_name + ' ' + val.last_name + '</option>');
                                    });
                                }
                            }, 'json');
                            staffLeaveAssignTable();                            
                        }
                    }
                }
            }
        }
    }
});