$(function () {

    globalSettingTable();
    $("#globalSettingForm").validate({
        rules: {
            year_id: "required"
        }
    });
    $("#edit-global-setting-form").validate({
        rules: {
            year_id: "required"
        }
    });
    // add globalSetting
    $('#globalSettingForm').on('submit', function (e) {
        e.preventDefault();
        var globalCheck = $("#globalSettingForm").valid();
        if (globalCheck === true) {
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
                        $('#global-setting-table').DataTable().ajax.reload(null, false);
                        $('.addGlobalSetting').modal('hide');
                        $('.addGlobalSetting').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all globalSetting table
    function globalSettingTable() {
        $('#global-setting-table').DataTable({
            processing: true,
            info: true,
            bDestroy: true,
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
                    }

                }
            ],
            ajax: globalSettingList,
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
                    data: 'academic_year',
                    name: 'academic_year'
                },
                {
                    data: 'footer_text',
                    name: 'footer_text'
                },
                {
                    data: 'timezone',
                    name: 'timezone'
                },
                {
                    data: 'facebook_url',
                    name: 'facebook_url'
                },
                {
                    data: 'twitter_url',
                    name: 'twitter_url'
                },
                {
                    data: 'linkedin_url',
                    name: 'linkedin_url'
                },
                {
                    data: 'youtube_url',
                    name: 'youtube_url'
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
    $(document).on('click', '#editGlobalSettingBtn', function () {
        var id = $(this).data('id');

        $('.editGlobalSetting').find('form')[0].reset();
        $.post(globalSettingDetails, { id: id }, function (data) {
            $('.editGlobalSetting').find('input[name="id"]').val(data.data.id);
            $('.editGlobalSetting').find('select[name="year_id"]').val(data.data.year_id);
            $('.editGlobalSetting').find('textarea[name="footer_text"]').val(data.data.footer_text);
            $('.editGlobalSetting').find('select[name="timezone"]').val(data.data.timezone);
            $('.editGlobalSetting').find('select[name="language_id"]').val(data.data.language_id);
            $('.editGlobalSetting').find('input[name="facebook_url"]').val(data.data.facebook_url);
            $('.editGlobalSetting').find('input[name="twitter_url"]').val(data.data.twitter_url);
            $('.editGlobalSetting').find('input[name="linkedin_url"]').val(data.data.linkedin_url);
            $('.editGlobalSetting').find('input[name="youtube_url"]').val(data.data.youtube_url);
            $('.editGlobalSetting').modal('show');
        }, 'json');
        console.log(id);
    });
    // update GlobalSetting
    $('#edit-global-setting-form').on('submit', function (e) {
        e.preventDefault();
        var edt_globalCheck = $("#edit-global-setting-form").valid();
        if (edt_globalCheck === true) {

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
                            $('#global-setting-table').DataTable().ajax.reload(null, false);
                            $('.editGlobalSetting').modal('hide');
                            $('.editGlobalSetting').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editGlobalSetting').modal('hide');
                            $('.editGlobalSetting').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete GlobalSettingDelete
    // $(document).on('click', '#deleteGlobalSettingBtn', function () {
    //     var id = $(this).data('id');
    //     var url = globalSettingDelete;
    //     swal.fire({
    //         title: 'Are you sure?',
    //         html: 'You want to <b>delete</b> this Leave Type',
    //         showCancelButton: true,
    //         showCloseButton: true,
    //         cancelButtonText: 'Cancel',
    //         confirmButtonText: 'Yes, Delete',
    //         cancelButtonColor: '#d33',
    //         confirmButtonColor: '#556ee6',
    //         width: 400,
    //         allowOutsideClick: false
    //     }).then(function (result) {
    //         if (result.value) {
    //             $.post(url, {
    //                 id: id
    //             }, function (data) {
    //                 if (data.code == 200) {
    //                     $('#global-setting-table').DataTable().ajax.reload(null, false);
    //                     toastr.success(data.message);
    //                 } else {
    //                     toastr.error(data.message);
    //                 }
    //             }, 'json');
    //         }
    //     });
    // });
});