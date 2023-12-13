$(function () {

    $("#passport_expiry_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-3:+6", // last hundred years
    });

    $("#visa_expiry_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-3:+6", // last hundred years
    });
    
    $('#passport_photo').change(function() {
        // var i = $(this).prev('label').clone();
        var file = $('#passport_photo')[0].files[0];
        if(file.size > 2097152) {
            $('#passport_photo_name').text("File greater than 2Mb");
            $("#passport_photo_name").addClass("error");
            $('#passport_photo').val('');
        } else {
            $("#passport_photo_name").removeClass("error");
            $('#passport_photo_name').text(file.name);
        }
    });
    
    $('#visa_photo').change(function() {
        // var i = $(this).prev('label').clone();
        var file = $('#visa_photo')[0].files[0];
        if(file.size > 2097152) {
            $('#visa_photo_name').text("File greater than 2Mb");
            $("#visa_photo_name").addClass("error");
            $('#visa_photo').val('');
        } else {
            $("#visa_photo_name").removeClass("error");
            $('#visa_photo_name').text(file.name);
        }
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

    $('#student-update-table').DataTable({
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
        ajax: studentUpdateList,
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
                data: 'roll_no',
                name: 'roll_no'
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
    $(".number_validation").keypress(function () {
        var regex = new RegExp("^[0-9-+]");
        var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });
    $("#student").hide();
    var father_id = $("#father_id").val();
    if (father_id) {
        father(father_id);
    }

    var mother_id = $("#mother_id").val();
    if (mother_id) {
        mother(mother_id);
    }

    var guardian_id = $("#guardian_id").val();
    if (guardian_id) {
        guardian(guardian_id);
    }

    $("#admission_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-3:+6", // last hundred years
    });
    $("#dob").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-60:+1", // last hundred years
        maxDate: 0
    });

    $('#guardian_name').keyup(function () {
        var name = $(this).val();
        if (name != '') {
            $.ajax({
                url: parentName,
                method: "GET",
                data: { token: token, branch_id: branchID, name: name },
                success: function (data) {
                    $('#guardian_list').fadeIn();
                    $('#guardian_list').html(data);
                }
            });
        }
    });

    $('#guardian_list').on('click', 'li', function () {

        $('#guardian_name').val($(this).text());
        $('#guardian_list').fadeOut();
        var value = $(this).text();
        if (value == "No results Found") {
            $('#guardian_name').val("");
            $("#guardian_form").hide("slow");
            $("#guardian_photo").hide();

        } else {
            var id = $(this).val();
            guardian(id);
        }
    });

    function guardian(id) {
        $('#guardian_id').val(id);
        $("#guardian_form").show("slow");
        $("#guardian_info").show();
        $("#guardian_photo").show();
        $.post(parentDetails, { token: token, branch_id: branchID, id: id }, function (res) {
            if (res.code == 200) {
                var data = res.data.parent;
                if (data.photo) {
                    var src = parentImg + "/" + data.photo;
                } else {
                    var src = defaultImg;
                }
                var name = data.first_name + " " + data.last_name;
                $('#guardian_name').val(name);
                $("#guardian_photo").html('<img src="' + src + '" class="img-fluid d-block rounded" style="width:100px" />');
                $("#guardian_first_name").val(data.first_name);
                $("#guardian_last_name").val(data.last_name);
                $("#guardian_email").val(data.email);
                $("#guardian_nric").val(data.nric);
                $("#guardian_gender").val(data.gender);
                $("#guardian_date_of_birth").val(data.date_of_birth);
                $("#guardian_passport").val(data.passport);
                $("#guardian_country").val(data.country);
                $("#guardian_post_code").val(data.post_code);
                $("#guardian_address_2").val(data.address_2);
                $("#guardian_occupation").val(data.occupation);
                $("#guardian_income").val(data.income);
                $("#guardian_blooddgrp").val(data.blood_group);
                $("#guardian_education").val(data.education);
                $("#guardian_mobile_no").val(data.mobile_no);
                $("#guardian_state").val(data.state);
                $("#guardian_city").val(data.city);
                $("#guardian_address").val(data.address);

                $(".guardian_name").html(name);
                $(".guardian_date_of_birth").html(data.date_of_birth);
                $(".guardian_email").html(data.email);
                $(".guardian_passport").html(data.passport);
                $(".guardian_country").html(data.country);
                $(".guardian_post_code").html(data.post_code);
                $(".guardian_address_2").html(data.address_2);
                $(".guardian_nric").html(data.nric);
                $(".guardian_occupation").html(data.occupation);
                $(".guardian_income").html(data.income);
                $(".guardian_blood_group").html(data.blood_group);
                $(".guardian_education").html(data.education);
                $(".guardian_mobile_no").html(data.mobile_no);
                $(".guardian_state").html(data.state);
                $(".guardian_city").html(data.city);
                $(".guardian_address").html(data.address);
            }
        }, 'json');
    }
    
    $('#updateStudentProfile').on('submit', function (e) {
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
                if (data.code == 200) {
                    toastr.success(data.message);
                } else {
                    toastr.error(data.message);
                }
            }
        });
    });
    
    
    
    $('#updateStudentInfo').on('submit', function (e) {
        e.preventDefault();
        console.log('123')
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
                        window.location.href = indexStudent;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
    });

});
