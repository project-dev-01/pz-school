$(function () {
    var formData = {
        academic_year: $('#academic_year').val(),
        academic_grade: $('#academic_grade').val(),
    }; 
    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#applicationFilter';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    function classAllocation(department_id, Selector, classID) {
        $(Selector).find('select[name="academic_grade"]').empty();
        $(Selector).find('select[name="academic_grade"]').append('<option value="">' + select_grade + '</option>');
        if (department_id) {
            $.post(getGradeByDepartmentUrl,
                {
                    branch_id: branchID,
                    department_id: department_id
                }, function (res) {
                    if (res.code == 200) {
                        $.each(res.data, function (key, val) {
                            $(Selector).find('select[name="academic_grade"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                        if (classID != '') {
                            $(Selector).find('select[name="academic_grade"]').val(classID);
                        }
                    }
                }, 'json');
        }
    }

    application(formData);
    function application(formData) {
        $('#application-table').DataTable({
            processing: true,
            serverSide: true,
            info: true,
            bDestroy: true,
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            language: {
                emptyTable: no_data_available,
                infoFiltered: filter_from_total_entries,
                zeroRecords: no_matching_records_found,
                infoEmpty: showing_zero_entries,
                info: showing_entries,
                lengthMenu: show_entries,
                search: datatable_search,
                paginate: {
                    next: next,
                    previous: previous
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
                        doc.pageMargins = [50, 50, 50, 50];
                        doc.defaultStyle.fontSize = 10;
                        doc.styles.tableHeader.fontSize = 12;
                        doc.styles.title.fontSize = 14;
                        doc.content[0].text = doc.content[0].text.trim();
                        doc.footer = function (page, pages) {
                            return {
                                columns: [
                                    { alignment: 'left', text: [footer_txt], width: 400 },
                                    { alignment: 'right', text: ['page ', { text: page.toString() }, ' of ', { text: pages.toString() }], width: 100 }
                                ],
                                margin: [50, 0, 0, 0]
                            };
                        };
                    }
                }
            ],
            ajax: {
                url: applicationList,
                data: function (d) {
                    d.academic_year = $('#academic_year').val(),
                    d.academic_grade = $('#academic_grade').val()
                }
            },
            pageLength: 10,
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'register_number', name: 'register_number' },
                { data: 'name', name: 'name' },
                { data: 'name_english', name: 'name_english' },
                { data: 'name_common', name: 'name_common' },
                { data: 'type', name: 'type' },
                { data: 'gender', name: 'gender' },
                { data: 'email', name: 'email' },
                { data: 'academic_year', name: 'academic_year' },
                { data: 'academic_grade', name: 'academic_grade' },
                { data: 'status', name: 'status' },
                { data: 'phase_2_status', name: 'phase_2_status' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false },
            ]
        });
        
    }

    
    // delete Application 
    $(document).on('click', '#deleteApplicationBtn', function () {
        var id = $(this).data('id');
        var url = applicationDelete;
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
                $.post(url, {
                    id: id
                }, function (data) {
                    if (data.code == 200) {
                        $('#application-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    
    // get application list
    $('#applicationFilter').on('submit', function (e) {
        e.preventDefault();
        var formData = {
            academic_year: $('#academic_year').val(),
            academic_grade: $('#academic_grade').val(),
        };
        // setLocalStorageForApplicationList(formData);
        application(formData);
    });

    // Publish Event 
    $(document).on('click', '#approveApplicationBtn', function () {
        var id = $(this).data('id');
        var value = $(this).prop('checked') ? 1 : 0;
        var text = $(this).prop('checked') ? approveApplication : unapproveApplication;
        var confirmText = $(this).prop('checked') ? approveconfirmButtonText : unapproveconfirmButtonText;
        swal.fire({
            title: deleteTitle + '?',
            html: text,
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonText: deletecancelButtonText,
            confirmButtonText: confirmText,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#556ee6',
            width: 400,
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                $.post(applicationApprove, { id: id, status: value }, function (data) {
                    if (data.code == 200) {
                        $('#application-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    $(document).on('click', '#viewApplicationBtn', function () {
        var id = $(this).data('id');
        $('.viewApplication').find('span.error-text').text('');
        $.post(applicationDetails, { id: id,token: token,branch_id: branchID }, function (data) {
            console.log('cc', data)
            var name = data.data.first_name + " " + data.data.last_name;
            $('.viewApplication').find('.name').text(name);
            $('.viewApplication').find('.gender').text(data.data.gender);
            $('.viewApplication').find('.academic_year').text(data.data.academic_year);
            $('.viewApplication').find('.academic_grade').text(data.data.academic_grade);
            $('.viewApplication').find('.date_of_birth').text(data.data.date_of_birth);
            $('.viewApplication').find('.mobile_no').text(data.data.mobile_no);
            $('.viewApplication').find('.email').text(data.data.email);
            $('.viewApplication').find('.address_1').text(data.data.address_1);
            $('.viewApplication').find('.address_2').text(data.data.address_2);
            $('.viewApplication').find('.country').text(data.data.country);
            $('.viewApplication').find('.state').text(data.data.state);
            $('.viewApplication').find('.city').text(data.data.city);
            $('.viewApplication').find('.postal_code').text(data.data.postal_code);

            $('.viewApplication').find('.school_year').text(data.data.school_year);
            $('.viewApplication').find('.grade').text(data.data.grade);
            $('.viewApplication').find('.school_last_attended').text(data.data.school_last_attended);
            $('.viewApplication').find('.school_address_1').text(data.data.school_address_1);
            $('.viewApplication').find('.school_address_2').text(data.data.school_address_2);
            $('.viewApplication').find('.school_country').text(data.data.school_country);
            $('.viewApplication').find('.school_city').text(data.data.school_city);
            $('.viewApplication').find('.school_state').text(data.data.school_state);
            $('.viewApplication').find('.school_postal_code').text(data.data.school_postal_code);
            
            var mother_name = data.data.mother_first_name + " " + data.data.mother_last_name;
            $('.viewApplication').find('.mother_name').text(mother_name);
            $('.viewApplication').find('.mother_email').text(data.data.mother_email);
            $('.viewApplication').find('.mother_occupation').text(data.data.mother_occupation);
            $('.viewApplication').find('.mother_phone_number').text(data.data.mother_phone_number);
            
            var father_name = data.data.father_first_name + " " + data.data.father_last_name;
            $('.viewApplication').find('.father_name').text(father_name);
            $('.viewApplication').find('.father_email').text(data.data.father_email);
            $('.viewApplication').find('.father_occupation').text(data.data.father_occupation);
            $('.viewApplication').find('.father_phone_number').text(data.data.father_phone_number);
            
            var guardian_name = data.data.guardian_first_name + " " + data.data.guardian_last_name;
            $('.viewApplication').find('.guardian_name').text(guardian_name);
            $('.viewApplication').find('.guardian_relation').text(data.data.guardian_relation);
            $('.viewApplication').find('.guardian_email').text(data.data.guardian_email);
            $('.viewApplication').find('.guardian_occupation').text(data.data.guardian_occupation);
            $('.viewApplication').find('.guardian_phone_number').text(data.data.guardian_phone_number);
            $('.viewApplication').modal('show');
        }, 'json');
    });

  
        

    // function setLocalStorageForApplicationList(classObj) {

    //     var applicationListDetails = new Object();
    //     applicationListDetails.academic_year = classObj.academic_year;
    //     applicationListDetails.academic_grade = classObj.academic_grade;
    //     // here to attached to avoid localStorage other users to add
    //     applicationListDetails.branch_id = branchID;
    //     applicationListDetails.role_id = get_roll_id;
    //     applicationListDetails.user_id = ref_user_id;
    //     var applicationListArr = [];
    //     applicationListArr.push(applicationListDetails);
    //     if (get_roll_id == "2") {
    //         // admin
    //         localStorage.removeItem("admin_application_list_details");
    //         localStorage.setItem('admin_application_list_details', JSON.stringify(applicationListArr));
    //     }
    //     return true;
    // }
    // // if localStorage
    // if (typeof admin_application_list_storage !== 'undefined') {
    //     if ((admin_application_list_storage)) {
    //         if (admin_application_list_storage) {
    //             var adminApplicationListStorage = JSON.parse(admin_application_list_storage);
    //             if (adminApplicationListStorage.length == 1) {
    //                 var academicYear, academicGrade, userBranchID, userRoleID, userID;
    //                 adminApplicationListStorage.forEach(function (user) {
    //                     academicYear = user.academic_year;
    //                     academicGrade = user.academic_grade;
    //                     userBranchID = user.branch_id;
    //                     userRoleID = user.role_id;
    //                     userID = user.user_id;
    //                 });
    //                 if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                        
    //                     $("#academic_year").val(academicYear);
    //                     $('#academic_grade').val(academicGrade);
    //                     var formData = {
    //                         academic_year: academicYear,
    //                         academic_grade: academicGrade,
    //                     };
    //                     application(formData);
    //                 }
    //             }
    //         }
    //     }
    // }
});