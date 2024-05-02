$(function () {

    formFieldTable();

    // get all formField table
    function formFieldTable() {
        $('#form-field-table').DataTable({
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
                    },
                    enabled: false, // Initially disable CSV button
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
                    enabled: false, // Initially disable PDF button
                }
            ],
            initComplete: function () {
                var table = this;
                $.ajax({
                    url: formFieldList,
                    success: function(data) {
                        console.log(data.data.length);
                        if (data && data.data.length > 0) {
                            console.log('ok');
                            $('#form-field-table_wrapper .buttons-csv').removeClass('disabled');
                            $('#form-field-table_wrapper .buttons-pdf').removeClass('disabled');  // Enable all buttons if at least one record exists
                        } else {
                            console.log(data);
                            $('#form-field-table_wrapper .buttons-csv').addClass('disabled');
                            $('#form-field-table_wrapper .buttons-pdf').addClass('disabled');               
                        }
                    },
                    error: function() {
                        console.log('error');
                        // Handle error if necessary
                    }
                });
            },
            ajax: formFieldList,
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
                    data: 'name_english',
                    name: 'name_english'
                },
                {
                    data: 'name_common',
                    name: 'name_common'
                },
                {
                    data: 'visa',
                    name: 'visa'
                },
                {
                    data: 'passport',
                    name: 'passport'
                },
                {
                    data: 'nationality',
                    name: 'nationality'
                },
                {
                    data: 'nric',
                    name: 'nric'
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
    $(document).on('click', '#editFormFieldBtn', function () {
        var id = $(this).data('id');

        $('.editFormField').find('form')[0].reset();
        $.post(formFieldDetails, { id: id }, function (data) {
            console.log('qww',data)
            
            $('.editFormField').find('input[name="id"]').val(data.data.id);
            if(data.data.name_english == 0){
                $('.editFormField').find('input[name="name_english"]').prop('checked',true);
            }
            if(data.data.name_common == 0){
                $('.editFormField').find('input[name="name_common"]').prop('checked',true);
            }
            if(data.data.name_furigana == 0){
                $('.editFormField').find('input[name="name_furigana"]').prop('checked',true);
            }
            if(data.data.visa == 0){
                $('.editFormField').find('input[name="visa"]').prop('checked',true);
            }
            if(data.data.nationality == 0){
                $('.editFormField').find('input[name="nationality"]').prop('checked',true);
            }
            if(data.data.passport == 0){
                $('.editFormField').find('input[name="passport"]').prop('checked',true);
            }
            if(data.data.nric == 0){
                $('.editFormField').find('input[name="nric"]').prop('checked',true);
            }
            if(data.data.race == 0){
                $('.editFormField').find('input[name="race"]').prop('checked',true);
            }
            if(data.data.religion == 0){
                $('.editFormField').find('input[name="religion"]').prop('checked',true);
            }
            if(data.data.blood_group == 0){
                $('.editFormField').find('input[name="blood_group"]').prop('checked',true);
            }
            $('.editFormField').modal('show');
        }, 'json');
        console.log(id);
    });
    // update FormField
    $('#edit-form-field-form').on('submit', function (e) {
        e.preventDefault();

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
                            $('#form-field-table').DataTable().ajax.reload(null, false);
                            $('.editFormField').modal('hide');
                            $('.editFormField').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editFormField').modal('hide');
                            $('.editFormField').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
    });
});