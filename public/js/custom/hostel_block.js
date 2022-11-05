$(function () {

    hostelBlockTable();
    $(document).on('click', '#addHostelBlock', function () {
        
        console.log('1')
        $('.select2-selection__rendered').html('<li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" placeholder="Choose ..." style="width: 424.034px;" aria-controls="select2-block_warden-jy-results" aria-activedescendant="select2-block_warden-jy-result-hnrw-54"></li>');
        $('#hostelBlockForm').trigger("reset");
    });
    $("#edit-hostel-block-form").validate({
        rules: {
            block_name: "required",
            block_warden: "required",
            total_floor: "required",
        }
    });
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
            dom: 'lBfrtip',
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
            var arr = data.data.block_warden.split(',');
            if(data.data.block_warden) {
                var arr = data.data.block_warden.split(',');
            }else {
                var arr = "";
            }
            $('.editHostelBlock').find('select[name="block_warden[]"]').val(arr);
            var output = "";
            $.each(arr, function(index, value) {
                
                var name = $("#block_warden_div option[value='"+value+"']").text();
                output += '<li class="select2-selection__choice" title="'+name+' " data-select2-id="'+value+'"><span class="select2-selection__choice__remove" role="presentation">×</span>'+name+' </li>';
                
              });
            $('#block_warden_div .select2-selection__rendered').html(output);

            if(data.data.block_leader) {
                var arr2 = data.data.block_leader.split(',');
            }else {
                var arr2 = "";
            }
            $('.editHostelBlock').find('select[name="block_leader[]"]').val(arr2);
            var output2 = "";
            $.each(arr2, function(index2, value2) {
                
                var name2 = $("#block_leader_div option[value='"+value2+"']").text();
                output2 += '<li class="select2-selection__choice" title="'+name2+' " data-select2-id="'+value2+'"><span class="select2-selection__choice__remove" role="presentation">×</span>'+name2+' </li>';
                
              });
              $('#block_leader_div .select2-selection__rendered').html(output2);
            $('.editHostelBlock').modal('show');
        }, 'json');
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
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Hostel Block',
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