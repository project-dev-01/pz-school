$(function () {
        // change classroom
        $('#changeClassName').on('change', function () {       
            var class_id = $(this).val();
            $("#byclassfilter").find("#sectionID").empty();
            $("#byclassfilter").find("#sectionID").append('<option value="">Select Section</option>');       
    
            $.post(sectionByClass, { class_id: class_id }, function (res) {
                if (res.code == 200) {
                    $.each(res.data, function (key, val) {
                        $("#byclassfilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                    });
                }
            }, 'json');
        });        
        // change section
        $('#sectionID').on('change', function () {
            var section_id = $(this).val();
            var class_id = $("#changeClassName").val();
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
    
            today = yyyy + '/' + mm + '/' + dd;
            $("#byclassfilter").find("#examnames").empty();
            $("#byclassfilter").find("#examnames").append('<option value="">Select exams</option>');
            $.get(examsByclassandsection, {
                token: token,
                branch_id: branchID,                
                class_id: class_id,
                section_id: section_id,
                today:today
            }, function (res) {
                if (res.code == 200) {
                    $.each(res.data, function (key, val) {
                        var marks = JSON.parse(val.marks);
                        $("#byclassfilter").find("#examnames").append('<option value="' + val.id + '" data-full="'+marks.full+'" data-pass="'+marks.pass+'">' + val.name + '</option>');
                    });
                }
            }, 'json');
        });
        $("#byclassfilter").validate({
            rules: {
                class_id: "required",
                section_id: "required",         
                exam_id: "required"
            }
        });
        $('#byclassfilter').on('submit', function (e) {
            e.preventDefault();

            var byclass = $("#byclassfilter").valid();
            
            var fmark = $('option:selected', '#examnames').attr('data-full');
            var pmark = $('option:selected', '#examnames').attr('data-pass');
            $("#fullmark").val(fmark);
            $("#passmark").val(pmark);
            
            if (byclass === true) {
    
                var class_id = $("#changeClassName").val();
                var Selected_classname = $('#changeClassName :selected').text();
             
                var section_id = $("#sectionID").val();      
                var exam_id = $("#examnames").val();   
             console.log(Selected_classname);
                // list mode
                $.get(getbyClass, { token: token, branch_id: branchID, exam_id: exam_id, class_id: class_id, section_id: section_id }, function (response) {
                    if (response.code == 200) {
                        var dataSetNew = response.data;
                        if (response.code == 200) {
                            if (response.data.length > 0) {
                                console.log(response.data);
                                var std_count = response.data[0].getstudentcount;
                                var techarname = response.data[0].getteachername;
                                var mastergradelist = response.data[0].getmastergrade;
                                var gradecount = response.data[1];
                                console.log(mastergradelist);
                      
                       
                                byclassdetails(std_count,techarname,gradecount,Selected_classname,mastergradelist);
                                $("#testexecution").hide();
                                $("#listModeClassID").val(class_id);
                                $("#listModeSectionID").val(section_id);
                                $("#listModeSubjectID").val(subject_id);
                                $("#listModeexamID").val(exam_id);
                                console.log('end');
                            } else {
                              
                                toastr.info('No records are available');
                            }
    
                            //$("#layoutModeGrid").append(layoutModeGrid);
                        } else {
                            toastr.error(data.message);
                        }
                    }
                });             
            };
        });        
});
function byclassdetails(std_count,techarname,gradecount,Selected_classname,mastergradelist) {


    $('#byclassTableAppend').empty();
    var shortTestTable = "";
    var index = 0;
    shortTestTable += '<div class="table-responsive">' +
        '<table class="table table-striped table-nowrap">' +
        '<thead>' +
        '<tr>' +
        '<th class="align-top" rowspan="2">S.no.</th>' +
        '<th class="align-top" rowspan="2">Class</th>' +
        '<th class="align-top th-sm - 6 rem" rowspan="2">Tot. Students</th>' +
        '<th class="align-top" rowspan="2">Absent</th>'+
        '<th class="align-top" rowspan="2">Present</th>'+
        '<th class="align-top" rowspan="2">Class Teacher Name</th>';
        if (mastergradelist.length > 0) {
            mastergradelist.forEach(function (res) {
                shortTestTable +='<th class="text-center">'+res.grade+'</th>'                
            }); 
            shortTestTable += '</tr>'+
            '<tr>';
            mastergradelist.forEach(function (res) {
                shortTestTable += '<td class="text-center">%</td>'              
            });
        }
            shortTestTable += '</tr>'; 
    '</thead>'+
        '<tbody>';

    var start = 0;
    var indexStart = 0; 
    if (std_count.length > 0) {
        std_count.forEach(function (res) {
            shortTestTable +='<th class="text-center">'+res.grade+'</th>'                
        }); 
        shortTestTable += '</tr>'+
        '<tr>';
        std_count.forEach(function (res) {
            shortTestTable += '<td class="text-center">%</td>'              
        });
    }     
        
    if (std_count.length > 0) {
        std_count.forEach(function (res) {
            start++;
            // short test table div start
            shortTestTable += '<tr>' +
                '<td>';
            if (start == 1) {
                shortTestTable += '<input type="hidden" name="date" value="' + Selected_classname + '">' 
                  

            }
            shortTestTable += start +
                '</td>' +
                '<td class="table-user">' +
                '<img src="' + defaultImg + '" class="mr-2 rounded-circle">' +
                '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + res.first_name + ' ' + res.last_name + '</a>' +
                '</td>';
            // $.each(subdiv, function (key, val) {
            //     shortTestTable += '<td>' +
            //         '<input type="text" id="' + val.subject_division + start + '" data-ref-studentid="' + res.student_id + '" data-id="' + val.credit_point + '" class="form-control cutoff" style="width:100px;">' +

            //         '</td>';
            // });
            shortTestTable += '<td>' +
                '<label for="tot_score" class="tot_score' + res.student_id + '" data-id="' + res.student_id + '">0</label>' +
                '</td>';
            shortTestTable += '<td>' +
                '<label for="grade" class="lbl_grade' + res.student_id + '" data-id="' + res.student_id + '">-</label>' +
                '</td>';
            shortTestTable += '<td>' +
                '<label for="ranking" class="lbl_ranking" data-id="">0</label>' +
                '</td>';
            
            indexStart++;
            shortTestTable += '</tr>';
        });
    }

    shortTestTable += '</tbody>' +
        '</table></div>';
    $("#byclassTableAppend").append(shortTestTable);
}