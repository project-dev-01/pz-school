$(function () {

    $('.block_warden').select2({
        dropdownParent: $('#editHostelBlockModal')
    });

    hostelBlockTable();
    $(document).on('click', '#addHostelBlock', function () {
        $('.addHostelBlock').find('form')[0].reset();   
        console.log('1')
        $('#hostelBlockForm').trigger("reset");
    });
    $("#edit-hostel-block-form").validate({
        rules: {
            "block_name": "required",
            "block_warden[]": "required",
            "total_floor": "required"
        }
    });
    $("#hostelBlockForm").validate({
        rules: {
            "block_name": "required",
            "block_warden[]": "required",
            "total_floor": "required"
        }
    });
    
    $('.block_warden').select2();
    // add hostelBlock
    $('#hostelBlockForm').on('submit', function (e) {
        e.preventDefault();
        var hostelCheck = $("#hostelBlockForm").valid();
        if (hostelCheck === true) {
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
                        $('#hostel-block-table').DataTable().ajax.reload(null, false);
                        $('.addHostelBlock').modal('hide');
                        $('.addHostelBlock').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all HostelBlock table
    function hostelBlockTable() {
         $('#hostel-block-table').DataTable({
            processing: true,
            info: true,
            bDestroy:true,
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
                    }

                }
            ],
            ajax: hostelBlockList,
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
                    data: 'block_name',
                    name: 'block_name'
                },
                {
                    data: 'block_warden',
                    name: 'block_warden'
                },
                {
                    data: 'total_floor',
                    name: 'total_floor'
                },
                {
                    data: 'block_leader',
                    name: 'block_leader'
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
    // get row
    $(document).on('click', '#editHostelBlockBtn', function () {
        var id = $(this).data('id');
     
        $('.editHostelBlock').find('form')[0].reset();   
        $.post(hostelBlockDetails, { id: id }, function (data) {
            $('.editHostelBlock').find('input[name="id"]').val(data.data.id);
            $('.editHostelBlock').find('input[name="block_name"]').val(data.data.block_name);
            $('.editHostelBlock').find('input[name="total_floor"]').val(data.data.total_floor);

            var warden_arr = [];
            if(data.data.block_warden) {
                var warden_arr = data.data.block_warden.split(',');
            }
            $(".block_warden").select2();
            $(".block_warden").val(warden_arr).trigger("change");

            var leader_arr = [];
            if(data.data.block_leader) {
                var leader_arr = data.data.block_leader.split(',');
            }
            
            $(".block_leader").select2();
            $(".block_leader").val(leader_arr).trigger("change");
            
            $('.editHostelBlock').modal('show');
        }, 'json');
    });
    $("#edit-hostel-block-form").validate({
        rules: {
            block_name: "required",
            block_warden: "required",
            total_floor: "required"
        }
    });
    // update HostelBlock
    $('#edit-hostel-block-form').on('submit', function (e) {
        e.preventDefault();
        var edt_hostelCheck = $("#edit-hostel-block-form").valid();
        if (edt_hostelCheck === true) {
      
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
                            $('#hostel-block-table').DataTable().ajax.reload(null, false);
                            $('.editHostelBlock').modal('hide');
                            $('.editHostelBlock').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editHostelBlock').modal('hide');
                            $('.editHostelBlock').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete HostelBlockDelete
    $(document).on('click', '#deleteHostelBlockBtn', function () {
        var id = $(this).data('id');
        var url = hostelBlockDelete;
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
                    id: id
                }, function (data) {
                    if (data.code == 200) {
                        $('#hostel-block-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});