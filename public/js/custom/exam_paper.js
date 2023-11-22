$(function () {

    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#addExamPaperModal';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    $("#editdepartment_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#editExamPaperModal';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    function classAllocation(department_id, Selector, classID) {
        //console.log(department_id);
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

    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        var IDnames = "#addExamPaperModal";
        var subject_id = null;
        getSubjects(class_id, IDnames, subject_id);
    });
    $('#editchangeClassName').on('change', function () {
        var class_id = $(this).val();
        var IDnames = "#editExamPaperModal";
        var subject_id = null;
        getSubjects(class_id, IDnames, subject_id);
    });
    function getSubjects(class_id, IDnames, subject_id) {

        $(IDnames).find("#subjectID").empty();
        $(IDnames).find("#subjectID").append('<option value="">'+select_subject+'</option>');
        $.post(classesByAllSubjects, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $(IDnames).find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                });
                if (subject_id) {
                    $(IDnames).find('select[name="subject_id"]').val(subject_id);
                }
            }
        }, 'json');
    }

    // rules validation
    $("#exam-paper-form").validate({
        rules: {
            department_id: "required",
            class_id: "required",
            subject_id: "required",
            paper_name: "required",
            paper_type: "required",
            grade_category: "required",
            paper_type: "required"
        }
    });
    // add exam
    $('#exam-paper-form').on('submit', function (e) {
        e.preventDefault();
        var Check = $("#exam-paper-form").valid();
        if (Check === true) {
            var department_id = $('.addExamPaper').find('select[name="department_id"]').val();
            var class_id = $('.addExamPaper').find('select[name="class_id"]').val();
            var subject_id = $('.addExamPaper').find('select[name="subject_id"]').val();
            var paper_name = $('.addExamPaper').find('input[name="paper_name"]').val();
            var paper_type = $('.addExamPaper').find('select[name="paper_type"]').val();
            var grade_category = $('.addExamPaper').find('select[name="grade_category"]').val();
            var subject_weightage = $('.addExamPaper').find('input[name="subject_weightage"]').val();
            var notes = $('.addExamPaper').find('textarea[name="notes"]').val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('department_id', department_id);
            formData.append('class_id', class_id);
            formData.append('subject_id', subject_id);
            formData.append('paper_name', paper_name);
            formData.append('paper_type', paper_type);
            formData.append('grade_category', grade_category);
            formData.append('subject_weightage', subject_weightage);
            formData.append('notes', notes);
            formData.append('academic_session_id', academic_session_id);

            $.ajax({
                url: examPaperAdd,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#exam-paper-table').DataTable().ajax.reload(null, false);
                        $('.addExamPaper').modal('hide');
                        $('.addExamPaper').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.addExamPaper').modal('hide');
                        $('.addExamPaper').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all exam table for admin
    var table = $('#exam-paper-table').DataTable({
        processing: true,
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
        ajax: examPaperList,
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
                data: 'class_name',
                name: 'class_name'
            },
            {
                data: 'subject_name',
                name: 'subject_name'
            },
            {
                data: 'grade_category_name',
                name: 'grade_category_name'
            },
            {
                data: 'paper_name',
                name: 'paper_name'
            },
            {
                data: 'paper_type_name',
                name: 'paper_type_name'
            },
            {
                data: 'subject_weightage',
                name: 'subject_weightage'
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
    // get row
    $(document).on('click', '#editExamPaperBtn', function () {
        var id = $(this).data('id');
        $('.editExamPaper').find('form')[0].reset();
        $.post(examPaperDetails, {
            id: id,
            token: token,
            branch_id: branchID
        }, function (data) {

            var class_id = data.data.class_id;
            var department_id = data.data.department_id;
            var subject_id = data.data.subject_id;
            var IDnames = "#editExamPaperModal";
            getSubjects(class_id, IDnames, subject_id);
            classAllocation(department_id, IDnames, class_id);
            $('.editExamPaper').find('input[name="id"]').val(data.data.id);
            $('.editExamPaper').find('select[name="department_id"]').val(data.data.department_id);
            $('.editExamPaper').find('select[name="class_id"]').val(data.data.class_id);
            $('.editExamPaper').find('input[name="paper_name"]').val(data.data.paper_name);
            $('.editExamPaper').find('select[name="paper_type"]').val(data.data.paper_type);
            $('.editExamPaper').find('select[name="grade_category"]').val(data.data.grade_category);
            $('.editExamPaper').find('input[name="subject_weightage"]').val(data.data.subject_weightage);
            $('.editExamPaper').find('textarea[name="notes"]').val(data.data.notes);
            $('.editExamPaper').modal('show');
        }, 'json');
    });

    // rules validation
    $("#edit-exam-paper-form").validate({
        rules: {
            department_id : "required",
            class_id: "required",
            subject_id: "required",
            paper_name: "required",
            paper_type: "required",
            grade_category: "required",
            paper_type: "required"
        }
    });
    // update exam
    $('#edit-exam-paper-form').on('submit', function (e) {
        e.preventDefault();
        var Check = $("#edit-exam-paper-form").valid();
        if (Check === true) {

            var id = $('.editExamPaper').find('input[name="id"]').val();
            var department_id = $('.editExamPaper').find('select[name="department_id"]').val();
            var class_id = $('.editExamPaper').find('select[name="class_id"]').val();
            var subject_id = $('.editExamPaper').find('select[name="subject_id"]').val();
            var paper_name = $('.editExamPaper').find('input[name="paper_name"]').val();
            var paper_type = $('.editExamPaper').find('select[name="paper_type"]').val();
            var grade_category = $('.editExamPaper').find('select[name="grade_category"]').val();
            var subject_weightage = $('.editExamPaper').find('input[name="subject_weightage"]').val();
            var notes = $('.editExamPaper').find('textarea[name="notes"]').val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('id', id);
            formData.append('department_id', department_id);
            formData.append('class_id', class_id);
            formData.append('subject_id', subject_id);
            formData.append('paper_name', paper_name);
            formData.append('paper_type', paper_type);
            formData.append('grade_category', grade_category);
            formData.append('subject_weightage', subject_weightage);
            formData.append('notes', notes);
            formData.append('academic_session_id', academic_session_id);

            $.ajax({
                url: examPaperUpdate,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#exam-paper-table').DataTable().ajax.reload(null, false);
                        $('.editExamPaper').modal('hide');
                        $('.editExamPaper').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.editExamPaper').modal('hide');
                        $('.editExamPaper').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    // delete ExamDelete
    $(document).on('click', '#deleteExamPaperBtn', function () {
        var id = $(this).data('id');
        var url = examPaperDelete;
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
                        $('#exam-paper-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});