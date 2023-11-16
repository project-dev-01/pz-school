$(function () {

    // change department filter
    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '.addSectionAllocationModal';
        var department_id = $(this).val();
        var classID = "";
        if (department_id) {
            classAllocation(department_id, Selector, classID);
        }
    });
    $("#edit_department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '.editSectionAllocationModal';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });

    function classAllocation(department_id, Selector, classID) {

        $(Selector).find("#classID").empty();
        $(Selector).find("#classID").append('<option value="">' + select_grade + '</option>');
        if (department_id) {
            $.post(getGradeByDepartmentUrl,
                {
                    branch_id: branchID,
                    department_id: department_id
                }, function (res) {
                    if (res.code == 200) {
                        $.each(res.data, function (key, val) {
                            $(Selector).find("#classID").append('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                        if (classID != '') {
                            $(Selector).find('select[name="class_id"]').val(classID);
                        }
                    }
                }, 'json');
        }
    }

    // rules validation
    $("#sectionAllocationForm").validate({
        rules: {
            department_id: "required",
            class_id: "required",
            section_id: "required"
        }
    });
    // add section
    $('#sectionAllocationForm').on('submit', function (e) {
        e.preventDefault();
        var sectionValid = $("#sectionAllocationForm").valid();
        if (sectionValid === true) {
            var classID = $("#classID").val();
            var edit_department_id = $("#edit_department_id").val();
            var department_id = $("#department_id").val();
            var sectionID = $("#sectionID").val();
            var sectionCapacity = $("#sectionCapacity").val();

            var formData = new FormData();
            formData.append('branch_id', branchID);
            formData.append('department_id', edit_department_id);
            formData.append('class_id', classID);
            formData.append('department_id', department_id);
            formData.append('section_id', sectionID);
            formData.append('capacity', sectionCapacity);
            $.ajax({
                url: secAlloAddUrl,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#section-allocation-table').DataTable().ajax.reload(null, false);
                        $('.addSectionAllocationModal').modal('hide');
                        $('.addSectionAllocationModal').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.addSectionAllocationModal').modal('hide');
                        $('.addSectionAllocationModal').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });


    // get all sections
    var table = $('#section-allocation-table').DataTable({
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
        ajax: secAlloList,
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
                data: 'capacity',
                name: 'capacity'
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

    // // edit section
    $(document).on('click', '#editSectionAlloBtn', function () {
        var id = $(this).data('id');
        $.post(secAlloGetRowUrl, {
            id: id,
            token: token,
            branch_id: branchID
        }, function (data) {
            if (data.data.department_id != "") {
                var department_id = data.data.department_id;
                var Selector = '.editSectionAllocationModal';
                var classID = data.data.class_id;
                classAllocation(department_id, Selector, classID);
            }
            $('.editSectionAllocationModal').find('#sectionAlloID').val(data.data.id);
            $('.editSectionAllocationModal').find('select[name="edit_department_id"]').val(data.data.department_id);
            $('.editSectionAllocationModal').find('select[name="class_id"]').val(data.data.class_id);
            $('.editSectionAllocationModal').find('select[name="section_id"]').val(data.data.section_id);
            $('.editSectionAllocationModal').find('input[name="capacity"]').val(data.data.capacity);
            $('.editSectionAllocationModal').modal('show');
        }, 'json');
    });

    // update section
    $("#editsectionAllocationForm").validate({
        rules: {
            edit_department_id: "required",
            class_id: "required",
            section_id: "required"
        }
    });
    // update section
    $('#editsectionAllocationForm').on('submit', function (e) {
        e.preventDefault();
        var sectionValid = $("#editsectionAllocationForm").valid();
        if (sectionValid === true) {
            var sectionAlloID = $("#sectionAlloID").val();
            var editClassID = $("#editClassID").val();
            var editSectionID = $("#editSectionID").val();
            var sectionCapacity = $("#editsectionCapacity").val();

            var formData = new FormData();
            formData.append('id', sectionAlloID);
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', editClassID);
            formData.append('section_id', editSectionID);
            formData.append('capacity', sectionCapacity);


            $.ajax({
                url: secAlloUpdateUrl,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#section-allocation-table').DataTable().ajax.reload(null, false);
                        $('.editSectionAllocationModal').modal('hide');
                        $('.editSectionAllocationModal').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.editSectionAllocationModal').modal('hide');
                        $('.editSectionAllocationModal').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });

    // delete section
    $(document).on('click', '#deleteSectionAlloBtn', function () {
        var id = $(this).data('id');
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
                $.post(secAlloDeleteUrl, {
                    id: id,
                    token: token,
                    branch_id: branchID
                }, function (data) {

                    if (data.code == 200) {
                        $('#section-allocation-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }

                }, 'json');
            }
        });
    });

});
