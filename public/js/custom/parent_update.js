$(function () {

    $(document).on('click', '#updateViewModalDetails', function () {
        var id = $(this).data('id');
        var type = $(this).data('type');
        
        $("#parent_update_view_body").empty();
        $.post(parentUpdateView, { id: id,type: type,token: token,branch_id: branchID }, function (res) {
            var row = "";
            if (res.code == 200) {
                $.each(res.data.data, function (key, val) {
                    var field = key+"_lang";
                    var status = "";
                    var color = "";
                    if(val.status=="accept"){
                        status = "Accept"
                        color = "success";
                    }else if(val.status=="reject"){
                        status = "Reject"
                        color = "danger";
                    }else if(val.status=="remand"){
                        status = "Remand"
                        color = "info";
                    }
                    var remark = "";
                    if(val.remark  != null){
                        remark = val.remark;
                    }

                    if(key== "passport_photo" || key== "visa_photo" || key== "japanese_association_membership_image_supplimental" || key== "japanese_association_membership_image_principal" || key=="nric_photo"){
                        row += '<tr> <td >'+window[field]+'</td><td ><a href= '+parentImg+val.old_value+' target="_blank">'+val.old_value+' </a></td> <td ><a href= '+parentImg+val.new_value+' target="_blank">'+val.new_value+' </a></td> <td ><div class="button-list"><span class="badge badge-soft-'+ color+' p-1">'+status+'</span></div></td><td >'+remark+'</td></tr>';
                
                    }else{
                        row += '<tr> <td >'+window[field]+'</td><td >'+val.old_value+'</td> <td >'+val.new_value+'</td> <td ><div class="button-list"><span class="badge badge-soft-'+ color+' p-1">'+status+'</span></div></td><td >'+remark+'</td></tr>';
                
                    }
                    
                    });
                
                $("#remarks").val(res.data.remarks);
                $("#parent_update_view_body").append(row);
            }
        });
    });
    $(document).on('click', ".remand", function () {
        var name = $(this).attr("remand");
        console.log("name",name)
        $("#"+name+"_view").show();
    });
    
    $(document).on('click', ".remove", function () {
        var name = $(this).attr("remand");
        $("#"+name+"_view").hide();
    });

    // $("#updateParentInfo").validate({
    //     rules: {
    //         first_name: "required",
            
    //     }
    // });


    $('#updateParentInfo').on('submit', function (e) {
        e.preventDefault();
        console.log('123')
        
        // var updateCheck = $("#updateParentInfo").valid();
        // if (updateCheck === true) {
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
                        window.location.href = parentUpdateMenu;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        // }
    });

    $('#parent-update-table').DataTable({
        processing: true,
        info: true,
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
         initComplete: function () {
            var table = this;
            $.ajax({
                url: parentUpdateList,
                success: function(data) {
                    console.log(data.data.length);
                    if (data && data.data.length > 0) {
                        console.log('ok');
                        $('#parent-update-table_wrapper .buttons-csv').removeClass('disabled');
                        $('#parent-update-table_wrapper .buttons-pdf').removeClass('disabled');  // Enable all buttons if at least one record exists
                    } else {
                        console.log(data);
                        $('#parent-update-table_wrapper .buttons-csv').addClass('disabled');
                        $('#parent-update-table_wrapper .buttons-pdf').addClass('disabled');               
                    }
                },
                error: function() {
                    console.log('error');
                    // Handle error if necessary
                }
            });
        },
        ajax: parentUpdateList,
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
                data: 'email',
                name: 'email'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false
            },
        ],
        columnDefs: [
            {
                "targets": 1,
                "className": "table-user",
                "render": function (data, type, row, meta) {

                    // if ((row.photo != null) || (row.photo != "")) {
                    if (row.photo) {
                        var currentImg = parentImg + '/' + row.photo;
                    } else {
                        var currentImg = defaultImg;
                    }
                    var img = currentImg;
                    var first_name = '<img src="' + img + '" class="mr-2 rounded-circle" alt="No Image">' +
                        '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                    return first_name;
                }
            }
        ]
    }).on('draw', function () {
    });
});