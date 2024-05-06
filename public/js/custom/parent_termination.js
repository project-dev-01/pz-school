$(function () {

    
    $(".number_validation").keypress(function(event){
        console.log(123)
        var regex = new RegExp("^[0-9-+]");
        var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });
    $("#date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-3:+6", // last hundred years
    });

    $("#schedule_date_of_termination").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        minDate: 0,
        yearRange: "-3:+6", // last hundred years
    });
    
    $("#date_of_termination").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
         minDate: 0,
        yearRange: "-3:+6", // last hundred years
    });
    $("#terminationForm").validate({
        rules: {
            student_id : "required",
            date : "required",
            schedule_date_of_termination : "required", 
            reason_for_transfer : "required", 
            transfer_destination_school_name : "required", 
            transfer_destination_tel : "required", 
            parent_phone_number_after_transfer: {
                required: true,
                number : true 
            },         
            parent_address_after_transfer : "required", 
            parent_email_address_after_transfer: {
                required: true,
                email: true
            },
        }
    });
    $('#terminationForm').on('submit', function(e){
        e.preventDefault();
        var form = this;
        var terminationCheck = $("#terminationForm").valid();
        if (terminationCheck === true) {
            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:new FormData(form),
                processData:false,
                dataType:'json',
                contentType:false,
                success: function(data){
                    if (data.code == 200) {
                        // $('#termination-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                        window.location.href = terminationList;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    $("#terminationEditForm").validate({
        rules: {
            student_id : "required",
            control_number : "required",
            date : "required",
            schedule_date_of_termination : "required", 
            reason_for_transfer : "required", 
            transfer_destination_school_name : "required", 
            transfer_destination_tel : "required", 
            parent_phone_number_after_transfer: {
                required: true,
                number : true 
            }, 
            parent_address_after_transfer : "required", 
            parent_email_address_after_transfer: {
                required: true,
                email: true
            },
        }
    });
    $('#school_fees_payment_status').on('change', function () {
        console.log("hjhjhjghu");
        var isUnpaidSelected = $(this).val() === 'Unpaid';
        $('#termination_status option[value="Approved"]').prop('disabled', isUnpaidSelected);
        $('#termination_status').val('').trigger('change'); 
    });
    $('#terminationEditForm').on('submit', function(e){
        e.preventDefault();

        var terminationCheck = $("#terminationEditForm").valid();
        if (terminationCheck === true) {
            var form = this;
            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:new FormData(form),
                processData:false,
                dataType:'json',
                contentType:false,
                success: function(data){
                    if (data.code == 200) {
                        // $('#termination-table').DataTable().ajax.reload(null, false);
                        window.location.href = terminationList;
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    
    terminationTable();
    
    function terminationTable() {
        $('#termination-table').DataTable({
            processing: true,
            info: true,
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
            ajax: terminationList,
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
                    data: 'control_number',
                    name: 'control_number'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'name_english',
                    name: 'name_english'
                },
                {
                    data: 'gender',
                    name: 'gender'
                },
                {
                    data: 'parent_email_address_after_transfer',
                    name: 'parent_email_address_after_transfer'
                },
                {
                    data: 'academic_year',
                    name: 'academic_year'
                },
                {
                    data: 'class_name',
                    name: 'class_name'
                },
                {
                    data: 'termination_status',
                    name: 'termination_status'
                },
                {
                    data: 'date_of_termination',
                    name: 'date_of_termination'
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

    // delete Termination Type
    $(document).on('click','#deleteTerminationBtn', function(){
        var termination_id = $(this).data('id');
        swal.fire({
             title:deleteTitle + '?',
             html:deleteHtml,
             showCancelButton:true,
             showCloseButton:true,
             cancelButtonText:deletecancelButtonText,
             confirmButtonText:deleteconfirmButtonText,
             cancelButtonColor:'#d33',
             confirmButtonColor:'#556ee6',
             width:400,
             allowOutsideClick:false
        }).then(function(result){
              if(result.value){
                  $.post(terminationDelete,{id:termination_id}, function(data){
                       if(data.code == 200){
                           $('#termination-table').DataTable().ajax.reload(null, false);
                           toastr.success(data.message);
                       }else{
                           toastr.error(data.message);
                       }
                  },'json');
              }
        });
    });


});