$(function () {
    $(document).on('click', '.category', function (e) {
        e.preventDefault();
        var soap_category_id = $(this).data('category');
        var list = $(this).closest('li').find('.sub_category_list');
        var row = '';
        $.post(subCategoryList, { token: token, branch_id: branchID,soap_category_id: soap_category_id }, function (data) {
            // console.log('data',data)
            if (data.data == "") {
                row += ' <div class="col"><a class="dropdown-icon-item" href="#" data-toggle="modal"  data-target="#fh"><span>No Data Available</span></a></div>';
            } else { 
                $.each(data.data, function (index, value) {
                    var img = imageUrl + "/" + value.photo;
                    row += ' <div class="col-3"><a class="dropdown-icon-item sub_category" href="#" data-toggle="modal" data-sub-category="'+value.id+'" data-category="'+soap_category_id+'" data-target="#notes-modal"><img src="'+img+'" alt="slack"><span>'+value.name+'</span></a></div>';
                });
            }
            // console.log('row',row);
            list.append(row);
        }, 'json');
    });

    $(document).on('click', '.sub_category', function (e) {
        e.preventDefault();
        $("#notes-body").empty();
        var soap_category_id = $(this).data('category');
        var soap_sub_category_id = $(this).data('sub-category');

        $("#notes-category-id").val(soap_category_id);
        $("#notes-sub-category-id").val(soap_sub_category_id);
        // var list = $(this).closest('li').find('.sub_category_list');
        var row = '';
        $.post(notesList, { token: token, branch_id: branchID,soap_category_id: soap_category_id, soap_sub_category_id: soap_sub_category_id }, function (data) {
            // console.log('notes',data)
            if (data.data == "") {
                row += ' <tr ><td  class="text-center" colspan="2">No Data Available</td></tr>';
            } else { 
                $.each(data.data, function (index, value) {
                    index++;
                    row += '<tr class="notes_data"><input type="hidden"  class="soap_notes_id" value="' + value.id + '"><td>'+index+'</td><td class="notes">'+value.notes+'</td></tr>';
                });
            }
            $("#notes-body").append(row);
        }, 'json');
    });

    $(document).on('click', '.notes_data', function (e) {
        e.preventDefault();
        // $("#notes-body").empty();
        var soap_category_id = $('#notes-category-id').val();
        var soap_sub_category_id = $("#notes-sub-category-id").val(); 
        var data = $(this).closest('tr').find('.notes').text();
        var soap_notes_id = $(this).closest('tr').find('.soap_notes_id').val();
        
        var tab = $(".tab-content").find(".active").data('tab');

        var count = $('#'+tab+'-category-'+soap_category_id+' tr:last').find('.count').text();
        if(!count) {
            count = 0;
        }
        count++;
        var row = '<tr><td class="count">'+count+'</td><input type="hidden"  name="notes[' + count + '][soap_category_id]" value="' + soap_category_id + '"><input type="hidden"  name="notes[' + count + '][soap_sub_category_id]" value="' + soap_sub_category_id + '"><input type="hidden"  name="notes[' + count + '][soap_notes_id]" value="' + soap_notes_id + '"><td>'+data+'</td><td>Doctor</td><td> <a href="javascript:void(0);" class="action-icon remove_notes" data-toggle="modal"><i class="mdi mdi-delete"></i></a></td></tr>';
        $("#"+tab+"-category-"+soap_category_id).append(row);
    });

    

    // $(document).on('click', '.remove_notes', function () {
    //     $(this).parent().parent().remove();
    // });

    
    
    // delete Notes Delete
    $(document).on('click', '.remove_notes', function () {
        var curr = $(this);
        var soap_id = $(this).closest('tr').find('.soap_id').val();
        
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Record',
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
                if (soap_id) {
                
                    $.post(soapDelete, {
                        id: soap_id,
                        token: token, 
                        branch_id: branchID,
                    }, function (data) {
                        if (data.code == 200) {
                            toastr.success(data.message);
                        } else {
                            toastr.error(data.message);
                        }
                    }, 'json');
                }
                curr.parent().parent().remove();

            }
        });
    });
    // $('#delete-notes').on('show.bs.modal', e => {
    //     var soap_category_id = $(this).data('category');
    // });

    
    $('.addSoapForm').on('submit', function (e) {
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
                // console.log("------")
                console.log(data)
                if (data.code == 200) {
                    // $('#soap-notes-table').DataTable().ajax.reload(null, false);
                    // $('.addSoapNotes').modal('hide');
                    // $('.addSoapNotes').find('form')[0].reset();
                    toastr.success(data.message);
                } else {
                    toastr.error(data.message);
                }
            }
        });
    });

    
    var count = 0;
});