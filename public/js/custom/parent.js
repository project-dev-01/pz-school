$(function () {

    $('#authentication').click(function() {

        if ($("#status").prop('checked') == true) {
            $("#status").prop('checked',false);
            $("#status").val("0");
            $("#authentication").addClass("fa-lock-open");
            $("#authentication").removeClass("fa-lock");
        } else {
            $("#status").prop('checked',true);
            $("#status").val("1");
            $("#authentication").removeClass("fa-lock-open");
            $("#authentication").addClass("fa-lock");
        }
    });

    $('#edit_authentication').click(function() {

        if ($("#edit_status").prop('checked') == true) {
            $("#edit_status").prop('checked',false);
            $("#edit_status").val("0");
            $("#edit_authentication").addClass("fa-lock-open");
            $("#edit_authentication").removeClass("fa-lock");
        } else {
            $("#edit_status").prop('checked',true);
            $("#edit_status").val("1");
            $("#edit_authentication").removeClass("fa-lock-open");
            $("#edit_authentication").addClass("fa-lock");
        }
    });

    $("#date_of_birth").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
    });
    $("#addparent").validate({
        rules: {
            first_name: "required",
            last_name: "required",
            email: {
                required: true,
                email: true
            },
            occupation: "required",
            mobile_no: "required",
            password: "required",
            confirm_password: "required",
        }
    });

    $('#addparent').on('submit', function (e) {
        e.preventDefault();
        var parentcheck = $("#addparent").valid();
        if (parentcheck === true) {
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
                        toastr.success(data.message);
                        window.location.href = indexParent;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    $("#editParent").validate({
        rules: {
            first_name: "required",
            last_name: "required",
            email: {
                required: true,
                email: true
            },
            occupation: "required",
            mobile_no: "required",
        }
    });

    $('#editParent').on('submit', function (e) {
        e.preventDefault();
        console.log('123')
        var parentcheck = $("#editParent").valid();
        if (parentcheck === true) {
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
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    
    parentTable();

    // get all parent table
    function parentTable() {
        $('#parent-table').DataTable({
            processing: true,
            info: true,
            ajax: parentList,
            "pageLength": 5,
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
                    data: 'first_name',
                    name: 'first_name'
                },
                {
                    data: 'last_name',
                    name: 'last_name'
                },
                {
                    data: 'occupation',
                    name: 'occupation'
                },
                {
                    data: 'mobile_no',
                    name: 'mobile_no'
                },
                {
                    data: 'email',
                    name: 'email'
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

   // delete Parent 
   $(document).on('click', '#deleteParentBtn', function () {
        var id = $(this).data('id');
        var url = parentDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Parent',
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
                        $('#parent-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});