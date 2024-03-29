$(function () {

    $(document).ready(function () {

        $('#terminationModal').on('shown.bs.modal', function () {
            $("#date_of_termination").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                autoclose: true,
                yearRange: "-100:+50", // last hundred years
                container: '#terminationModal modal-body'
            });
        });

    });
    $('#termination_status').on('change', function () {
        var status = $(this).val();
        
        $("#remarks_row").hide();
        $("#date_of_termination_row").hide();
        if(status=="Approved"){

            $("#date_of_termination_row").show();
        }else if(status=="Send Back" || status=="Rejected"){

            $("#remarks_row").show();
        }
    });
    
    $(document).on('click', '#editTerminationBtn', function () {
        
        $('#date_of_termination_row').hide();
        $('#remarks_row').hide();
        $('#student_status_row').hide();
        var id = $(this).data('id');

        // $('.editAbsentReason').find('form')[0].reset();
        $.post(terminationDetails, { id: id,token: token,branch_id: branchID }, function (data) {
            
            // console.log('id',data)
            if (data.code == 200) {
                $('#id').val(data.data.id);
                
                $('#name').text(data.data.name);
                $('#date').text(data.data.date);
                $('#control_number').text(data.data.control_number);
                $('#schedule_date_of_termination').val(data.data.schedule_date_of_termination);
                $('#reason_for_transfer').val(data.data.reason_for_transfer);
                $('#transfer_destination_school_name').val(data.data.transfer_destination_school_name);
                $('#transfer_destination_tel').val(data.data.transfer_destination_tel);
                $('#parent_phone_number_after_transfer').val(data.data.parent_phone_number_after_transfer);
                $('#parent_email_address_after_transfer').val(data.data.parent_email_address_after_transfer);
                $('#school_fees_payment_status').val(data.data.school_fees_payment_status);
                $('#termination_status').val(data.data.termination_status);
                $('#termination_status_old').val(data.data.termination_status);
                console.log('123',data.data.delete_google_address)
                if(data.data.delete_google_address == "Yes"){
                    $('#delete_google_address').prop('checked',true)
                }
                if(data.data.date_of_termination){
                $('#date_of_termination').val(data.data.date_of_termination);
                $('#date_of_termination_row').show();
                }
                if(data.data.termination_status=="Approved"){
                    // console.log('date_of_termination',date_of_termination)
                    if(data.data.date_of_termination < data.data.today_date ){
                        if(data.data.student_status){
                            $('#student_status').val(data.data.student_status);
                        }else{
                            $('#student_status').val("Deactive");
                        }
                        $('#student_status_row').show();
                    }
                }

                if(data.data.remarks){
                    $('#remarks').val(data.data.remarks);
                    $('#remarks_row').show();
                }
                
                // $('#reason_for_transfer').val(data.data.reason_for_transfer);
                // $('#reason_for_transfer').val(data.data.reason_for_transfer);
            }
            $('.editAbsentReason').modal('show');
        }, 'json');
    });
    
    $("#terminationEditForm").validate({
        rules: {
            // date_of_termination : "required", 
            termination_status: "required", 
            school_fees_payment_status : "required", 
        }
    });
    $('#school_fees_payment_status').on('change', function () {
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
                        
                        $('#termination-table').DataTable().ajax.reload(null, false);
                        $('.updateTermination').modal('hide');
                        $('.updateTermination').find('form')[0].reset();
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