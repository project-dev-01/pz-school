$(function () {


    $('#country').on('change', function () {
        var country = $(this).val();
        console.log('cou',country)
        $("#bank_name").empty();
        $("#bank_name").append('<option value="">'+select_bank+'</option>');
        $.get(getBankByCountry, { token: token, branch_id: branchID, country: country}, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#bank_name").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    bankAccountTable();

    $("#bankAccountForm").validate({
        rules: {
            bank_name: "required",
            holder_name: "required",
            email: "required",
            account_no: "required",
        }
    });
    $('#bankAccountForm').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        var banAccountCheck = $("#bankAccountForm").valid();
        if (banAccountCheck === true) {
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
                    if (data.code == 200) {
                        $('#bank-account-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                        window.location.href = bankAccountList;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    $("#bankAccountEditForm").validate({
        rules: {
            bank_name: "required",
            holder_name: "required",
            email: "required",
            account_no: "required",
        }
    });
    $('#bankAccountEditForm').on('submit', function (e) {
        e.preventDefault();
        var banAccountCheck = $("#bankAccountEditForm").valid();
        if (banAccountCheck === true) {
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
                            $('#bank-account-table').DataTable().ajax.reload(null, false);
                            window.location.href = bankAccountList;
                            toastr.success(data.message);
                        } else {
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    function bankAccountTable() {
        $('#bank-account-table').DataTable({
            processing: true,
            info: true,
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            //dom: 'lBfrtip',
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
                        doc.pageMargins = [50,50,50,50];
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
                        
                        doc['footer']=(function(page, pages) {
                            return {
                                columns: [
                                    { alignment: 'left', text: [ footer_txt ],width:400} ,
                                    {
                                        // This is the right column
                                        alignment: 'right',
                                        text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }],
                                        width:100
    
                                    }
                                ],
                                margin: [50, 0,0,0]
                            }
                        });
                        
                    }

                }
            ],
            ajax: bankAccountList,
            "pageLength": 10,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                //  {data:'id', name:'id'},
                // {
                //     data: 'checkbox',
                //     name: 'checkbox',
                //     orderable: false,
                //     searchable: false
                // },
                {
                    searchable: false,
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'bank_name',
                    name: 'bank_name'
                },
                {
                    data: 'holder_name',
                    name: 'holder_name'
                },
                {
                    data: 'account_no',
                    name: 'account_no',
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: false,
                    searchable: false
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

    // delete BankAccount
    $(document).on('click', '#deleteBankAccountBtn', function () {
        var bank_account_id = $(this).data('id');
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
                $.post(bankAccountDelete, { id: bank_account_id }, function (data) {
                    if (data.code == 200) {
                        $('#bank-account-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    // Publish Event 
    $(document).on('click', '.bankAccountStatusBtn', function () {
        var bank_account_id = $(this).data('id');
        console.log('sttu')
        if ($(this).prop('checked') == true) {
            var value = 1;
            var statushtml = activeHtml;
        } else {
            var value = 0;
            var statushtml = inactiveHtml;
        }
        swal.fire({
            title: deleteTitle + '?',
            html: statushtml,
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonText: deletecancelButtonText,
            confirmButtonText: statusconfirmButtonText,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#556ee6',
            width: 400,
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                $.post(bankAccountStatus, { id: bank_account_id, status: value }, function (data) {
                    if (data.code == 200) {
                        $('#bank-account-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }else{
                $('#bank-account-table').DataTable().ajax.reload(null, false);
            }
        });
    });

});