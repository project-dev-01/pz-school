$(function () {
    // rules validation
    $("#EmpFilter").validate({
        rules: {
            employee_type: "required"
        }
    });

    // get student list
    $('#EmpFilter').on('submit', function (e) {
        e.preventDefault();
        var EmpFilter = $("#EmpFilter").valid();
        if (EmpFilter === true) {
            var employee_type = $('#employee_type').val();
            
            var formData = {
                employee_type: employee_type,
            };
            getEmpFilter(formData);
        } else {
            $("#emp").hide("slow");
        }

    });
    function getEmpFilter(formData){
        $("#emp").show("slow");
        console.log(formData);
        $('#emp-table').DataTable({
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
                        columns: [0,1, 2, 3, 4, 5, 6, 7, 8, 9]
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
            serverSide: true,
            ajax: {
                url: employeeList,
                data: function (d) {
                    d.employee_type = formData.employee_type
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
                    data: 'emp_name',
                    name: 'emp_name'
                },
                {
                    data: 'birthday',
                    name: 'birthday'
                },
                {
                    data: 'tenure',
                    name: 'tenure'
                },
                {
                    data: 'department_name',
                    name: 'department_name'
                },
                {
                    data: 'designation_name',
                    name: 'designation_name',
                    render: function (data, type, row) {
                        if (data) {
                            return data.replace(/,/g, ' => '); // Replace all commas with arrows
                        } else {
                            return ''; // Return an empty string if data is null
                        }
                    }
                },
                {
                    data: 'employment_status',
                    name: 'employment_status'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'designation_start_date',
                    name: 'designation_start_date',
                    visible: false,  // Hide this column
                    render: function (data, type, row) {
                        if (data) {
                            return data.replace(/,/g, ' => '); // Replace all commas with arrows
                        } else {
                            return ''; // Return an empty string if data is null
                        }
                    }
                },
                {
                    data: 'designation_end_date',
                    name: 'designation_end_date',
                    visible: false,  // Hide this column
                    render: function (data, type, row) {
                        if (data) {
                            var modifiedData = data.replace(/,/g, ' => '); // Replace commas with arrows
                            console.log(modifiedData);
                        
                            if (modifiedData.includes('=>')) {
                                var parts = modifiedData.split(' => ');
                                if (parts[1].trim() === '') {
                                    parts[1] = 'Present';
                                    modifiedData = parts.join(' => ');
                                }
                            }
                            return modifiedData;
                        } else {
                            return ''; // Return an empty string if data is null
                        }
                    }
                },
                
                // {
                //     data: 'actions',
                //     name: 'actions',
                //     orderable: false,
                //     searchable: false
                // },
            ],
            columnDefs: [
                {
                    "targets": 1,
                    "className": "table-user",
                    "render": function (data, type, row, meta) {
                        var currentImg = studentImg + row.photo;
                        var img = (row.photo != null) ? currentImg : defaultImg;
                        var first_name = '<img src="' + img + '" class="mr-2 rounded-circle">' +
                            '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                        return first_name;
                    }
                },
             
            ]
        });
    }

    function setLocalStorageForStudentList(classObj) {

        var studentListDetails = new Object();
        studentListDetails.class_id = classObj.classID;
        studentListDetails.section_id = classObj.sectionID;
        studentListDetails.student_name = classObj.student_name;
        studentListDetails.session_id = classObj.sessionID;
        // here to attached to avoid localStorage other users to add
        studentListDetails.branch_id = branchID;
        studentListDetails.role_id = get_roll_id;
        studentListDetails.user_id = ref_user_id;
        var studentListClassArr = [];
        studentListClassArr.push(studentListDetails);
        if (get_roll_id == "2") {
            // admin
            localStorage.removeItem("admin_student_list_details");
            localStorage.setItem('admin_student_list_details', JSON.stringify(studentListClassArr));
        }
        if (get_roll_id == "4") {
            // teacher
            localStorage.removeItem("teacher_student_list_details");
            localStorage.setItem('teacher_student_list_details', JSON.stringify(studentListClassArr));
        }
        return true;
    }
    // if localStorage
    if (typeof student_list_storage !== 'undefined') {
        if ((student_list_storage)) {
            if (student_list_storage) {
                var studentListStorage = JSON.parse(student_list_storage);
                if (studentListStorage.length == 1) {
                    var classID, student_name,sectionID, sessionID, userBranchID, userRoleID, userID;
                    studentListStorage.forEach(function (user) {
                        classID = user.class_id;
                        student_name = user.student_name;
                        sectionID = user.section_id;
                        sessionID = user.session_id;
                        userBranchID = user.branch_id;
                        userRoleID = user.role_id;
                        userID = user.user_id;
                    });
                    if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                        $('#class_id').val(classID);
                        $("#student_name").val(student_name);
                        $('#session_id').val(sessionID);
                        if (classID) {
                            $("#section_id").empty();
                            $("#section_id").append('<option value="">' + select_class + '</option>');
                            $.post(sectionByClass, { class_id: classID }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                                    });
                                    $("#section_id").val(classID);
                                }
                            }, 'json');
                        }
                        
            
                        var formData = {
                            student_name: student_name,
                            class_id: classID,
                            section_id: sectionID,
                            session_id: sessionID,
                        };
                        getEmpFilter(formData);
                    }
                }
            }
        }
    }
    $("#class_id").on('change', function (e) {
        e.preventDefault();
        var class_id = $(this).val();
        $("#section_id").empty();
        $("#section_id").append('<option value="">' + select_class + '</option>');
        $.post(sectionByClass, { class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });


    $("#editadmission").validate({
        rules: {
            session_id: "required",
            year: "required",
            txt_regiter_no: "required",
            txt_emailid: {
                required: true,
                email: true
            },
            txt_roll_no: "required",
            admission_date: "required",
            classnames: "required",
            class_id: "required",
            section_id: "required",
            // categy: "required",
            fname: "required",
            txt_mobile_no: "required",
            present_address: "required",
            // txt_pwd: {
            //     minlength: 6
            // },
            // txt_retype_pwd: {
            //     minlength: 6,
            //     equalTo: "txt_pwd"
            // },  
            password: {
                // required: $("#password").val().length > 0,
                minlength: 6
            },
            confirm_password: {
                // required: $("#confirm_password").val().length > 0,
                minlength: 6,
                equalTo: "#password"
            }
        }
    });

    $('#editadmission').on('submit', function (e) {
        e.preventDefault();
        var admissionCheck = $("#editadmission").valid();
        if (admissionCheck === true) {
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
                        toastr.success(data.message);
                        window.location.href = indexStudent;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // delete Student 
    $(document).on('click', '#deleteStudentBtn', function () {
        var id = $(this).data('id');
        var url = studentDelete;
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
                        $("#student").show("slow");
                        $('#student-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        $("#student").hide("slow");
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    $("#drp_transport_route").on('change', function (e) {
        e.preventDefault();
        var route_id = $(this).val();
        $("#drp_transport_vechicleno").empty();
        $("#drp_transport_vechicleno").append('<option value="">' + select_vehicle_number + '</option>');
        $.post(vehicleByRoute, { route_id: route_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#drp_transport_vechicleno").append('<option value="' + val.vehicle_id + '">' + val.vehicle_no + '</option>');
                });
            }
        }, 'json');
    });



    $("#drp_hostelnam").on('change', function (e) {
        e.preventDefault();
        var hostel_id = $(this).val();
        $("#drp_roomname").empty();
        $("#drp_roomname").append('<option value="">' + select_room_name + '</option>');
        $.post(roomByHostel, { hostel_id: hostel_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#drp_roomname").append('<option value="' + val.room_id + '">' + val.room_name + '</option>');
                });
            }
        }, 'json');
    });

});
