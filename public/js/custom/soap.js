$(function () {

    // set student id session
    $.ajax({
        url: soapStudentIDUrl,
        method: "POST",
        data: { token: token, branch_id: branchID, soap_student_id: null },
        success: function (data) {
            // console.log('data', data)
        }
    });

    $(document).on('click', '.student-row', function (e) {
        e.preventDefault();
        // return false;
        
        $(".student-row").css('background', 'white');
        if (this.style.background == "" || this.style.background == "white") {
            $(this).css('background', '#0ABAB5');
        }
        var name = $(this).closest('tr').find('.stu-name').text();
        var class_name = $(this).closest('tr').find('.stu-class').text();
        var section = $(this).closest('tr').find('.stu-section').text();
        var student = $(this).closest('tr').find('.student').val();
        $('.student_name').text(name);
        $('.student_class').text(class_name);
        $('.student_section').text(section);
        $('#student_id').val(student);
        $('.student_id').val(student);
        // set student id session
        $.ajax({
            url: soapStudentIDUrl,
            method: "POST",
            data: { token: token, branch_id: branchID, soap_student_id: student },
            success: function (data) {
                // console.log('data', data)
            }
        });
    });
    $('#sstt').on('show.bs.modal', function (event) {
        $('#modal-body').empty();
        var id = $(event.relatedTarget).data('id');
        $.ajax({
            url: soapSubjectDetails,
            method: "POST",
            data: { token: token, branch_id: branchID, id: id },
            success: function (data) {
                console.log('data', data)

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
    $("#old_class_id").on('change', function (e) {
        e.preventDefault();
        var class_id = $(this).val();
        $("#old_section_id").empty();
        $("#old_section_id").append('<option value="">Select Class</option>');
        $.post(sectionByClass, { class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#old_section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });

    $("#tabs ul li a").click(function (e) {
        e.preventDefault();
        var tab = $(this).data('tab');
        var soap_type_id = $(this).data('soap-type-id');
        var student = $("#student_id").val();
        if (student) {
            if (tab == "info") {
                $.post(studentDetails, { token: token, branch_id: branchID, id: student }, function (data) {
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
            } else if (tab == "log") {
                // soapLogTable();
                console.log("dsfhdshfh");
                $('#log-table').DataTable({
                    processing: true,
                    info: true,
                    bDestroy: true,
                    // dom: 'lBfrtip',
                    dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-6'i><'col-sm-6'p>>",
                    buttons: [],
                    // serverSide: true,
                    // ajax: {
                    //     url: soapLogList,
                    //     // data: function (d) {
                    //     //     console.log("sds")
                    //     //     console.log(d.student_id);
                    //     //     d.student_id = $('#student_id').val()
                    //     // }
                    //     type: "post",
                    //     data:{
                    //         student_id : $('#student_id').val()
                    //     },
                    // },
                    "ajax": {
                        url: soapLogList,
                        cache: false,
                        dataType: "json",
                        data: {
                            student_id: $('#student_id').val()
                        },
                        type: "get",
                        // contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        // processData: true, // NEEDED, DON'T OMIT THIS
                        // headers: {
                        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        // },
                        "dataSrc": function (json) {
                            console.log("topPerformance json");
                            console.log(json);
                            // $("#mydata").val(json.recordsTotal);
                            return json.data;
                        },
                        error: function (error) {
                            console.log("error")
                            console.log(error)
                        }
                    },
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
                        },
                        {
                            data: 'soap_text',
                            name: 'soap_text'
                        },
                        {
                            data: 'soap_type',
                            name: 'soap_type'
                        },
                        {
                            data: 'referred_by',
                            name: 'referred_by'
                        },
                        {
                            data: 'type',
                            name: 'type'
                        },
                        {
                            data: 'date',
                            name: 'date'
                        },
                    ],
                });
                // $.ajax({
                //     url: soapLogList,
                //     method: "GET",
                //     data: {  student_id: student },
                //     success: function (data) {
                //         console.log('stu',data.data)
                //         var output = "";
                //         if (data.data.length>0) {
                //             $.each(data.data, function (index, value) {
                //                 index++;
                //                 output +=  '<tr>';
                //                 output +=  '<td >'+index+'</td>';
                //                 output +=  '<td>'+value.soap_text+'</td>';
                //                 soap_type = "";
                //                 if(value.soap_type==1){
                //                     soap_type = "Subjective";
                //                 }else if(value.soap_type==2){
                //                     soap_type = "Objective";
                //                 }else if(value.soap_type==3){
                //                     soap_type = "Assessment";
                //                 }else if(value.soap_type==4){
                //                     soap_type = "Plan";
                //                 }
                //                 output +=  '<td>'+soap_type+'</td>';
                //                 output +=  '<td>'+value.referred_by+'</td>';
                //                 output +=  '<td>'+value.type+'</td>';
                //                 output +=  '<td>'+value.date+'</td>';
                //                 output +=  '</tr>';
                //             });
                //         }else{
                //             output += '<tr><td colspan="6" class="text-center">No Data Available</td></tr>';
                //         }
                //         console.log('out',output)
                //         $("#log-body").append(output);
                //     }
                // });
            } else {

                console.log('123')
                $("." + tab + "-category-table").empty();
                $("#" + tab + "-subject-table").empty();
                $.ajax({
                    url: studentSoapList,
                    method: "GET",
                    data: { token: token, branch_id: branchID, student_id: student },
                    success: function (data) {
                        $("." + tab + "-category-table").append('<tr ><td colspan="5" class="text-center">No Data Available</td></tr>'); 
                        if (data.data.soap.length > 0) {
                            $.each(data.data.soap, function (index, value) {
                                var output = "";
                                var table = tab + '-category-' + value.soap_category_id;
                                $("#" + table).empty();
                                var count = $('#' + tab + '-category-' + value.soap_category_id + ' tr:last').find('.count').text();
                                if (!count) {
                                    count = 0;
                                }
                                count++;
                                output += '<tr>';
                                output += '<td class="count">' + count + '</td>';
                                output += '<input type="hidden" class="soap_id" name="notes[' + value.soap_category_id + '][' + count + '][soap_id]" value="' + value.id + '">';
                                output += '<td>' + value.soap_notes + '</td>';
                                output += '<td>' + value.referred_by + '</td>';
                                output += '<td>' + value.date + '</td>';
                                output += '<td> <a href="javascript:void(0);" class="action-icon remove_notes" data-toggle="modal"><i class="mdi mdi-delete"></i></a></td>';
                                output += '</tr>';
                                $("#" + table).append(output);
                            });
                        }
                        if (data.data.subject.length > 0) {
                            $.each(data.data.subject, function (index, value) {
                                if (value.soap_type_id == soap_type_id) {
                                    var result = "";
                                    var table_name = tab + '-subject-table';
                                    var ind = $('#' + table_name + ' tr:last').find('.count').text();
                                    if (!ind) {
                                        ind = 0;
                                    }
                                    ind++;
                                    result += '<tr>';
                                    result += '<td class="count">' + ind + '</td>';
                                    result += '<td><button type="button" class="btn btn-blue waves-effect subject_modal" data-toggle="modal" data-id="' + value.id + '" data-target="#sstt">' + value.title + '</button></td>';
                                    result += '<td>' + value.referred_by + '</td>';
                                    result += '<td>' + value.date + '</td>';
                                    result += '<td><a href="' + url + '/admin/soap_subject/edit/' + value.id + '" class="action-icon"><i class="mdi mdi-square-edit-outline"></i></a>';
                                    result += '<a href="javascript:void(0);" class="action-icon deleteSoapSubjectBtn"  data-id="' + value.id + '" ><i class="mdi mdi-delete"></i></a>';
                                    result += '</td>';
                                    result += '</tr>';
                                    $("#" + table_name).append(result);
                                }
                            });
                        } else {
                            $("#" + tab + "-subject-table").append('<tr ><td colspan="5" class="text-center">No Data Available</td></tr>'); 
                        }
                    }
                });

            }
        } else {
            toastr.error("Please Select Student");
        }
    })
    $('#oldStudentFilter').on('submit', function (e) {
        e.preventDefault();
        $("#old_student_body").empty();
        var form = this;
        var session_id = $("#old_session_id").val();
        var section_id = $("#old_section_id").val();
        var class_id = $("#old_class_id").val();

        $.ajax({
            url: soapOldStudentList,
            method: "GET",
            data: { token: token, branch_id: branchID, session_id: session_id, section_id: section_id, class_id: class_id, academic_session_id: academic_session_id },
            success: function (data) {
                var output = "";
                if (data.data.length > 0) {
                    $.each(data.data, function (index, value) {
                        index++;
                        output += '<tr class="student-row">';
                        output += '<td>' + index + '</td>';
                        output += '<td style="width: 36px;">';

                        if (data.photo) {
                            var src = userImageUrl + "/" + data.photo;
                        } else {
                            var src = defaultImg;
                        }
                        // output += '<img src="'+data.photo+' && asset('public/users/images/''+data.photo+') ? asset('public/users/images/'.$student['photo']) : asset('public/images/users/default.jpg') }}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />';
                        output += '<img src="' + src + '" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />'; output += '</td>';
                        output += '<td class="stu-name">';
                        output += '    <h5 class="m-0 font-weight-normal">' + value.name + '</h5>';
                        output += '</td>';
                        output += '<input type="hidden" class="student" value="' + value.id + '"></input>';
                        output += '<td >';
                        output += value.email;
                        output += '</td>';
                        output += '<td class="stu-class">' + value.class_name + '</td>';
                        output += '<td class="stu-section">' + value.section_name + '</td>';
                        output += '</tr>';
                    });
                } else {
                    output += '<tr><td>No Data Available</td></tr>';
                }

                $("#old_student_body").append(output);
            }
        });
    });

    $('#newStudentFilter').on('submit', function (e) {
        e.preventDefault();
        $("#new_student_body").empty();
        var form = this;
        var session_id = $("#session_id").val();
        var section_id = $("#section_id").val();
        var class_id = $("#class_id").val();

        $.ajax({
            url: soapNewStudentList,
            method: "GET",
            data: { token: token, branch_id: branchID, session_id: session_id, section_id: section_id, class_id: class_id, academic_session_id: academic_session_id },
            success: function (data) {
                var output = "";
                if (data.data.length > 0) {
                    $.each(data.data, function (index, value) {
                        index++;
                        output += '<tr class="student-row">';
                        output += '<td>' + index + '</td>';
                        output += '<td style="width: 36px;">';

                        if (data.photo) {
                            var src = userImageUrl + "/" + data.photo;
                        } else {
                            var src = defaultImg;
                        }
                        // output += '<img src="'+data.photo+' && asset('public/users/images/''+data.photo+') ? asset('public/users/images/'.$student['photo']) : asset('public/images/users/default.jpg') }}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />';
                        output += '<img src="' + src + '" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />';
                        output += '</td>';
                        output += '<td class="stu-name">';
                        output += '    <h5 class="m-0 font-weight-normal">' + value.name + '</h5>';
                        output += '</td>';
                        output += '<input type="hidden" class="student" value="' + value.id + '"></input>';
                        output += '<td >';
                        output += value.email;
                        output += '</td>';
                        output += '<td class="stu-class">' + value.class_name + '</td>';
                        output += '<td class="stu-section">' + value.section_name + '</td>';
                        output += '</tr>';
                    });
                } else {
                    output += '<tr><td>No Data Available</td></tr>';
                }

                $("#new_student_body").append(output);
            }
        });
    });

    $(document).on('click', '.category', function (e) {
        e.preventDefault();
        var soap_category_id = $(this).data('category');
        var list = $(this).closest('li').find('.sub_category_list');
        var row = '';
        $.post(subCategoryList, { token: token, branch_id: branchID, soap_category_id: soap_category_id }, function (data) {
            // console.log('data',data)
            if (data.data == "") {
                row += ' <div class="col"><a class="dropdown-icon-item" href="#" data-toggle="modal"  data-target="#fh"><span>No Data Available</span></a></div>';
            } else {
                $.each(data.data, function (index, value) {
                    if (value.photo) {
                        var img = imageUrl + "/" + value.photo;
                    } else {
                        var img = defaultImg;
                    }

                    row += ' <div class="col-3"><a class="dropdown-icon-item sub_category" href="#" data-toggle="modal" data-sub-category="' + value.id + '" data-category="' + soap_category_id + '" data-target="#notes-modal"><img src="' + img + '" alt="slack"><span>' + value.name + '</span></a></div>';
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
        $.post(notesList, { token: token, branch_id: branchID, soap_category_id: soap_category_id, soap_sub_category_id: soap_sub_category_id }, function (data) {
            // console.log('notes',data)
            if (data.data == "") {
                row += ' <tr ><td  class="text-center" colspan="2">No Data Available</td></tr>';
            } else {
                $.each(data.data, function (index, value) {
                    index++;
                    row += '<tr class="notes_data"><input type="hidden"  class="soap_notes_id" value="' + value.id + '"><td>' + index + '</td><td class="notes">' + value.notes + '</td></tr>';
                });
            }
            $("#notes-body").append(row);
        }, 'json');
    });

    $(document).on('click', '.notes_data', function (e) {
        e.preventDefault();
        var soap_category_id = $('#notes-category-id').val();
        var soap_sub_category_id = $("#notes-sub-category-id").val();
        var data = $(this).closest('tr').find('.notes').text();
        var soap_notes_id = $(this).closest('tr').find('.soap_notes_id').val();

        var tab = $(".tab-content").find(".active").data('tab');

        var count = $('#' + tab + '-category-' + soap_category_id + ' tr:last').find('.count').text();
        
        if (!count) {
            $("#" + tab + "-category-" + soap_category_id).empty();
            count = 0;
        }
        count++;

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' + dd;

        var row = '<tr><td class="count">' + count + '</td><input type="hidden"  name="notes[' + soap_category_id + '][' + count + '][soap_category_id]" value="' + soap_category_id + '"><input type="hidden"  name="notes[' + soap_category_id + '][' + count + '][soap_sub_category_id]" value="' + soap_sub_category_id + '"><input type="hidden"  name="notes[' + soap_category_id + '][' + count + '][soap_notes_id]" value="' + soap_notes_id + '"><td>' + data + '</td><td>' + user_name + '</td><td>' + today + '</td><td> <a href="javascript:void(0);" class="action-icon remove_notes" data-toggle="modal"><i class="mdi mdi-delete"></i></a></td></tr>';
        $("#" + tab + "-category-" + soap_category_id).append(row);
    });



    // $(document).on('click', '.remove_notes', function () {
    //     $(this).parent().parent().remove();
    // });



    // delete Notes Delete
    $(document).on('click', '.remove_notes', function () {
        var curr = $(this);
        var student = $("#student_id").val();
        var soap_id = $(this).closest('tr').find('.soap_id').val();
        var soap_type_id = $(this).closest('tbody').data('type');
        console.log('ss', soap_id)
        // return false;
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
                        student_id: student,
                        soap_type_id: soap_type_id,
                        referred_by: user_id,
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