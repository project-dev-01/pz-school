$(function () {

    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#filterStudentMedicalReport';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    function classAllocation(department_id, Selector, classID) {
        $(Selector).find('select[name="class_id"]').empty();
        $(Selector).find('select[name="class_id"]').append('<option value="">' + select_grade + '</option>');
        console.log(department_id);
        if (department_id) {
            $.post(getGradeByDepartmentUrl,
                {
                    branch_id: branchID,
                    department_id: department_id
                }, function (res) {
                    console.log(res);
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
    $("#filterStudentMedicalReport").validate({
        rules: {
            department_id: "required",
            class_id: "required",
            section_id: "required",
            year: "required"
        }
    });
    //
    $('#filterStudentMedicalReport').on('submit', function (e) {
        e.preventDefault();
        var valid = $("#filterStudentMedicalReport").valid();
        if (valid === true) {
            var classID = $("#class_id").val();
            var sectionID = $("#section_id").val();
            var year = $("#btwyears").val();
            var student_id = $("#student_id").val();
            var department_id = $("#department_id").val();
           
            
            var classObj = {
                year: year,
                classID: classID,
                branchID: branchID,
                sectionID: sectionID,
                studentID: student_id,
            };
            console.log(classObj);
            // setLocalStorageForFees(classObj);
            
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', classID);
            formData.append('section_id', sectionID);
            formData.append('academic_session_id', year);
            formData.append('student_id', student_id);
            formData.append('department_id', department_id);
            
            loadTable(formData);
        }
    });
    function loadTable(formData) {
        $("#overlay").fadeIn(300);
        $.ajax({
            url: getStudentMedicalReport,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {
                    var dataSetNew = response.data;
                    console.log(dataSetNew);
                    $(".getStudentsMedicalReortHideShow").show("slow");
                    // set group id
                    getMedicalReport(dataSetNew);
                    $("#overlay").fadeOut(300);
                } else {
                    toastr.error(response.message);
                    $("#overlay").fadeOut(300);
                }
            }
        });
    }

  
    function getMedicalReport(dataSetNew) {
        $('#getStudentMedical').DataTable().clear().destroy();
        $('#getStudentMedical td').empty();
        listTable = $('#getStudentMedical').DataTable({
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
            buttons: [{
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
            }
            ],
            data: dataSetNew,
            "pageLength": 10,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                {
                    targets: 0,
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'deptName'
                },
                {
                    data: 'class_name'
                },
                {
                    data: 'section_name'
                },
                {
                    data: 'name'
                }
            ],
            columnDefs: [
                {
                    "targets": 5,
                    render: function (data, type, row, meta) {
                        if (row.medical_record_status === 'Download') {
                            var url = studentMedicalDownloadPDF.replace(':id', row.student_id);
                            return '<div class="button-list">' +
                                   '<a href="' + url + '" class="btn btn-danger btn-sm waves-effect waves-light">' +
                                   '<i class="dripicons-download" style="color: white;"></i></a>' +
                                   '</div>';
                        } else {
                            return 'N/A';
                        }
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