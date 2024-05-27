var reasonChart;
$(function () {
    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        $("#bysubjectfilter").find("#examnames").empty();
        $("#bysubjectfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');

        $("#bysubjectfilter").find("#sectionID").empty();

        $("#bysubjectfilter").find("#sectionID").append('<option value="">'+select_class+'</option>');


        $.post(sectionByClass, { token: token, branch_id: branchID, class_id: class_id, teacher_id: teacher_id }, function (res) {
            if (res.code == 200) {
                $("#section_drp_div").show();
                $.each(res.data, function (key, val) {
                    $("#bysubjectfilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');

    });
    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#bysubjectfilter';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    function classAllocation(department_id, Selector, classID) {
        $(Selector).find('select[name="class_id"]').empty();
        $(Selector).find('select[name="class_id"]').append('<option value="">' + select_grade + '</option>');
        if (department_id) {
            $.post(getGradeByDepartmentUrl,
                {
                    branch_id: branchID,
                    department_id: department_id
                }, function (res) {
                    if (res.code == 200) {
                        $.each(res.data, function (key, val) {
                            $(Selector).find('select[name="class_id"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                        if (classID != '') {
                            $(Selector).find('select[name="class_id"]').val(classID);
                        }
                    }
                }, 'json');
        }
    }
    // change section
    $('#sectionID').on('change', function () {
        var section_id = $(this).val();
        var class_id = $("#changeClassName").val();
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '/' + mm + '/' + dd;
        $("#bysubjectfilter").find("#examnames").empty();
        $("#bysubjectfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');
        $.post(examsByclassandsection, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            section_id: section_id,
            academic_session_id: academic_session_id,
            today: today
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#bysubjectfilter").find("#examnames").append('<option value="' + val.id + '" >' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    $("#bysubjectfilter").validate({
        rules: {
            department_id: "required",
            year: "required",
            class_id: "required",
            section_id: "required",
            // examnames: "required",
            // report_type: "required"
        }
    });
    $('#bysubjectfilter').on('submit', function (e) {
        e.preventDefault();
        var byclass = $("#bysubjectfilter").valid();
        if (byclass === true) {
            var year = $("#btwyears").val();
            var department_id = $("#department_id").val();
            var semester_id = $("#semester_id").val();
            var session_id = $("#session_id").val();
            var class_id = $("#changeClassName").val();
            var section_id = $("#sectionID").val();
            var exam_id = $("#examnames").val();
            var report_type = $("#report_type").val();

            var classObj = {
                year: year,
                department_id: department_id,
                classID: class_id,
                sectionID: section_id,
                semesterID: semester_id,
                sessionID: session_id,
                examID: exam_id,
                userID: userID,
            };
           // setLocalStorageForExamResultBySubject(classObj);

            // download set start
            $(".downExamID").val(exam_id);
            $(".downDepartmentID").val(department_id);			
            $(".downClassID").val(class_id);
            $(".downSemesterID").val(semester_id);
            $(".downSessionID").val(session_id);
            $(".downSectionID").val(section_id);
            $(".downAcademicYear").val(year);
            
            $(".downReport_type").val(report_type);
            // download set end

            var formData = new FormData();			
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('department_id', department_id);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('exam_id', exam_id);
            formData.append('semester_id', semester_id);
            formData.append('session_id', session_id);
            formData.append('academic_year', year);
            formData.append('report_type', report_type);
            // examResultBySubject(formData);
            // getStudentList(formData);
			var formData1 = {
                student_name: "",
				department_id:department_id,
                class_id: class_id,
                section_id: section_id,
				exam_id:exam_id,
				semester_id:semester_id,
                session_id: session_id,
				academic_year:year,
				report_type:report_type,
            };
			getStudentList(formData1);
        }
		else {
            $("#student").hide("slow");
        }
    });
    function examResultBySubject(formData){

        // $("#overlay").fadeIn(300);
            // list mode
            var report_type= $("#report_type").val();
            var department_id= $("#department_id").val();
            var class_id=$("#changeClassName option:selected" ).text();
            //alert(class_id);
            $.ajax({
                url: getbySubject,
                method: "Post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    console.log(response);
                    if (response.code == 200) {
                        if (response.data.grade_list_master.length > 0) {
                            var datasetnew = response.data;
                            bysubjectdetails_class(datasetnew);
                            // $("#overlay").fadeOut(300);
                            if(report_type=='english_communication')
                            {
                                $("#byec_body").show("slow");
                                $("#byreport_body").hide("slow");                                       
                                $("#bypersonal_body").hide("slow");
                            }
                            else if(report_type=='report_card')
                            {
                                $("#byec_body").hide("slow");
                                $("#byreport_body").show("slow");                                       
                                $("#bypersonal_body").hide("slow"); 
                            }
                            else
                            {
                                $("#byec_body").hide("slow"); 
                                $("#byreport_body").hide("slow");                                      
                                $("#bypersonal_body").show("slow");
                                if(department_id=='2')
                                {
                                    console.log('2');
                                    $("#secondary_personal").show("slow");
                                    $("#primary_personal").hide("slow"); 
                                }
                                else
                                {
                                    console.log('all');
                                    $("#secondary_personal").hide("slow");
                                    $("#primary_personal").show("slow"); 
                                }
                            }
                            
                        } else {
                            // $("#overlay").fadeOut(300);
                            console.log('No records are available');
                            toastr.info('No records are available');
                        }
                    } else {
                        toastr.error(data.message);
                        $('#byec_body').hide();
                        $('#byreport_body').hide();					                                     
                        $("#bypersonal_body").hide("slow");
                    }
                }
            });
    }


    function getStudentList(formData) {
        $("#student").show("slow");
        // set download filter value
        $('#excelStudentName').val(formData.student_name);
        $('#excelDepartment').val(formData.department_id);
        $('#excelClassID').val(formData.class_id);
        $('#excelSectionID').val(formData.section_id);
        $('#excelStatus').val(formData.status);
        $('#excelSession').val(formData.session_id);
        // $('#academicYear').val(formData.academic_year);
        var table = $('#student-table').DataTable({
            processing: true,
            info: true,
            bDestroy: true,
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
            // exportOptions: { rows: ':visible' },
            ajax: {
                url: studentList,
                data: function (d) {
                    Object.assign(d, formData);
                }
            },
            pageLength: 10,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'name', name: 'name' },
                { data: 'name_common', name: 'name_common' },
                { data: 'register_no', name: 'register_no' },
                { data: 'attendance_no', name: 'attendance_no' },
                { data: 'gender', name: 'gender' },
                { data: 'email', name: 'email' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            columnDefs: [
                {
                    targets: 1,
                    className: 'table-user',
                    // render: function (data, type, row, meta) {
                    //     console.log(row);
                    //     var currentImg = studentImg + row.photo;
                    //     var img = (row.photo != null) ? currentImg : defaultImg;
                    //     return '<img src="' + img + '" class="mr-2 rounded-circle">' +
                    //         '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                    // }
                }
            ]
        });

    }

    function bysubjectdetails_class(datasetnew) {
        $('#bysubjectTableAppend').empty();
        var sno = 0;
        var bysubjectAllTable = "";
        var headers = datasetnew.headers;
        var grade_list_master = datasetnew.grade_list_master;
        bysubjectAllTable += '<div class="table-responsive">' +
            '<table id="tblbycls" class="table w-100 nowrap table-bordered table-striped table2excel" data-tableName="Test Table 1">' +
            '<thead>' +
            '<tr>' +
            '<th class="align-top" rowspan="2">'+sl_no_lang+'</th>' +
            '<th class="align-top" rowspan="2">'+grade_lang+'</th>' +
            '<th class="align-top" rowspan="2">'+class_lang+'</th>' +
            '<th class="align-top" rowspan="2">'+subject_name_lang+'</th>' +
            '<th class="align-top th-sm - 6 rem" rowspan="2">'+total_student_lang+'</th>' +
            '<th class="align-top" rowspan="2">'+absent_lang+'</th>' +
            '<th class="align-top" rowspan="2">'+present_lang+'</th>' +
            '<th class="align-top" rowspan="2">'+subject_teacher_name_lang+'</th>';
        headers.forEach(function (resp) {
            bysubjectAllTable += '<th class="text-center">' + resp.grade + '</th>';
        });
        bysubjectAllTable += '<th class="align-middle" rowspan="2">'+pass_lang+'</th>' +
            '<th class="align-middle" rowspan="2">'+g_lang+'</th>' +
            '<th class="align-middle" rowspan="2">'+gpa_lang+'</th>' +
            '<th class="align-middle" rowspan="2">%</th>' +
            '</tr>';
        bysubjectAllTable += '<tr>';
        headers.forEach(function (resp) {
            bysubjectAllTable += '<td class="text-center">%</td>';
        });
        bysubjectAllTable += '</tr></thead><tbody>';
        grade_list_master.forEach(function (res) {
            sno++;
            bysubjectAllTable += '<tr>' +
                '<td class="text-center" rowspan="2">';
            bysubjectAllTable += sno +
                '</td>';
            bysubjectAllTable += '<td class="text-left" rowspan="2">' +
                '<label for="clsname">' + res.class_name + '</label>' +
                '</td>';
            bysubjectAllTable += '<td class="text-center" rowspan="2">' +
                '<label for="stdcount"> ' + res.section_name + '</label>' +
                '</td>';
            bysubjectAllTable += '<td class="text-left" rowspan="2">' +
                '<label for="clsname">' + res.subject_name + '</label>' +
                '</td>';
            bysubjectAllTable += '<td class="text-left" rowspan="2">' +
                '<label for="clsname">' + res.totalstudentcount + '</label>' +
                '</td>';
            bysubjectAllTable += '<td class="text-left">' +
                '<label for="clsname">' + res.absent_count + '</label>' +
                '</td>';
            bysubjectAllTable += '<td class="text-center">' +
                '<label for="stdcount">' + res.present_count + '</label>' +
                '</td>';
            bysubjectAllTable += '<td class="text-left" rowspan="2">' +
                '<label for="clsname">' + res.teacher_name + '</label>' +
                '</td>';
            headers.forEach(function (resp) {
                var obj = res.gradecnt;
                var exists = isKey(resp.grade, obj); // true
                if (exists) {
                    Object.keys(obj).forEach(key => {
                        if (resp.grade == key) {
                            // bysubjectAllTable += '<td class="text-center">' + key, obj[key] + '</td>';
                            bysubjectAllTable += '<td class="text-center">' + obj[key] + '</td>';
                        }
                    });
                } else {
                    bysubjectAllTable += '<td class="text-center">0</td>';
                }
            });
            bysubjectAllTable += '<td class="text-center">' + res.pass_count + '</td>' +
                '<td class="text-center">' + res.fail_count + '</td>' +
                '<td class="text-center" rowspan="2">' + res.gpa + '</td>' +
                '<td class="text-center" rowspan="2">' + res.pass_percentage + '</td>';
            bysubjectAllTable += '</tr>';
            // show another row percentage
            bysubjectAllTable += '<tr>';
            var absentPer = (res.absent_count / res.totalstudentcount) * 100;
            absentPer = parseFloat(absentPer, 10).toFixed(2);
            var presentPer = (res.present_count / res.totalstudentcount) * 100;
            presentPer = parseFloat(presentPer, 10).toFixed(2);
            bysubjectAllTable += '<td class="text-left">' +
                '<label for="clsname">' + absentPer + '</label>' +
                '</td>';
            bysubjectAllTable += '<td class="text-center">' +
                '<label for="stdcount">' + presentPer + '</label>' +
                '</td>';
            headers.forEach(function (resp) {
                var obj = res.gradecnt;
                var exists = isKey(resp.grade, obj); // true
                if (exists) {
                    Object.keys(obj).forEach(key => {
                        if (resp.grade == key) {
                            // bysubjectAllTable += '<td class="text-center">' + key, obj[key] + '</td>';
                            var gradepercentage = (obj[key] / res.totalstudentcount) * 100;
                            gradepercentage = parseFloat(gradepercentage, 10).toFixed(2);
                            bysubjectAllTable += '<td class="text-center">' + gradepercentage + '</td>';
                        }
                    });
                } else {
                    bysubjectAllTable += '<td class="text-center">0</td>';
                }
            });
            bysubjectAllTable += '<td class="text-center">' + res.pass_percentage + '</td>' +
                '<td class="text-center">' + res.fail_percentage + '</td>';
            bysubjectAllTable += '</tr>';
        });
        bysubjectAllTable += '</tbody></table>' +
            '</div>';
        $("#bysubjectTableAppend").append(bysubjectAllTable);
    }

    $(document).on('click', '.exportToExcel', function (e) {
        // var table = $(this).prev('.table2excel');
        var table = $('.table2excel');
        if (table && table.length) {
            var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
            $(table).table2excel({
                // exclude: ".noExl",
                name: "By Subject",
                filename: downloadFileName + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true,
                preserveColors: preserveColors
            });
        }
    });

});

// find matched
function isKey(key, obj) {
    var keys = Object.keys(obj).map(function (x) {
        return x;
    });
    return keys.indexOf(key) !== -1;
}

