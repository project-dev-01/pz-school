$(function () {
    $(document).on('click', '.student-row', function (e) {
        e.preventDefault();
        console.log('12hg',name)
        console.log('th',this)
        // return false;
        var name = $(this).closest('tr').find('.stu-name').text();
        var class_name = $(this).closest('tr').find('.stu-class').text();
        var section = $(this).closest('tr').find('.stu-section').text();
        var student = $(this).closest('tr').find('.student').val();
        $('.student_name').text(name);
        $('.student_class').text(class_name);
        $('.student_section').text(section);
        $('#student_id').val(student);
        $('.student_id').val(student);
    });
    $('#sstt').on('show.bs.modal', function (event) {
        $('#modal-body').empty();
        var id = $(event.relatedTarget).data('id');
        $.ajax({
            url: soapSubjectDetails,
            method: "POST",
            data: { token: token, branch_id: branchID,id: id  },
            success: function (data) {
                console.log('data',data)
                
                $('#modal-body').append(data.data.body);
            }
        });
      });
    $("#class_id").on('change', function (e) {
        e.preventDefault();
        var class_id = $(this).val();
        $("#section_id").empty();
        $("#section_id").append('<option value="">Select Class</option>');
        $.post(sectionByClass, { class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });

    $("#tabs ul li a").click(function(e){
        var tab = $(this).data('tab');
        var soap_type_id = $(this).data('soap-type-id');
        var student = $("#student_id").val();
        console.log('stu',student)
        if ( tab == "info" ) {
            $.post(studentDetails, { token: token, branch_id: branchID,id: student }, function (data) {
                    var stu = data.data.student;
                    $('#fname').val(stu.first_name);
                    $('#lname').val(stu.last_name);
                    $('#gender').val(stu.gender);
                    $('#blooddgrp').val(stu.blood_group);
                    $('#dob').val(stu.birthday);
                    $('#passport').val(stu.passport);
                    $('#txt_nric').val(stu.nric);
                    $('#religion').val(stu.religion);
                    $('#race').val(stu.race);
                    $('#txt_mobile_no').val(stu.mobile_no);
                    $('#drp_country').val(stu.country);
                    $('#drp_state').val(stu.state);
                    $('#drp_city').val(stu.city);
                    $('#drp_post_code').val(stu.post_code);
                    $('#txtarea_address').val(stu.gender);
                    $('#txtarea_permanent_address').val(stu.permanent_address);
                    $('#btwyears').val(stu.year);
                    $('#txt_regiter_no').val(stu.register_no);
                    $('#txt_roll_no').val(stu.roll_no);
                    $('#admission_date').val(stu.admission_date);
                    $('#std_class_id').val(stu.class_id);
                    $('#std_section_id').val(stu.section_id);
                    $('#categy').val(stu.categy);
                    $('#std_session_id').val(stu.session_id);
                    $('#std_semester_id').val(stu.semester_id);
                    $('#father_name').val(stu.father_name);
                    $('#mother_name').val(stu.mother_name);
                    $('#guardian_name').val(stu.guardian_name);
                    $('#relation').val(stu.relation);

                    $.post(sectionByClassUrl, { token: token, branch_id: branchID, class_id: stu.class_id }, function (res) {
                        if (res.code == 200) {
                            $.each(res.data, function (key, val) {
                                $("#std_section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                            });
                            if (stu.section_id) {
                                $('select[name="std_section_id"]').val(stu.section_id);
                            }
                        }
                    }, 'json');
            }, 'json');
        } else {
            
            $("."+tab+"-category-table").empty();
            $("#"+tab+"-subject-table").empty();
            $.ajax({
                url: studentSoapList,
                method: "GET",
                data: { token: token, branch_id: branchID, student_id: student },
                success: function (data) {
                    if (data.data.soap) {
                        $.each(data.data.soap, function (index, value) {
                            var output = "";
                            var table = tab+'-category-'+value.soap_category_id;
                            var count = $('#'+tab+'-category-'+value.soap_category_id+' tr:last').find('.count').text();
                            if(!count) {
                                count = 0;
                            }
                            count++;
                            output +=  '<tr>';
                            output +=  '<td class="count">'+count+'</td>';
                            output +=  '<input type="hidden" class="soap_id" name="notes['+value.soap_category_id+']['+count+'][soap_id]" value="'+value.id+'">';
                            output +=  '<td>'+value.soap_notes+'</td>';
                            output +=  '<td>'+value.referred_by+'</td>';
                            output +=  '<td>'+value.date+'</td>';
                            output +=  '<td> <a href="javascript:void(0);" class="action-icon remove_notes" data-toggle="modal"><i class="mdi mdi-delete"></i></a></td>';
                            output +=  '</tr>';
                            $("#"+table).append(output);
                        });
                    }
                    if (data.data.subject) {
                        $.each(data.data.subject, function (index, value) {
                            if(value.soap_type_id==soap_type_id) {
                                var result = "";
                                var table_name = tab+'-subject-table';
                                var ind = $('#'+table_name+' tr:last').find('.count').text();
                                if(!ind) {
                                    ind = 0;
                                }
                                ind++;
                                result +=  '<tr>';
                                result +=  '<td class="count">'+ind+'</td>';
                                result +=  '<td><button type="button" class="btn btn-blue waves-effect subject_modal" data-toggle="modal" data-id="'+value.id+'" data-target="#sstt">'+value.title+'</button></td>';
                                result +=  '<td>'+value.referred_by+'</td>';
                                result +=  '<td>'+value.date+'</td>';
                                result +=  '<td><a href="'+url+'/admin/soap_subject/edit/'+value.id+'" class="action-icon"><i class="mdi mdi-square-edit-outline"></i></a>';
                                result +=  '<a href="javascript:void(0);" class="action-icon deleteSoapSubjectBtn"  data-id="'+value.id+'" ><i class="mdi mdi-delete"></i></a>';
                                result +=  '</td>';
                                result +=  '</tr>';
                                $("#"+table_name).append(result);
                            }
                        });
                    }
                }
            });

        }
        // stop reload
        e.preventDefault();
    })

    $('#studentFilter').on('submit', function (e) {
        e.preventDefault();
        $("#student_body").empty();
        var form = this;
        var session_id = $("#session_id").val();
        var section_id = $("#section_id").val();
        var class_id = $("#class_id").val();
        // console.log('1',section_id)
        
        // var formData = new FormData();
        // formData.append('session_id', session_id);
        // formData.append('class_id', class_id);
        // formData.append('section_id', section_id);
        $.ajax({
            url: soapStudentList,
            method: "GET",
            data: { token: token, branch_id: branchID, session_id: session_id, section_id: section_id, class_id: class_id, academic_session_id: academic_session_id },
            success: function (data) {
                var output = "";
                if (data.data.length>0) {
                    $.each(data.data, function (index, value) {
                        index++;
                        output +=  '<tr class="student-row">';
                        output += '<td>'+index+'</td>';
                        output += '<td style="width: 36px;">';
                        // output += '<img src="'+data.photo+' && asset('public/users/images/''+data.photo+') ? asset('public/users/images/'.$student['photo']) : asset('public/images/users/default.jpg') }}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />';
                        output += '</td>';
                        output += '<td class="stu-name">';
                        output += '    <h5 class="m-0 font-weight-normal">'+value.name+'</h5>';
                        output += '</td>';
                        output += '<input type="hidden" class="student" value="'+value.id+'"></input>';
                        output += '<td style="display:none;" class="stu-class">'+value.class_name+'</td>';
                        output += '<td style="display:none;" class="stu-section">'+value.section_name+'</td>';
                        output += '<td >';
                        output += value.email;
                        output += '</td>';
                        output += '</tr>';
                    });
                } else {
                    output += '<tr><td>No Data Available</td></tr>';
                }
                
                $("#student_body").append(output);
            }
        });
    });

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
        console.log('rt',this)
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
        
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' + dd;

        var row = '<tr><td class="count">'+count+'</td><input type="hidden"  name="notes['+soap_category_id+'][' + count + '][soap_category_id]" value="' + soap_category_id + '"><input type="hidden"  name="notes['+soap_category_id+'][' + count + '][soap_sub_category_id]" value="' + soap_sub_category_id + '"><input type="hidden"  name="notes['+soap_category_id+'][' + count + '][soap_notes_id]" value="' + soap_notes_id + '"><td>'+data+'</td><td>'+user_name+'</td><td>'+today+'</td><td> <a href="javascript:void(0);" class="action-icon remove_notes" data-toggle="modal"><i class="mdi mdi-delete"></i></a></td></tr>';
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