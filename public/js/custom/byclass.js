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
            today: today
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    var marks = JSON.parse(val.marks);
                    $("#byclassfilter").find("#examnames").append('<option value="' + val.id + '" data-full="' + marks.full + '" data-pass="' + marks.pass + '">' + val.name + '</option>');
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
                            var techarary = response.data[0].getteachername;
                            var mastergradelist = response.data[0].getmastergrade;
                            var examattendance = response.data[0].getexamattendance;
                            var gradecount = response.data[1];
                        
                            console.log(gradecount);
                            byclassdetails(std_count, techarary, gradecount, Selected_classname, mastergradelist,examattendance);
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
function byclassdetails(std_count, techarary, gradecount, Selected_classname, mastergradelist,examattendance) {


    $('#byclassTableAppend').empty();
    var byclassTestTable = "";
    var passcount =0;
    var failcount=0;
    var pass_percentage=0;
    var fail_percentage=0;   
    byclassTestTable += '<tr>' +
        '<td class="text-center" rowspan="2">' +
        '<label for="sno">1</label>' +
        '</td>' +
        '<td class="text-left" rowspan="2">' +
        '<label for="clsname"  > ' + Selected_classname + '</label>' +
        '</td>' +
        '<td class="text-center" rowspan="2">' +
        '<label for="stdcount"> ' + std_count[0].totalStudentCount + '</label>' +
        '</td>' +
        '<td class="text-right" rowspan="2">' +
        '<label for="failcount">'+examattendance[0].absent+'</label>' +
        '</td>' +
        '<td class="text-right" rowspan="2">' +
        '<label for="passcount">'+examattendance[0].present+'</label>' +
        '</td>' +
        '<td class="text-center" rowspan="2">' +
        '<label for="teachnam">' + techarary[0].teachername + '</label>' +
        '</td>';
   
    var gradepercentage = [];
    $('#tblbycls > thead  > tr >th').each(function (index, tr) {
        var th = $('#tblbycls  thead  > tr >th').eq($(this).index());
        var nineindex = 9;
        var endgradeindex = (6 + nineindex);
      
        if (index >= 6 && endgradeindex > index) {         
            var i = 0;
            gradecount.forEach(function (res) {
                if (res.gname == th.text()) {
                    i++;
                    byclassTestTable += '<td class="text-right">' + res.gradecount + '</td>'+
                    console.log('matched' + i);
                    // passcount += res.pass;
                    // failcount += res.fail;
                    var getval = res.gradecount / std_count[0].totalStudentCount
                    var gper = getval * 100 ;
                    var gradeper = parseFloat(gper, 10).toFixed(2);
                 
                    gradepercentage.push(gradeper); 
                }                           
            }); 
            if (i == 0) {            
                byclassTestTable += '<td class="text-right">0</td>'
                gradepercentage.push(0); 
            }
          
        }   
    });
    console.log(gradepercentage);
    console.log(gradepercentage.length);
    passcount=examattendance[0].pass;
    failcount=examattendance[0].fail;
    pass_percentage =(passcount /  std_count[0].totalStudentCount) * 100;
    fail_percentage =(failcount /  std_count[0].totalStudentCount) * 100;
    pass_percentage = parseFloat(pass_percentage, 10).toFixed(2);
    fail_percentage = parseFloat(fail_percentage, 10).toFixed(2);
    console.log(pass_percentage);
    byclassTestTable += '<td class="text-center">'+passcount+'</td>'+
    '<td class="text-center">'+failcount+'</td>'+
    '<td class="text-center" rowspan="2">-</td>'+
    '<td class="text-center" rowspan="2">'+pass_percentage+'</td>'+
    '</tr>';
    byclassTestTable += '<tr>';
 
    gradepercentage.forEach(function (res) {                             
        byclassTestTable +='<td class="text-right">'+res+'</td>'    
    });
    byclassTestTable +='<td class="text-right">'+pass_percentage+'</td>'+
    '<td class="text-right">'+fail_percentage+'</td>';    
    byclassTestTable += '</tr>';
    $("#byclassTableAppend").append(byclassTestTable);
}