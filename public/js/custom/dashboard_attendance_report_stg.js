$(function () {
    // if (deptIDs) {
    //     var Selector = '#attendanceFilter';
    //     var department_id = deptIDs;
    //     var classID = classIDS;
    //     classAllocation(department_id, Selector, classID);
    // }
    // if (deptIDs && classIDS) {
    //     $("#attendanceFilter").find("#sectionID").empty();
    //     $("#attendanceFilter").find("#sectionID").append('<option value="">' + select_class + '</option>');
    //     $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: ref_user_id, class_id: classIDS }, function (res) {
    //         if (res.code == 200) {
    //             $.each(res.data, function (key, val) {
    //                 $("#attendanceFilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
    //             });
    //             if (secIDs != '' || secIDs != null) {
    //                 $("#attendanceFilter").find('select[name="section_id"]').val(secIDs);
    //             }
    //         }
    //     }, 'json');
    // }
    // $("#department_id").on('change', function (e) {
    //     e.preventDefault();
    //     var Selector = '#attendanceFilter';
    //     var department_id = $(this).val();
    //     var classID = "";
    //     classAllocation(department_id, Selector, classID);
    // });
    // function classAllocation(department_id, Selector, classID) {
    //     $(Selector).find('select[name="class_id"]').empty();
    //     $(Selector).find('select[name="class_id"]').append('<option value="">' + select_grade + '</option>');
    //     $(Selector).find('select[name="section_id"]').empty();
    //     $(Selector).find('select[name="section_id"]').append('<option value="">' + select_class + '</option>');
    //     if (department_id) {
    //         $.post(getGradeByDepartmentUrl,
    //             {
    //                 branch_id: branchID,
    //                 department_id: department_id,
    //                 teacher_id: ref_user_id
    //             }, function (res) {
    //                 if (res.code == 200) {
    //                     $.each(res.data, function (key, val) {
    //                         $(Selector).find('select[name="class_id"]').append('<option value="' + val.id + '">' + val.name + '</option>');
    //                     });
    //                     if (classID != '' || classID != null) {
    //                         $(Selector).find('select[name="class_id"]').val(classID);
    //                     }
    //                 }
    //             }, 'json');
    //     }
    // }
    // // if (deptIDs || classIDS || secIDs) {
    // //     absentDetails(deptIDs, classIDS, secIDs, patternNames);
    // // }
    // // change classroom
    // $('#changeClassName').on('change', function () {
    //     $(".attendanceReport").hide();
    //     var class_id = $(this).val();
    //     $("#attendanceFilter").find("#sectionID").empty();
    //     $("#attendanceFilter").find("#sectionID").append('<option value="">' + select_class + '</option>');

    //     $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: ref_user_id, class_id: class_id }, function (res) {
    //         if (res.code == 200) {
    //             $.each(res.data, function (key, val) {
    //                 $("#attendanceFilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
    //             });
    //         }
    //     }, 'json');
    // });
    // rules validation
    // $("#attendanceFilter").validate({
    //     rules: {
    //         class_id: "required",
    //         class_id: "required",
    //         section_id: "required",
    //         subject_id: "required",
    //         pattern: "required",
    //         class_date: "required",
    //     }
    // });
    // function absentDetails(deptID, classID, secID, patternN) {

    //     var department_id = deptID;
    //     var class_id = classID;
    //     var section_id = secID;
    //     var pattern = patternN;
    //     var formData = new FormData();
    //     formData.append('branch_id', branchID);
    //     formData.append('department_id', department_id);
    //     formData.append('class_id', class_id);
    //     formData.append('section_id', section_id);
    //     formData.append('staff_id', ref_user_id);
    //     formData.append('pattern', pattern);
    //     formData.append('academic_session_id', academic_session_id);
    //     $.ajax({
    //         url: absent_attendance_reportUrl,
    //         method: "POST",
    //         data: formData,
    //         processData: false,
    //         dataType: 'json',
    //         contentType: false,
    //         success: function (response) {
    //             console.log("response");
    //             console.log(response);
    //             var type = response.data.type;
    //             if (response.code == 200) {
    //                 var absentCount = "";
    //                 if (response.data.absent_details.length > 0) {
    //                     // absentCount = response.data.absent_details['absentCount'];
    //                     absent = response.data.absent_details[0].absentCount;
    //                     if (absent === null || absent === undefined || absent === '') {
    //                         // The value is either null, undefined, or an empty string
    //                         absentCount = '-';

    //                     } else {
    //                         // The value is not null, undefined, or an empty string
    //                         absentCount = absent;
    //                     }
    //                 }
    //                 $('#attendanceInfo').empty();
    //                 var myvar = '<div class="col-12">' +
    //                     '<div class="row">' +
    //                     '<div class="col-4">' +
    //                     '</div>' +
    //                     '<div class="col-4">' +
    //                     '<div class="card">' +
    //                     '<div class="card-body">' +
    //                     '<p style="text-align:center;">' + type + ' Absence</p>' +
    //                     '<div class="widget-rounded-circle">' +
    //                     '<div class="card-widgets">' +
    //                     '</div>' +
    //                     '<div class="row">' +
    //                     '<div class="col-12">' +
    //                     '<div class="">' +
    //                     '<div class="greetingCntRing" style="transform: translate(224%, 0%);">' +
    //                     '<p>' + absentCount + '</p>' +
    //                     '</div>' +
    //                     '</div>' +
    //                     '</div>' +
    //                     '</div>' +
    //                     '</div>' +
    //                     '</div>' +
    //                     '</div>' +
    //                     '</div>' +
    //                     '</div>' +
    //                     '</div>';
    //                 $("#attendanceInfo").append(myvar);

    //             }
    //         }
    //     });
    // }
    $.ajax({
        url: studentTransferListUrl, // Replace with your API endpoint
        method: 'GET',
        dataType: 'json',
        data: {
            branch_id: branchID,
            termination_status_flag: "Approved"
        },
        success: function (response) {
            // dataSetNew
            var dataSetNew = response.data;
            studentTerminationList(dataSetNew);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // console.error('Example 2 Error:', textStatus, errorThrown);
            studentTerminationList([]);
        }
    });
    $.ajax({
        url: studentTransferListUrl, // Replace with your API endpoint
        method: 'GET',
        dataType: 'json',
        data: {
            branch_id: branchID
        },
        success: function (response) {
            // dataSetNew
            var dataSetNew = response.data;
            studentTrasnferList(dataSetNew);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // console.error('Example 2 Error:', textStatus, errorThrown);
            studentTrasnferList([]);
        }
    });
    $.ajax({
        url: studentNewJoiningListUrl, // Replace with your API endpoint
        method: 'post',
        data: {
            branch_id: branchID,
            academic_session_id: academic_session_id
        },
        dataType: 'json',
        success: function (response) {
            //console.log("response");
            // console.log(response);
            // dataSetNew
            var dataSetNew = response.data;
            studentJoiningList(dataSetNew);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // console.error('Example 2 Error:', textStatus, errorThrown);
            studentJoiningList([]);
        }
    });
    function studentTerminationList(dataSetNew) {
        // clear old data in datatable
        $('#student-termination-list').DataTable().clear().destroy();
        $('#student-termination-list td').empty();

        $('#student-termination-list').DataTable({
            processing: true,
            bDestroy: true,
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
                        doc.pageMargins = [50, 50, 50, 50];
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

                        doc['footer'] = (function (page, pages) {
                            return {
                                columns: [
                                    { alignment: 'left', text: [footer_txt], width: 400 },
                                    {
                                        // This is the right column
                                        alignment: 'right',
                                        text: ['page ', { text: page.toString() }, ' of ', { text: pages.toString() }],
                                        width: 100

                                    }
                                ],
                                margin: [50, 0, 0, 0]
                            }
                        });

                    }

                }
            ],
            data: dataSetNew,
            "pageLength": 10,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                { data: 'id', name: 'id' },
                // {
                //     data: 'checkbox',
                //     name: 'checkbox',
                //     orderable: false,
                //     searchable: false
                // },
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
                    data: 'school_fees_payment_status',
                    name: 'school_fees_payment_status'
                }
            ],
            columnDefs: [
                {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 8,
                    "render": function (data, type, row, meta) {
                        // current_old_att_status
                        var status = "";
                        if (row.termination_status == "Approved") {
                            status = "success";
                        } else if (row.termination_status == "Rejected") {
                            status = "danger";
                        } else if (row.termination_status == "Pending") {
                            status = "warning";
                        } else if (row.termination_status == "Send Back") {
                            status = "info";
                        } else {
                            status = "";
                        }
                        var att_status = '<div class="button-list"><span class="badge badge-soft-' + status + ' p-1">' + row.termination_status + '</span></div>';
                        return att_status;

                    }
                },
                {
                    "targets": 10,
                    "render": function (data, type, row, meta) {
                        // current_old_att_status
                        var sstatus = "";
                        if (row.school_fees_payment_status == "Paid") {
                            sstatus = "success";
                        }
                        if (row.school_fees_payment_status == "Unpaid") {
                            sstatus = "danger";
                        }
                        var att_sstatus = '<div class="button-list"><span class="badge badge-soft-' + sstatus + ' p-1">' + row.school_fees_payment_status + '</span></div>';
                        return att_sstatus;

                    }
                }
            ]
        }).on('draw', function () {
        });
    }
    function studentTrasnferList(dataSetNew) {
        // clear old data in datatable
        $('#student-transfer-list').DataTable().clear().destroy();
        $('#student-transfer-list td').empty();

        $('#student-transfer-list').DataTable({
            processing: true,
            bDestroy: true,
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
                        doc.pageMargins = [50, 50, 50, 50];
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

                        doc['footer'] = (function (page, pages) {
                            return {
                                columns: [
                                    { alignment: 'left', text: [footer_txt], width: 400 },
                                    {
                                        // This is the right column
                                        alignment: 'right',
                                        text: ['page ', { text: page.toString() }, ' of ', { text: pages.toString() }],
                                        width: 100

                                    }
                                ],
                                margin: [50, 0, 0, 0]
                            }
                        });

                    }

                }
            ],
            data: dataSetNew,
            "pageLength": 10,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                { data: 'id', name: 'id' },
                // {
                //     data: 'checkbox',
                //     name: 'checkbox',
                //     orderable: false,
                //     searchable: false
                // },
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
                    data: 'school_fees_payment_status',
                    name: 'school_fees_payment_status'
                }
            ],
            columnDefs: [
                {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 8,
                    "render": function (data, type, row, meta) {
                        // current_old_att_status
                        var status = "";
                        if (row.termination_status == "Approved") {
                            status = "success";
                        } else if (row.termination_status == "Rejected") {
                            status = "danger";
                        } else if (row.termination_status == "Pending") {
                            status = "warning";
                        } else if (row.termination_status == "Send Back") {
                            status = "info";
                        } else {
                            status = "";
                        }
                        var att_status = '<div class="button-list"><span class="badge badge-soft-' + status + ' p-1">' + row.termination_status + '</span></div>';
                        return att_status;

                    }
                },
                {
                    "targets": 10,
                    "render": function (data, type, row, meta) {
                        // current_old_att_status
                        var sstatus = "";
                        if (row.school_fees_payment_status == "Paid") {
                            sstatus = "success";
                        }
                        if (row.school_fees_payment_status == "Unpaid") {
                            sstatus = "danger";
                        }
                        var att_sstatus = '<div class="button-list"><span class="badge badge-soft-' + sstatus + ' p-1">' + row.school_fees_payment_status + '</span></div>';
                        return att_sstatus;

                    }
                }
            ]
        }).on('draw', function () {
        });
    }
    function studentJoiningList(dataSetNew) {
        // clear old data in datatable
        $('#student-new-joining-list').DataTable().clear().destroy();
        $('#student-new-joining-list td').empty();

        $('#student-new-joining-list').DataTable({
            processing: true,
            bDestroy: true,
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
                        doc.pageMargins = [50, 50, 50, 50];
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

                        doc['footer'] = (function (page, pages) {
                            return {
                                columns: [
                                    { alignment: 'left', text: [footer_txt], width: 400 },
                                    {
                                        // This is the right column
                                        alignment: 'right',
                                        text: ['page ', { text: page.toString() }, ' of ', { text: pages.toString() }],
                                        width: 100

                                    }
                                ],
                                margin: [50, 0, 0, 0]
                            }
                        });

                    }

                }
            ],
            data: dataSetNew,
            "pageLength": 5,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'student_name',
                    name: 'student_name'
                },
                // {
                //     data: 'dept_name',
                //     name: 'dept_name'
                // },
                {
                    data: 'class_name',
                    name: 'class_name'
                },
                {
                    data: 'section_name',
                    name: 'section_name'
                },
                {
                    data: 'gender',
                    name: 'gender'
                },
                // {
                //     data: 'email',
                //     name: 'email'
                // },
                {
                    data: 'admission_date',
                    name: 'admission_date'
                },
            ],
            columnDefs: [
                {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                }
            ]
        }).on('draw', function () {
        });
    }
    buletinTable();
    function buletinTable() {
        $('#buletin-table').DataTable({
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
                    url: buletinBoardList,
                    success: function(data) {
                        console.log(data.data.length);
                        if (data && data.data.length > 0) {
                            console.log('ok');
                            $('#buletin-table_wrapper .buttons-csv').removeClass('disabled');
                            $('#buletin-table_wrapper .buttons-pdf').removeClass('disabled');  // Enable all buttons if at least one record exists
                        } else {
                            console.log(data);
                            $('#buletin-table_wrapper .buttons-csv').addClass('disabled');
                            $('#buletin-table_wrapper .buttons-pdf').addClass('disabled');               
                        }
                    },
                    error: function() {
                        console.log('error');
                        // Handle error if necessary
                    }
                });
            },
            ajax: buletinBoardList,
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
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'file',
                    name: 'file',
                    render: function(data, type, full, meta) {
                        // Check if data is not null and not empty
                        if (data && data.trim() !== '') {
                            // Assuming 'image_url' contains the base URL for file links
                            var fileLink = image_url + data;
                            return '<a href="' + fileLink + '" target="_blank">' + data + '</a>';
                        } else {
                            // Return empty string if data is null or empty
                            return '<span class="text-muted">no file uploaded</span>';
                        }
                    }
                },{
                    data: 'publish_date',
                    name: 'publish_date',
                    render: function(data, type, row) {
                        if (data && (type === 'display' || type === 'filter')) {
                            // Split the datetime string into date and time parts
                            var parts = data.split(' ');
                            // Display only the date part (assuming it's the first part of the split string)
                            return parts[0];
                        }
                        return data;
                    }
                },
                {
                    data: 'actions',
                    name: 'actions'
                },
            ]
        }).on('draw', function () {
        });
    }
    $(document).on('click', '#viewBuletinBtn', function () {
        var buletin_id = $(this).data('id');
        $('.viewBuletin').find('span.error-text').text('');
        $.post(buletinBoardDetails, { id: buletin_id }, function (data) {
            console.log(data);
            $('.viewBuletin').find('.title').text(data.data.title);
            $('.viewBuletin').find('.file').text(data.data.file);
            $('.viewBuletin').find('.publish_date').text(data.data.publish_date);
            $('.viewBuletin').find('.publish_end_date').text(data.data.publish_end_date);
           
            var targetUserValues = data.data.target_user.split(',');
            if (targetUserValues.includes('5')) {
                var content = data.data.name + "<br>";

                if (data.data.grade_name !== null) {
                    content += "Grade: " + data.data.grade_name + "<br>";
                }

                if (data.data.section_name !== null) {
                    content += "Class: " + data.data.section_name + "<br>";
                }

                if (data.data.parent_name !== null) {
                    content += "Parent: " + data.data.parent_name;
                }
                $('.viewBuletin').find('.target_user').html(content);
              
            } else if (targetUserValues.includes('4')) {
                var content = data.data.name + "<br>";

                if (data.data.department_name !== null) {
                    content += "Department: " + data.data.department_name + "<br>";
                }
                $('.viewBuletin').find('.target_user').html(content);
            }else{
                var content = data.data.name + "<br>";

                if (data.data.grade_name !== null) {
                    content += "Grade: " + data.data.grade_name + "<br>";
                }

                if (data.data.section_name !== null) {
                    content += "Class: " + data.data.section_name + "<br>";
                }

                if (data.data.student_name !== null) {
                    content += "Student: " + data.data.student_name;
                }
                $('.viewBuletin').find('.target_user').html(content);
                
            }
            
            $('.viewBuletin').find('.description').html(data.data.discription);
            $('.viewBuletin').modal('show');
        }, 'json');
    });
  
});
function openFilePopup(data) {
    const modal = document.getElementById("fileModal");
    const modalTitle = modal.querySelector(".modal-title");
    const modalBody = modal.querySelector(".modal-body");
    const fileTitle = modal.querySelector("#fileTitle");
    const fileDescriptionElement = modal.querySelector("#fileDescription");
  //  const created_by = modal.querySelector("#created_by");
    const downloadLink = modal.querySelector("#downloadLink");
    const filePreview = modal.querySelector("#filePreview");
    const previewLink = modal.querySelector("#previewLink");

    modalTitle.innerText = "File Details";
    fileTitle.innerText = data.title;
    //created_by.innerText = data.user_name;
    // Set file description using innerHTML to handle HTML entities
    fileDescriptionElement.innerHTML = data.description;
    if (data.image_url && data.image_url.trim() !== '') {
        // Set the href attribute of the download link to the image URL
        downloadLink.href = data.image_url;
        
        // Set the href attribute of the preview link to the image URL
        previewLink.href = data.image_url;
        
        // Set the src attribute of the iframe for preview to the image URL
        filePreview.src = data.image_url;

        // Show the download link, preview link, and iframe
       downloadLink.style.display = "inline";
       previewLink.style.display = "inline";
       // filePreview.style.display = "block";
    } else {
        // If image_url is null or empty, hide the download link, preview link, and set the iframe source to a placeholder
        downloadLink.style.display = "none";
        previewLink.style.display = "none";
        filePreview.style.display = "none";
    }
    // Set the download link

    // Open the modal
    $(modal).modal("show");
}