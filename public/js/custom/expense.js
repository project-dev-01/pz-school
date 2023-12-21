$(function () {

    // update FeesType
    $('#fees-expense-form').on('submit', function (e) {
        e.preventDefault();

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
                            applyfilter();
                            toastr.success(data.message);
                            $('#semesterModal').modal('hide');
                        } else {
                            toastr.error(data.message);
                            $('#semesterModal').modal('hide');
                        }
                    }
                }
            });
    });

    
    $(document).on('click', '#semester1', function () {
        var id = $(this).data('id');
        var value = $(this).data('value');
        var student_id = $(this).data('student_id');
        var academic_year = $(this).data('academic_year');
        $('#semester1status').show('');
        $('#semester2status').hide('');
        $('#semester3status').hide('');
        $('#semesterModal').find('select[name="semester_2"]').val("");
        $('#semesterModal').find('select[name="semester_3"]').val("");
        $('#semesterModal').find('select[name="semester_1"]').val(value);
        $('#semesterModal').find('input[name="id"]').val(id);
        $('#semesterModal').find('input[name="student_id"]').val(student_id);
        $('#semesterModal').find('input[name="academic_year"]').val(academic_year);
        $('#semesterModal').modal('show');
    });
    $(document).on('click', '#semester2', function () {
        var id = $(this).data('id');
        var value = $(this).data('value');
        var student_id = $(this).data('student_id');
        var academic_year = $(this).data('academic_year');
        
        $('#semester1status').hide('');
        $('#semester2status').show('');
        $('#semester3status').hide('');
        $('#semesterModal').find('select[name="semester_1"]').val("");
        $('#semesterModal').find('select[name="semester_3"]').val("");
        $('#semesterModal').find('select[name="semester_2"]').val(value);
        $('#semesterModal').find('input[name="id"]').val(id);
        $('#semesterModal').find('input[name="student_id"]').val(student_id);
        $('#semesterModal').find('input[name="academic_year"]').val(academic_year);
        $('#semesterModal').modal('show');
    });
    $(document).on('click', '#semester3', function () {
        var id = $(this).data('id');
        var value = $(this).data('value');
        var student_id = $(this).data('student_id');
        var academic_year = $(this).data('academic_year');

        $('#semester1status').hide('');
        $('#semester2status').hide('');
        $('#semester3status').show('');
        $('#semesterModal').find('select[name="semester_1"]').val("");
        $('#semesterModal').find('select[name="semester_2"]').val("");
        $('#semesterModal').find('select[name="semester_3"]').val(value);
        $('#semesterModal').find('input[name="id"]').val(id);
        $('#semesterModal').find('input[name="student_id"]').val(student_id);
        $('#semesterModal').find('input[name="academic_year"]').val(academic_year);
        $('#semesterModal').modal('show');
    });
    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#filterFeesExpense';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    function classAllocation(department_id, Selector, classID) {
        $(Selector).find('select[name="class_id"]').empty();
        $(Selector).find('select[name="class_id"]').append('<option value="">' + select_grade + '</option>');
        if (department_id) {
            $.post(getGradeByDepartmentUrl,
                {
                    branch_id: branchID,
                    department_id: department_id
                }, function (res) {
                    if (res.code == 200) {
                        $.each(res.data, function (key, val) {
                            $(Selector).find('select[name="class_id"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                        if (classID != '') {
                            $(Selector).find('select[name="class_id"]').val(classID);
                        }
                    }
                }, 'json');
        }
    }

    $("#btwyears").on('change', function (e) {
        e.preventDefault();
        $('#class_id').val("");
        $("#section_id").empty();
        $("#section_id").append('<option value="">'+select_class+'</option>');
        $("#student_id").empty();
        $("#student_id").append('<option value="">'+select_student+'</option>');
        $('#fees_type').val("");
        $('#payment_status').val("");
    });

    $("#class_id").on('change', function (e) {
        e.preventDefault();
        var class_id = $(this).val();
        $("#section_id").empty();
        $("#section_id").append('<option value="">'+select_class+'</option>');
        $.post(sectionByClass, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });


    $("#section_id").on('change', function (e) {
        e.preventDefault();
        var academic_session_id = $("#btwyears").val();
        var class_id = $("#class_id").val();
        var section_id = $(this).val();
        $("#student_id").empty();
        $("#student_id").append('<option value="">'+select_student+'</option>');
        $.post(getStudentList, { token: token, branch_id: branchID, class_id: class_id, academic_session_id: academic_session_id, section_id: section_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#student_id").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });

    // rules validation
    $("#filterFeesExpense").validate({
        rules: {
            department_id: "required",
            class_id: "required",
            section_id: "required",
            year: "required"
        }
    });
    //
    
    $('#filterFeesExpense').on('submit', function (e) {
        e.preventDefault();
        var valid = $("#filterFeesExpense").valid();
        if (valid === true) {
            applyfilter();
        }
    });
    function applyfilter(){
        
        var classID = $("#class_id").val();
        var sectionID = $("#section_id").val();
        var year = $("#btwyears").val();
        var department_id = $("#department_id").val();
        var payment_status = $("#payment_status").val();
        
        var classObj = {
            year: year,
            classID: classID,
            branchID: branchID,
            sectionID: sectionID,
            departmentID: department_id,
            paymentStatus: payment_status,
            userID: userID,
        };
        setLocalStorageForFeesExpense(classObj);
        
        
        $("#excelSection").val(sectionID);
        $("#excelSession").val(year);
        $("#excelDepartment").val(department_id);
        $("#excelClass").val(classID);
        
        $("#downExcelSection").val(sectionID);
        $("#downExcelSession").val(year);
        $("#downExcelDepartment").val(department_id);
        $("#downExcelClass").val(classID);


        var formData = new FormData();
        formData.append('token', token);
        formData.append('branch_id', branchID);
        formData.append('class_id', classID);
        formData.append('section_id', sectionID);
        formData.append('academic_session_id', year);
        formData.append('department_id', department_id);
        formData.append('payment_status', payment_status);
        
        loadTable(formData);
    }
    function loadTable(formData) {
        $("#overlay").fadeIn(300);
        $.ajax({
            url: getFeesExpenseStudents,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {
                    var dataSetNew = response.data;
                    $(".getFessStudentsHideShow").show("slow");
                    // set group id
                    // $("#getFessStudentsGroupID").val(groupID);
                    getFessExpense(dataSetNew);
                    $("#overlay").fadeOut(300);
                } else {
                    toastr.error(response.message);
                    $("#overlay").fadeOut(300);
                }
            }
        });
    }

    function setLocalStorageForFeesExpense(classObj) {

        var feesDetails = new Object();
        feesDetails.class_id = classObj.classID;
        feesDetails.section_id = classObj.sectionID;
        feesDetails.department_id = classObj.departmentID;
        feesDetails.payment_status = classObj.paymentStatus;
        feesDetails.year = classObj.year;
        // here to attached to avoid localStorage other users to add
        feesDetails.branch_id = branchID;
        feesDetails.role_id = get_roll_id;
        feesDetails.user_id = ref_user_id;
        var feesArr = [];
        feesArr.push(feesDetails);
        if (get_roll_id == "2") {
            // admin
            localStorage.removeItem("admin_fees_expense_details");
            localStorage.setItem('admin_fees_expense_details', JSON.stringify(feesArr));
        }
        return true;
    }
    // if localStorage
    if (typeof fees_storage !== 'undefined') {
        if ((fees_storage)) {
            if (fees_storage) {
                var feesStorage = JSON.parse(fees_storage);
                if (feesStorage.length == 1) {
                    var classID, year, sectionID, paymentStatus, userBranchID, userRoleID, userID;
                    feesStorage.forEach(function (user) {
                        classID = user.class_id;
                        year = user.year;
                        departmentID = user.department_id;
                        sectionID = user.section_id;
                        paymentStatus = user.payment_status;
                        userBranchID = user.branch_id;
                        userRoleID = user.role_id;
                        userID = user.user_id; 
                    });
                    if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                        $('#class_id').val(classID);
                        $('#btwyears').val(year);
                        $("#payment_status").val(paymentStatus);
                        $("#department_id").val(departmentID);

                        if(departmentID){
                            
                            $("#class_id").empty();
                            $("#class_id").append('<option value="">'+select_class+'</option>');
                            $.post(getGradeByDepartmentUrl, { token: token, branch_id: branchID, department_id: departmentID }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#class_id").append('<option value="' + val.id + '">' + val.name + '</option>');
                                    });
                                    $("#class_id").val(classID);
                                }
                            }, 'json');
                        }
                        if (classID) {
                            $("#section_id").empty();
                            $("#section_id").append('<option value="">'+select_class+'</option>');
                            $.post(sectionByClass, { token: token, branch_id: branchID, class_id: classID }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                                    });
                                    $("#section_id").val(sectionID);
                                }
                            }, 'json');
                        }
                        
                        var formData = new FormData();
                        formData.append('token', token);
                        formData.append('branch_id', branchID);
                        formData.append('class_id', classID);
                        formData.append('section_id', sectionID);
                        formData.append('academic_session_id', year);
                        formData.append('payment_status', paymentStatus);
                        formData.append('department_id', departmentID);
                        
                        
        
                        $("#excelSection").val(sectionID);
                        $("#excelSession").val(year);
                        $("#excelDepartment").val(departmentID);
                        $("#excelClass").val(classID);
                        
                        $("#downExcelSection").val(sectionID);
                        $("#downExcelSession").val(year);
                        $("#downExcelDepartment").val(departmentID);
                        $("#downExcelClass").val(classID);
                        loadTable(formData);
                    }
                }
            }
        }
    }
    function getFessExpense(dataSetNew) {
        $('#fees-expense').DataTable().clear().destroy();
        $('#fees-expense td').empty();
        listTable = $('#fees-expense').DataTable({
            processing: true,
            bDestroy: true,
            info: true,
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
            paging: false,
            "bSort": false,
            buttons: [],
            data: dataSetNew,
            "pageLength": 10,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                {
                    data: 'student_id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'roll_no'
                },
                {
                    data: 'semester_1'
                },
                {
                    data: 'semester_2'
                },
                {
                    data: 'semester_3'
                }
            ],
            columnDefs: [
                {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 1,
                    "className": "table-user",
                    "render": function (data, type, row, meta) {
                        var img = "";
                        if (row.photo) {
                            img = studentImg + '/' + row.photo;
                        } else {
                            img = defaultImg;
                        }
                        var first_name = '<img src="' + img + '" class="mr-2 rounded-circle">' +
                            '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                        return first_name;
                    }
                },
                {
                    "targets": 3,
                    "render": function (data, type, row, meta) {
                        var sem_1_value = data;
                        if(data==null){
                            var sem_1_value = "N/A";
                        }
                        var sem_1 = sem_1_value+'<a href="javascript:void(0)" id="semester1" data-student_id="'+row.student_id+'" data-academic_year="'+row.academic_year+'" data-value="'+data+'"  data-id="'+row.id+'" ><i class="fa fa-caret-down" style="color:solid blue;font-size: 20px;padding: 0px 0px 0px 12px;"></i></a>';
                        return sem_1;
                    }
                },
                {
                    "targets": 4,
                    "render": function (data, type, row, meta) {
                        var sem_2_value = data;
                        if(data==null){
                            var sem_2_value = "N/A";
                        }
                        var sem_2 = sem_2_value+'<a href="javascript:void(0)" id="semester2" data-student_id="'+row.student_id+'" data-academic_year="'+row.academic_year+'" data-value="'+data+'" data-id="'+row.id+'" data-toggle="modal" ><i class="fa fa-caret-down" style="color:solid blue;font-size: 20px;padding: 0px 0px 0px 12px;"></i></a>';
                        return sem_2;
                    }
                },
                {
                    "targets": 5,
                    "render": function (data, type, row, meta) {
                        var sem_3_value = data;
                        if(data==null){
                            var sem_3_value = "N/A";
                        }
                        var sem_3 = sem_3_value+'<a href="javascript:void(0)" id="semester3" data-student_id="'+row.student_id+'" data-academic_year="'+row.academic_year+'" data-value="'+data+'" data-id="'+row.id+'" ><i class="fa fa-caret-down" style="color:solid blue;font-size: 20px;padding: 0px 0px 0px 12px;"></i></a>';
                        return sem_3;
                    }
                },
                // {
                //     "targets": 5,
                //     "render": function (data, type, row, meta) {
                //         var status = ""
                //         if (data == 'unpaid') {
                //             status = 'badge-danger';
                //         } else if (data == 'paid') {
                //             status = 'badge-success';
                //         } else if (data == 'delay') {
                //             status = 'badge-warning';
                //         }
                //         var status = '<div class="badge label-table ' + status + '">' + data + '</div>';
                //         return status;
                //     }
                // },

            ]
        }).on('draw', function () {
        });
    }


});