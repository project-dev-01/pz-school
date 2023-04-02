$(function () {

    // rules validation
    $("#sectionAllocationForm").validate({
        rules: {
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
            var sectionID = $("#sectionID").val();
            var sectionCapacity = $("#sectionCapacity").val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', classID);
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
        buttons: [
            {
                extend: 'csv',
                text: downloadcsv,
                extension: '.csv',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }
            },
            {
                extend: 'pdf',
                text: downloadpdf,
                extension: '.pdf',
                exportOptions: {
                    columns: 'th:not(:last-child)'
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
            console.log(data.data.id)
            // console.log(sectionAlloID)
            $('.editSectionAllocationModal').find('#sectionAlloID').val(data.data.id);
            $('.editSectionAllocationModal').find('select[name="class_id"]').val(data.data.class_id);
            $('.editSectionAllocationModal').find('select[name="section_id"]').val(data.data.section_id);
            $('.editSectionAllocationModal').find('input[name="capacity"]').val(data.data.capacity);
            $('.editSectionAllocationModal').modal('show');
        }, 'json');
    });

    // update section
    $("#editsectionAllocationForm").validate({
        rules: {
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
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Class allocation',
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
