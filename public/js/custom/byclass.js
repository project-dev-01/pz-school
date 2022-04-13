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
                            var gradecount = response.data[1];
                        
                            console.log(gradecount);
                            byclassdetails(std_count, techarary, gradecount, Selected_classname, mastergradelist);
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
function byclassdetails(std_count, techarary, gradecount, Selected_classname, mastergradelist) {


    $('#byclassTableAppend').empty();
    var byclassTestTable = "";
    var passcount =0;
    var failcount=0;
    var pass_percentage=0;
    // byclassTestTable += '<div class="table-responsive">' +
    //     '<table class="table table-striped table-nowrap" id="dybyclass">' +
    //     '<thead id="myhed">' +
    //     '<tr>' +
    //     '<th class="align-top" rowspan="2">S.no.</th>' +
    //     '<th class="align-top" rowspan="2">Class</th>' +
    //     '<th class="align-top th-sm - 6 rem" rowspan="2">Tot. Students</th>' +
    //     '<th class="align-top" rowspan="2">Absent</th>' +
    //     '<th class="align-top" rowspan="2">Present</th>' +
    //     '<th class="align-top" rowspan="2">Class Teacher Name</th>';
    // if (mastergradelist.length > 0) {
    //     mastergradelist.forEach(function (res) {
    //         byclassTestTable += '<th class="text-center" data-id=' + res.id + '>' + res.grade + '</th>'
    //     });
    //     byclassTestTable += '<th class="text-center">PASS</th>' +
    //         '<th class="text-center">G</th>' +
    //         '<th class="text-center">Avg. grade of subject</th>' +
    //         '<th class="text-center">%</th>' +
    //         '</tr>';
    //     byclassTestTable += '<tr>';
    //     mastergradelist.forEach(function (res) {
    //         byclassTestTable += '<td class="text-center">%</td>'
    //     });
    //     byclassTestTable += '</tr>';
    // }
    // '</thead>';
    //byclassTestTable += '<tbody>';
    byclassTestTable += '<tr>' +
        '<td rowspan="2">' +
        '<label for="sno" class="text-center" >1</label>' +
        '</td>' +
        '<td rowspan="2">' +
        '<label for="clsname" class="text-center" > ' + Selected_classname + '</label>' +
        '</td>' +
        '<td rowspan="2">' +
        '<label for="stdcount" class="text-right"> ' + std_count[0].totalStudentCount + '</label>' +
        '</td>' +
        '<td rowspan="2">' +
        '<label for="failcount" class="text-right">'+failcount+'</label>' +
        '</td>' +
        '<td rowspan="2">' +
        '<label for="passcount" class="text-right">'+passcount+'</label>' +
        '</td>' +
        '<td rowspan="2">' +
        '<label for="teachnam" class="text-center">' + techarary[0].teachername + '</label>' +
        '</td>';

    // gradecount.forEach(function (res) {
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
                    passcount += res.pass;
                    failcount += res.fail;
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
        // }

        // gradecount.forEach(function (res) {
        //     var i =0;
        //     console.log("gname");
        //     console.log(res.gname);
        //     console.log(th.text());
        //     if (res.gname == th.text()) {
        //         i++;
        //         byclassTestTable += '<td class="text-center">' + res.gradecount + '</td>'
        //     console.log(res);
        //     }
        //     console.log(i);
        //     // if(i==0)
        //     // {
        //     //     byclassTestTable += '<td class="text-center">0</td>'
        //     // }
        // });


        // if (index >= 6) {

        // gradecount.forEach(function (res) {

        //     var th = $('#tblbycls  thead  > tr >th').eq($(this).index());
        //     console.log(index);
        //     console.log(th.text());
        //     if (res.gname == th.text()) {
        //         byclassTestTable += '<td class="text-center">' + res.gradecount + '</td>'
        //     }
        //     else {
        //         byclassTestTable += '<td class="text-center">00</td>'
        //     }              
        // });
        //  }
    });
    console.log(gradepercentage);
    console.log(gradepercentage.length);
    pass_percentage =(passcount /  std_count[0].totalStudentCount) * 100;
    console.log(pass_percentage);
    byclassTestTable += '<td class="text-center">'+passcount+'</td>'+
    '<td class="text-center">'+failcount+'</td>'+
    '<td class="text-center" rowspan="2">'+pass_percentage+'</td>'+
    '<td class="text-center" rowspan="2">'+pass_percentage+'</td>'+
    '</tr>';
    byclassTestTable += '<tr>';
 
    gradepercentage.forEach(function (res) {                             
        byclassTestTable +='<td class="text-right">'+res+'</td>'    
    });
    '<td class="text-center" rowspan="2">'+pass_percentage+'</td>'
    byclassTestTable +='</tr>';
    
    //  var headerObj = $(this).parents('table').find('#myhed').eq($(this).index());
    //  var headerObj1 = $(this).siblings('td:first-child');
    // // A quick test!

    //$('#tblbycls > thead  > tr >th').each(function(index, tr) {
    // console.log(index);

    // if (std_count.length > 0) {
    //     std_count.forEach(function (res) {
    //         start++;
    //         // short test table div start

    //             '<td>';
    //         if (start == 1) {
    //             byclassTestTable += '<input type="hidden" name="date" value="' + Selected_classname + '">' 

    //         byclassTestTable += start +
    //             '</td>' +
    //             '<td class="table-user">' +
    //             '<img src="' + defaultImg + '" class="mr-2 rounded-circle">' +
    //             '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + res.first_name + ' ' + res.last_name + '</a>' +
    //             '</td>'; 
    //         indexStart++;
    //         byclassTestTable += '</tr>';
    //     });
    // }

    // byclassTestTable += '</tr>';
    //   '</table>
    byclassTestTable += '</tr>';
    $("#byclassTableAppend").append(byclassTestTable);
}