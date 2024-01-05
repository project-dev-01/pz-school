$(function () {

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
    //
    $('#filterFeesAllocation').on('submit', function (e) {
        e.preventDefault();
            var payment_status = $("#payment_status").val();
            var group_id = $("#group_id").val();
            var classObj = {
                studentID: studentID,
                academic_session_id: year_id,
                paymentStatus: payment_status,
                groupID: group_id,
                userID: userID,
            };
            setLocalStorageForFees(classObj);
            
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('student_id', studentID);
            formData.append('payment_status', payment_status);
            formData.append('group_id', group_id);
            formData.append('academic_session_id', year_id);
            
            loadTable(formData);
    });
    function loadTable(formData) {
        $("#overlay").fadeIn(300);
        $.ajax({
            url: getFeesList,
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
                    getFess(dataSetNew);
                    $("#overlay").fadeOut(300);
                } else {
                    toastr.error(response.message);
                    $("#overlay").fadeOut(300);
                }
            }
        });
    }

    function setLocalStorageForFees(classObj) {

        var feesDetails = new Object();
        feesDetails.student_id = classObj.studentID;
        feesDetails.group_id = classObj.groupID;
        feesDetails.payment_status = classObj.paymentStatus;
        feesDetails.academic_session_id = classObj.academic_session_id;
        // here to attached to avoid localStorage other users to add
        feesDetails.branch_id = branchID;
        feesDetails.role_id = get_roll_id;
        feesDetails.user_id = ref_user_id;
        var feesArr = [];
        feesArr.push(feesDetails);
        if (get_roll_id == "5") {
            // parent
            localStorage.removeItem("parent_fees_details");
            localStorage.setItem('parent_fees_details', JSON.stringify(feesArr));
        }
        return true;
    }
    // if localStorage
    if (typeof fees_storage !== 'undefined') {
        if ((fees_storage)) {
            if (fees_storage) {
                var feesStorage = JSON.parse(fees_storage);
                if (feesStorage.length == 1) {
                    var  academic_session_id, student_id, paymentStatus, groupID, userBranchID, userRoleID, userID;
                    feesStorage.forEach(function (user) {
                        academic_session_id = user.academic_session_id;
                        student_id = user.student_id;
                        paymentStatus = user.payment_status;
                        groupID = user.group_id;
                        userBranchID = user.branch_id;
                        userRoleID = user.role_id;
                        userID = user.user_id; 
                    });
                    if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id) && (student_id == studentID)) {
                       $("#payment_status").val(paymentStatus);
                        $("#group_id").val(groupID);
                        
                        var formData = new FormData();
                        formData.append('token', token);
                        formData.append('branch_id', branchID);
                        formData.append('academic_session_id', academic_session_id);
                        formData.append('student_id', student_id);
                        formData.append('payment_status', paymentStatus);
                        formData.append('group_id', groupID);
                        
                        loadTable(formData);
                    }
                }
            }else{
                loadTable();
            }
        }
    }
    function getFess(dataSetNew) {
        $('#getFessStudents').DataTable().clear().destroy();
        $('#getFessStudents td').empty();
        listTable = $('#getFessStudents').DataTable({
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
                    data: 'class_name'
                },
                {
                    data: 'section_name'
                },
                {
                    data: 'name'
                },
                {
                    data: 'feegroup'
                },
                {
                    data: 'email'
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
                    "targets": 3,
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
                    "targets": 4,
                    "render": function (data, type, row, meta) {
                        var fsGroup = "";
                        data.forEach(function (day) {
                            // var status = ""
                            var paid_status = day['paidSts'] ? day['paidSts'] : "pending";
                            var status = day['labelmode'] ? day['labelmode'] : "badge-warning";
                            // if (paid_status == 'unpaid') {
                            //     status = 'badge-danger';
                            // } else if (paid_status == 'paid') {
                            //     status = 'badge-success';
                            // } else if (paid_status == 'delay') {
                            //     status = 'badge-secondary';
                            // } else {
                            //     status = 'badge-warning';
                            // }

                            var status = '<div class="badge label-table ' + status + '">' + paid_status + '</div>';
                            fsGroup += "(" + day['group_name'] + "<br>"
                                + "- " + status + ")" + "<br>" ;
                        })
                        return fsGroup;
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
                {
                    "targets": 5,
                    "render": function (data, type, row, meta) {
                        var view = feesView.replace(':id', row.student_id+'/'+row.all_group_id);
                        var invoice = feesInvoice.replace(':id', row.student_id+'/'+row.all_group_id);
                        var action = '<div class="button-list">' +
                            '<a href = "' + invoice + '" class="btn btn-blue btn-sm waves-effect waves-light"> <i class="fe-download"></i></a>'+
                            '<a href = "' + view + '" class="btn btn-blue btn-sm waves-effect waves-light"> <i class="fe-eye"></i></a>'+
                            '</div>';
                        return action;
                    }
                }

            ]
        }).on('draw', function () {
        });
    }

    // delete DesignationDelete
    $(document).on('click', '#deleteFeesBtn', function () {
        var id = $(this).data('id');
        var url = feesDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this fees',
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes, Delete',
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
                        toastr.success(data.message);
                        // $('#getFessStudents').DataTable().ajax.reload(null, false);
                        var classID = $("#class_id").val();
                        var sectionID = $("#section_id").val();
                        var year = $("#btwyears").val();
                        var student_id = $("#student_id").val();

                        var formData = new FormData();
                        formData.append('token', token);
                        formData.append('branch_id', branchID);
                        formData.append('class_id', classID);
                        formData.append('section_id', sectionID);
                        formData.append('academic_session_id', year);
                        formData.append('student_id', student_id);
                        loadTable(formData);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });



    getFeesTypeByBranch();
    function getFeesTypeByBranch() {
        var formData = new FormData();
        formData.append('token', token);
        formData.append('branch_id', branchID);
        formData.append('academic_session_id', academic_session_id);
        $.ajax({
            url: feesTypeGroupUrl,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (res) {
                $('#fees_type').html(res.data);
                if (res.code == 200) {
                    $('#fees_type').html(res.data);
                } else {
                    $('#fees_type').html(res.data);
                }
            }
        });
    }
});