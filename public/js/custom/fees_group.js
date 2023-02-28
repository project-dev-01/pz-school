$(function () {
    
    $(".date-picker").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
    });

    feesGroupTable();
    $("#feesGroupForm").validate({
        rules: {
            name: "required"
        }
    });
    $("#edit-fees-group-form").validate({
        rules: {
            name: "required"
        }
    });
    // add feesGroup
    $('#feesGroupForm').on('submit', function (e) {
        e.preventDefault();
        var FeesCheck = $("#feesGroupForm").valid();
        if (FeesCheck === true) {
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
                        $('#fees-group-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                        window.location.href = feesGroupList;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all feesGroup table
    function feesGroupTable() {
        $('#fees-group-table').DataTable({
            processing: true,
            info: true,
            // dom: 'lBfrtip',
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            buttons: [
                {
                    extend: 'csv',
                    text: 'Download CSV',
                    extension: '.csv',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: 'Download PDF',
                    extension: '.pdf',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }

                }
            ],
            ajax: feesGroupList,
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
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'description',
                    name: 'description'
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
    // update FeesGroup
    $('#edit-fees-group-form').on('submit', function (e) {
        e.preventDefault();
        var edt_feesCheck = $("#edit-fees-group-form").valid();
        if (edt_feesCheck === true) {

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
                            $('#fees-group-table').DataTable().ajax.reload(null, false);
                            toastr.success(data.message);
                            window.location.href = feesGroupList;
                        } else {
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete FeesGroupDelete
    $(document).on('click', '#deleteFeesGroupBtn', function () {
        var id = $(this).data('id');
        var url = feesGroupDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Fees Type',
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
                        $('#fees-group-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});