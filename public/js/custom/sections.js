$(function () {

    // rules validation
    $("#sectionForm").validate({
        rules: {
            name: "required"
        }
    });
    // add section
    $('#sectionForm').on('submit', function (e) {
        e.preventDefault();
        var sectionValid = $("#sectionForm").valid();
        if (sectionValid === true) {
            var sectionName = $("#sectionName").val();
            var sectionCapacity = $("#sectionCapacity").val();
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('name', sectionName);
            formData.append('capacity', sectionCapacity);

            $.ajax({
                url: sectionAddUrl,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#section-table').DataTable().ajax.reload(null, false);
                        $('.addSection').modal('hide');
                        $('.addSection').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.addSection').modal('hide');
                        $('.addSection').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });


    // get all sections
    var table = $('#section-table').DataTable({
        processing: true,
        info: true,
        ajax: sectionList,
        "pageLength": 5,
        "aLengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'name',
                name: 'name'
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
    $(document).on('click', '#editSectionBtn', function () {
        var section_id = $(this).data('id');
        $.post(sectionGetRowUrl, {
            section_id: section_id,
            token: token,
            branch_id: branchID
        }, function (data) {
            $('.editSection').find('input[name="sid"]').val(data.data.id);
            $('.editSection').find('input[name="name"]').val(data.data.name);
            $('.editSection').find('input[name="capacity"]').val(data.data.capacity);
            $('.editSection').modal('show');
        }, 'json');
    });

    // update section
    $("#sectionEditForm").validate({
        rules: {
            name: "required"
        }
    });
    // update section
    $('#sectionEditForm').on('submit', function (e) {
        e.preventDefault();
        var sectionValid = $("#sectionEditForm").valid();
        if (sectionValid === true) {
            var sectionID = $("#sectionID").val();
            var sectionName = $("#editsectionName").val();
            var sectionCapacity = $("#editsectionCapacity").val();
            var formData = new FormData();
            formData.append('sid', sectionID);
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('name', sectionName);
            formData.append('capacity', sectionCapacity);

            $.ajax({
                url: sectionUpdateUrl,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#section-table').DataTable().ajax.reload(null, false);
                        $('.editSection').modal('hide');
                        $('.editSection').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.editSection').modal('hide');
                        $('.editSection').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });

    // delete section
    $(document).on('click', '#deleteSectionBtn', function () {
        var sid = $(this).data('id');
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this section',
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
                $.post(sectionDeleteUrl, {
                    sid: sid,
                    token: token,
                    branch_id: branchID
                }, function (data) {

                    if (data.code == 200) {
                        $('#section-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }

                }, 'json');
            }
        });
    });

    // // add section allocation

    $('#sectionAllocationForm').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function () {
                $(form).find('span.error-text').text('');
            },
            success: function (data) {
                if (data.code == 0) {
                    $.each(data.error, function (prefix, val) {
                        $(form).find('span.' + prefix + '_error').text(val[0]);
                    });
                } else {

                    if (data.code == 200) {
                        $('#allocation-table').DataTable().ajax.reload(null, false);
                        $('.addSectionAllocationModal').modal('hide');
                        $('.addSectionAllocationModal').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.addSectionAllocationModal').modal('hide');
                        $('.addSectionAllocationModal').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }
            }
        });
    });
    // change branch id in add section allocation 
    $("#addSecAllBranchId").on('change', function (e) {
        e.preventDefault();
        var Selector = '#sectionAllocationForm';
        var branch_id = $(this).val();
        if (branch_id) {
            branchSectionAllocation(branch_id, Selector);
        }
    });

    $("#editSecAllBranchId").on('change', function (e) {
        e.preventDefault();
        var Selector = '#editsectionAllocationForm';
        var branch_id = $(this).val();
        if (branch_id) {
            branchSectionAllocation(branch_id, Selector);
        }
    });
    // branch section allocations
    function branchSectionAllocation(branch_id, Selector) {

        $(Selector).find("#class_name").empty();
        $(Selector).find("#class_name").append('<option value="">Choose Class</option>');
        $(Selector).find("#section_name").empty();
        $(Selector).find("#section_name").append('<option value="">Select City</option>');
        $.post(branchByClass, { branch_id: branch_id, token: token }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $(Selector).find("#class_name").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
        $.post(branchBySection, { branch_id: branch_id, token: token }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $(Selector).find("#section_name").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    }

    function EditbranchSectionAllocation(branch_id, Selector, class_id, section_id) {

        $(Selector).find("#class_name").empty();
        $(Selector).find("#class_name").append('<option value="">Choose Class</option>');
        $(Selector).find("#section_name").empty();
        $(Selector).find("#section_name").append('<option value="">Select City</option>');
        $.post(branchByClass, { branch_id: branch_id, token: token }, function (res) {
            if (res.code == 200) {
                var i = 0;
                $.each(res.data, function (key, val) {
                    $(Selector).find("#class_name").append('<option value="' + val.id + '">' + val.name + '</option>');
                    i++;
                });
                if (i == res.data.length) {
                    $(Selector).find('select[name="class_name"]').val(class_id);
                }
            }
        }, 'json');
        $.post(branchBySection, { branch_id: branch_id, token: token }, function (res) {
            if (res.code == 200) {
                var i = 0;
                $.each(res.data, function (key, val) {
                    $(Selector).find("#section_name").append('<option value="' + val.id + '">' + val.name + '</option>');
                    i++;
                });
                if (i == res.data.length) {
                    $(Selector).find('select[name="section_name"]').val(section_id);
                }
            }
        }, 'json');
    }

    // // get section allocation table
    var allocationTable = $('#allocation-table').DataTable({
        processing: true,
        info: true,
        ajax: sectionAllocationList,
        "pageLength": 5,
        "aLengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'branch_name',
                name: 'branch_name'
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
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false
            },
        ]
    }).on('draw', function () {
    });

    // // edit section allocation

    $(document).on('click', '#editSectionAlloBtn', function () {
        var id = $(this).data('id');
        $('.editSectionAllocationModal').find('form')[0].reset();
        $('.editSectionAllocationModal').find('span.error-text').text('');
        $.post(sectionAllocationDetails, { id: id }, function (res) {
            var branch_id = res.data.branch_id;
            var class_id = res.data.class_id;
            var section_id = res.data.section_id;
            var Selector = '.editSectionAllocationModal';
            if (branch_id) {
                EditbranchSectionAllocation(branch_id, Selector, class_id, section_id)
            }
            $('.editSectionAllocationModal').find('input[name="said"]').val(res.data.id);
            $('.editSectionAllocationModal').find('select[name="branch_id"]').val(res.data.branch_id);
            $('.editSectionAllocationModal').modal('show');
        }, 'json');
    });

    // // update section allocation

    $('#editsectionAllocationForm').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function () {
                $(form).find('span.error-text').text('');
            },
            success: function (data) {
                if (data.code == 0) {
                    $.each(data.error, function (prefix, val) {
                        $(form).find('span.' + prefix + '_error').text(val[0]);
                    });
                } else {
                    if (data.code == 200) {
                        $('#allocation-table').DataTable().ajax.reload(null, false);
                        $('.editSectionAllocationModal').modal('hide');
                        $('.editSectionAllocationModal').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.editSectionAllocationModal').modal('hide');
                        $('.editSectionAllocationModal').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }
            }
        });
    });

    // // delete section
    $(document).on('click', '#deleteSectionAlloBtn', function () {
        var id = $(this).data('id');
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this section allocation',
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
                $.post(sectionAllocationDelete, { id: id }, function (data) {
                    if (data.code == 200) {
                        $('#allocation-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.success(data.message);
                    }
                }, 'json');
            }
        });
    });

});
