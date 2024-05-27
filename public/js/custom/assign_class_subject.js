$(function () {

    // change department filter
    $("#filter_department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#assignClassSubFilter';
        var department_id = $(this).val();
        var classID = "";
        if (department_id) {
            // classAllocation(department_id, Selector, classID);
            $(Selector).find('select[name="class_id"]').empty();
            $(Selector).find('select[name="class_id"]').append('<option value="">' + select_grade + '</option>');
            $(Selector).find('select[name="section_id"]').empty();
            $(Selector).find('select[name="section_id"]').append('<option value="">' + select_class + '</option>');
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
    });
    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '.addAssignClassSubjectModal';
        var department_id = $(this).val();
        var classID = "";
        if (department_id) {
            classAllocation(department_id, Selector, classID);
        }
    });
    $("#edit_department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '.editAssClassSubjectModel';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });

    function classAllocation(department_id, Selector, classID) {
        $(Selector).find('select[name="class_name"]').empty();
        $(Selector).find('select[name="class_name"]').append('<option value="">' + select_grade + '</option>');
        $(Selector).find('select[name="section_name"]').empty();
        $(Selector).find('select[name="section_name"]').append('<option value="">' + select_class + '</option>');
        if (department_id) {
            $.post(getGradeByDepartmentUrl,
                {
                    branch_id: branchID,
                    department_id: department_id
                }, function (res) {
                    if (res.code == 200) {
                        $.each(res.data, function (key, val) {
                            $(Selector).find('select[name="class_name"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                        if (classID != '') {
                            $(Selector).find('select[name="class_name"]').val(classID);
                        }
                    }
                }, 'json');
        }
    }

    // change classroom
    $('#changeClassName').on('change', function () {
        $(".classRoomHideSHow").hide();
        var class_id = $(this).val();
        $("#assignClassSubFilter").find("#filtersectionID").empty();
        $("#assignClassSubFilter").find("#filtersectionID").append('<option value="">' + select_class + '</option>');
        $.post(sectionByClassUrl, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#assignClassSubFilter").find("#filtersectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });

    $('#addchangeClassName').on('change', function () {
        var class_id = $(this).val();
        var IDnames = "#addAssignClassSubject";
        var section_id = null;
        getSections(class_id, IDnames, section_id);
    });
    $('#editchangeClassName').on('change', function () {
        var class_id = $(this).val();
        var IDnames = "#updateAssignClassSubject";
        var section_id = null;
        getSections(class_id, IDnames, section_id);
    });
    function getSections(class_id, IDnames, section_id) {
        console.log('123', IDnames)
        console.log('class_id', class_id)
        console.log('section_id', section_id)
        $(IDnames).find("#sectionID").empty();
        $(IDnames).find("#sectionID").append('<option value="">' + select_class + '</option>');

        $.post(sectionByClassUrl, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $(IDnames).find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
                if (section_id) {
                    $(IDnames).find('select[name="section_name"]').val(section_id);
                }
            }
        }, 'json');
    }

    // rules validation
    $("#addAssignClassSubject").validate({
        rules: {
            department_id: "required",
            class_name: "required",
            section_name: "required",
            subject_id: "required"
        }
    });
    // add 
    $('#addAssignClassSubject').on('submit', function (e) {
        e.preventDefault();
        var classValid = $("#addAssignClassSubject").valid();
        if (classValid === true) {


            var changeClassName = $("#addAssignClassSubject").find("select[name=class_name]").val();
            var sectionID = $("#addAssignClassSubject").find("select[name=section_name]").val();
            var assignSubjects = $("#addAssignClassSubject").find("select[name=subject_id]").val();
            var department_id = $("#addAssignClassSubject").find("select[name=department_id]").val();
            var formData = new FormData();
            formData.append('branch_id', branchID);
            formData.append('department_id', department_id);
            formData.append('class_id', changeClassName);
            formData.append('section_id', sectionID);
            formData.append('subject_id', assignSubjects);
            formData.append('academic_session_id', academic_session_id);

            $.ajax({
                url: classAssignAddUrl,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#class-assign-subjects-table').DataTable().ajax.reload(null, false);
                        $('.addAssignClassSubjectModal').modal('hide');
                        $('.addAssignClassSubjectModal').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.addAssignClassSubjectModal').modal('hide');
                        $('.addAssignClassSubjectModal').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });

    // edit 

    $(document).on('click', '#editAssiClassSubBtn', function () {
        var id = $(this).data('id');
        $.post(classAssignGetRowUrl, {
            id: id,
            token: token,
            branch_id: branchID
        }, function (data) {
            var class_id = data.data.class_id;
            var section_id = data.data.section_id;
            if (data.data.department_id != "") {
                var department_id = data.data.department_id;
                var Selector = '.editAssClassSubjectModel';
                var classID = data.data.class_id;
                classAllocation(department_id, Selector, classID);
            }
            var IDnames = "#updateAssignClassSubject";
            getSections(class_id, IDnames, section_id);
            $('.editAssClassSubjectModel').find('select[name="edit_department_id"]').val(data.data.department_id);
            $('.editAssClassSubjectModel').find('input[name="assign_class_sub_id"]').val(data.data.id);
            $('.editAssClassSubjectModel').find('select[name="class_name"]').val(data.data.class_id);
            $('.editAssClassSubjectModel').find('select[name="subject_id"]').val(data.data.subject_id);
            $('.editAssClassSubjectModel').modal('show');
        }, 'json');
    });

    // update 
    $("#updateAssignClassSubject").validate({
        rules: {
            edit_department_id: "required",
            class_name: "required",
            section_name: "required",
            subject_id: "required"
        }
    });
    // update 
    $('#updateAssignClassSubject').on('submit', function (e) {
        e.preventDefault();
        var sectionValid = $("#updateAssignClassSubject").valid();
        if (sectionValid === true) {

            var edit_department_id = $("#updateAssignClassSubject").find("select[name=edit_department_id]").val();
            var assign_class_sub_id = $("#updateAssignClassSubject").find("input[name=assign_class_sub_id]").val();
            var changeClassName = $("#updateAssignClassSubject").find("select[name=class_name]").val();
            var sectionID = $("#updateAssignClassSubject").find("select[name=section_name]").val();
            var assignSubjects = $("#updateAssignClassSubject").find("select[name=subject_id]").val();

            var formData = new FormData();
            formData.append('department_id', edit_department_id);
            formData.append('branch_id', branchID);
            formData.append('id', assign_class_sub_id);
            formData.append('class_id', changeClassName);
            formData.append('section_id', sectionID);
            formData.append('subject_id', assignSubjects);
            formData.append('academic_session_id', academic_session_id);

            $.ajax({
                url: classAssignUpdateUrl,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#class-assign-subjects-table').DataTable().ajax.reload(null, false);
                        $('.editAssClassSubjectModel').modal('hide');
                        $('.editAssClassSubjectModel').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.editAssClassSubjectModel').modal('hide');
                        $('.editAssClassSubjectModel').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });

    // delete form
    $(document).on('click', '#deleteAssiClassSubBtn', function () {
        var id = $(this).data('id');
        var url = classAssignDeleteUrl;
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
                    id: id,
                    token: token,
                    branch_id: branchID
                }, function (data) {

                    if (data.code == 200) {
                        $('#class-assign-subjects-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    //GET ALL 
    // var table = $('#class-assign-subjects-table').DataTable({
    //     processing: true,
    //     info: true,
    //     // dom: 'lBfrtip',
    //     dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
    //         "<'row'<'col-sm-12'tr>>" +
    //         "<'row'<'col-sm-6'i><'col-sm-6'p>>",
    //     buttons: [
    //         {
    //             extend: 'csv',
    //             text: downloadcsv,
    //             extension: '.csv',
    //             exportOptions: {
    //                 columns: 'th:not(:last-child)'
    //             }
    //         },
    //         {
    //             extend: 'pdf',
    //             text: downloadpdf,
    //             extension: '.pdf',
    //             exportOptions: {
    //                 columns: 'th:not(:last-child)'
    //             }

    //         }
    //     ],
    //     ajax: classAssignSubList,
    //     "pageLength": 10,
    //     "aLengthMenu": [
    //         [5, 10, 25, 50, -1],
    //         [5, 10, 25, 50, "All"]
    //     ],
    //     columns: [
    //         {
    //             searchable: false,
    //             data: 'DT_RowIndex',
    //             name: 'DT_RowIndex'
    //         },
    //         {
    //             data: 'class_name',
    //             name: 'class_name'
    //         },
    //         {
    //             data: 'section_name',
    //             name: 'section_name'
    //         },
    //         {
    //             data: 'subject_name',
    //             name: 'subject_name'
    //         },
    //         {
    //             data: 'actions',
    //             name: 'actions',
    //             orderable: false,
    //             searchable: false
    //         },
    //     ]
    // }).on('draw', function () {
    // });
    // rules validation
    $("#assignClassSubFilter").validate({
        rules: {
            filter_department_id: "required",
            class_id: "required",
            section_id: "required"
        }
    });
    // all Leave Filter
    $('#assignClassSubFilter').on('submit', function (e) {
        e.preventDefault();
        var filValid = $("#addAssignClassSubject").valid();
        if (filValid === true) {
            var department_id = $("#filter_department_id").val();
            var class_id = $("#changeClassName").val();
            var section_id = $("#filtersectionID").val();
            var classObj = {
                department_id: department_id,
                class_id: class_id,
                section_id: section_id,
                academic_session_id: academic_session_id
            };
            //console.log(classObj);
            setLocalStorageForadminassignclasssubject(classObj);
            assignClassSubjectList(class_id, section_id);
        }

    });

    function setLocalStorageForadminassignclasssubject(classObj) {

        var assignclasssubject = new Object();
        assignclasssubject.department_id = classObj.department_id;
        assignclasssubject.class_id = classObj.class_id;
        assignclasssubject.section_id = classObj.section_id;
        // here to attached to avoid localStorage other users to add
        assignclasssubject.branch_id = branchID;
        assignclasssubject.role_id = get_roll_id;
        assignclasssubject.user_id = ref_user_id;
        var assignclasssubjectClassArr = [];
        assignclasssubjectClassArr.push(assignclasssubject);
        if (get_roll_id == "2") {
            // Parent
            localStorage.removeItem("admin_assign_class_subject_details");
            localStorage.setItem('admin_assign_class_subject_details', JSON.stringify(assignclasssubjectClassArr));
        }

        return true;
    }
    assignClassSubjectList(class_id = null, section_id = null);
    // get all leave list
    function assignClassSubjectList(class_id, section_id) {
        $('#class-assign-subjects-table').DataTable({
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

                    customize: function (doc) {
                        doc.pageMargins = [50, 50, 50, 50];
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
            "ajax": {
                url: classAssignSubList,
                cache: false,
                dataType: "json",
                // data: { month:getSelectedMonth },
                // data: formData,
                data: { class_id: class_id, section_id: section_id },
                type: "GET",
                // contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                // processData: true, // NEEDED, DON'T OMIT THIS
                // headers: {
                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                "dataSrc": function (json) {
                    if (json && json.data.length > 0) {
                        console.log('ok');
                        $('#class-assign-subjects-table_wrapper .buttons-csv').removeClass('disabled');
                        $('#class-assign-subjects-table_wrapper .buttons-pdf').removeClass('disabled');  // Enable all buttons if at least one record exists
                    } else {
                        console.log(json);
                        $('#class-assign-subjects-table_wrapper .buttons-csv').addClass('disabled');
                        $('#class-assign-subjects-table_wrapper .buttons-pdf').addClass('disabled');               
                    }
                    return json.data;
                },
                error: function (error) {
                    // console.log("error")
                    // console.log(error)
                    // noDataAvailable(error);
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
                },
                {
                    data: 'department_name',
                    name: 'department_name'
                },
                {
                    data: 'class_name',
                    name: 'class_name'
                },
                {
                    data: 'section_name',
                    name: 'section_name'
                },
                {
                    data: 'subject_name',
                    name: 'subject_name'
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
    if (get_roll_id == "2") {
        if ((admin_assign_class_subject_storage)) {
            if (admin_assign_class_subject_storage) {
                var adminassignclasssubjectstorage = JSON.parse(admin_assign_class_subject_storage);
                if (adminassignclasssubjectstorage.length == 1) {
                    var department_id, class_id, section_id, userBranchID, userRoleID, userID;
                    adminassignclasssubjectstorage.forEach(function (user) {
                        department_id = user.department_id;
                        class_id = user.class_id;
                        section_id = user.section_id;
                        student_id = user.student_id;
                        userBranchID = user.branch_id;
                        userRoleID = user.role_id;
                        userID = user.user_id;
                    });
                    if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                        var Selector = '#assignClassSubFilter';
                        $(Selector).find('select[name="filter_department_id"]').val(department_id);
                        if (department_id) {
                            $(Selector).find('select[name="class_id"]').empty();
                            $(Selector).find('select[name="class_id"]').append('<option value="">' + select_grade + '</option>');
                            $(Selector).find('select[name="section_id"]').empty();
                            $(Selector).find('select[name="section_id"]').append('<option value="">' + select_class + '</option>');
                            $.post(getGradeByDepartmentUrl, {
                                branch_id: branchID,
                                department_id: department_id
                            }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $(Selector).find('select[name="class_id"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                                    });
                                    if (class_id != '') {
                                        $(Selector).find('select[name="class_id"]').val(class_id);
                                    }
                                    // after success
                                    $.post(sectionByClassUrl, {
                                        token: token, branch_id: branchID, class_id: class_id
                                    }, function (res) {
                                        if (res.code == 200) {
                                            $.each(res.data, function (key, val) {
                                                var selected = (section_id == val.section_id) ? 'selected' : '';
                                                $(Selector).find('select[name="section_id"]').append('<option value="' + val.section_id + '" ' + selected + '>' + val.section_name + '</option>');
                                            });
                                        }
                                    }, 'json');
                                }
                            }, 'json');
                        }
                    }
                }
            }
        }
    }
});