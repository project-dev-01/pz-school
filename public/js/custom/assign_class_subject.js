$(function () {

    // change classroom
    $('#changeClassName').on('change', function () {
        $(".classRoomHideSHow").hide();
        var class_id = $(this).val();
        $("#assignClassSubFilter").find("#filtersectionID").empty();
        $("#assignClassSubFilter").find("#filtersectionID").append('<option value="">'+select_class+'</option>');
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
        console.log('123',IDnames)
        console.log('class_id',class_id)
        console.log('section_id',section_id)
        $(IDnames).find("#sectionID").empty();
        $(IDnames).find("#sectionID").append('<option value="">'+select_class+'</option>');

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
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
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

            var IDnames = "#updateAssignClassSubject";
            getSections(class_id, IDnames, section_id);
            $('.editAssClassSubjectModel').find('input[name="assign_class_sub_id"]').val(data.data.id);
            $('.editAssClassSubjectModel').find('select[name="class_name"]').val(data.data.class_id);
            $('.editAssClassSubjectModel').find('select[name="subject_id"]').val(data.data.subject_id);
            $('.editAssClassSubjectModel').modal('show');
        }, 'json');
    });

    // update 
    $("#updateAssignClassSubject").validate({
        rules: {
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

            var assign_class_sub_id = $("#updateAssignClassSubject").find("input[name=assign_class_sub_id]").val();
            var changeClassName = $("#updateAssignClassSubject").find("select[name=class_name]").val();
            var sectionID = $("#updateAssignClassSubject").find("select[name=section_name]").val();
            var assignSubjects = $("#updateAssignClassSubject").find("select[name=subject_id]").val();

            var formData = new FormData();
            formData.append('token', token);
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
    // all Leave Filter
    $('#assignClassSubFilter').on('submit', function (e) {
        e.preventDefault();
        var class_id = $("#changeClassName").val();
        var section_id = $("#filtersectionID").val();
        AllLeaveListShow(class_id, section_id);
    });
    AllLeaveListShow(class_id = null, section_id = null);
    // get all leave list
    function AllLeaveListShow(class_id, section_id) {
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
});