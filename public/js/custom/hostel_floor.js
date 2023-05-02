$(function () {

    hostelFloorTable();
    $(document).on('click', '#addHostelFloor', function () {

        console.log('1')
        $('.select2-selection__rendered').html('<li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" placeholder="Choose ..." style="width: 424.034px;" aria-controls="select2-block_warden-jy-results" aria-activedescendant="select2-block_warden-jy-result-hnrw-54"></li>');
        $('#hostelFloorForm').trigger("reset");
    });
    $("#hostelFloorForm").validate({
        rules: {
            floor_name: "required",
            block_id: "required",
            floor_warden: "required",
            total_room: "required",
        }
    });
    $("#edit-hostel-floor-form").validate({
        rules: {
            floor_name: "required",
            block_id: "required",
            floor_warden: "required",
            total_room: "required",
        }
    });
    // add hostelFloor
    $('#hostelFloorForm').on('submit', function (e) {
        e.preventDefault();
        var hostelCheck = $("#hostelFloorForm").valid();
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
                        $('#hostel-floor-table').DataTable().ajax.reload(null, false);
                        $('.addHostelFloor').modal('hide');
                        $('.addHostelFloor').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all HostelFloor table
    function hostelFloorTable() {
        $('#hostel-floor-table').DataTable({
            processing: true,
            info: true,
            bDestroy: true,
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
            ajax: hostelFloorList,
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
                    data: 'floor_name',
                    name: 'floor_name'
                },
                {
                    data: 'block_id',
                    name: 'block_id'
                },
                {
                    data: 'floor_warden',
                    name: 'floor_warden'
                },
                {
                    data: 'total_room',
                    name: 'total_room'
                },
                {
                    data: 'floor_leader',
                    name: 'floor_leader'
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
    $(document).on('click', '#editHostelFloorBtn', function () {
        var id = $(this).data('id');

        $('.editHostelFloor').find('form')[0].reset();
        $.post(hostelFloorDetails, { id: id }, function (data) {
            $('.editHostelFloor').find('input[name="id"]').val(data.data.id);
            $('.editHostelFloor').find('input[name="floor_name"]').val(data.data.floor_name);
            $('.editHostelFloor').find('select[name="block_id"]').val(data.data.block_id);
            // $('.editHostelFloor').find('input[name="floor_warden"]').val(data.data.floor_warden);
            $('.editHostelFloor').find('input[name="total_room"]').val(data.data.total_room);
            // $('.editHostelFloor').find('input[name="floor_leader"]').val(data.data.floor_leader);

            var arr = data.data.floor_warden.split(',');
            var output = "";
            $.each(arr, function (index, value) {

                var name = $("#floor_warden_div option[value='" + value + "']").text();
                output += '<li class="select2-selection__choice" title="' + name + ' " data-select2-id="' + value + '"><span class="select2-selection__choice__remove" role="presentation">×</span>' + name + ' </li>';

            });
            $('#floor_warden_div .select2-selection__rendered').html(output);
            var arr2 = data.data.floor_leader.split(',');
            var output2 = "";
            $.each(arr2, function (index2, value2) {

                var name2 = $("#floor_leader_div option[value='" + value2 + "']").text();
                output2 += '<li class="select2-selection__choice" title="' + name2 + ' " data-select2-id="' + value2 + '"><span class="select2-selection__choice__remove" role="presentation">×</span>' + name2 + ' </li>';

            });
            $('#floor_leader_div .select2-selection__rendered').html(output2);
            $('.editHostelFloor').modal('show');
        }, 'json');
    });
    // update HostelFloor
    $('#edit-hostel-floor-form').on('submit', function (e) {
        e.preventDefault();
        var edt_hostelCheck = $("#edit-hostel-floor-form").valid();
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
                            $('#hostel-floor-table').DataTable().ajax.reload(null, false);
                            $('.editHostelFloor').modal('hide');
                            $('.editHostelFloor').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editHostelFloor').modal('hide');
                            $('.editHostelFloor').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete HostelFloorDelete
    $(document).on('click', '#deleteHostelFloorBtn', function () {
        var id = $(this).data('id');
        var url = hostelFloorDelete;
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
                        $('#hostel-floor-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});