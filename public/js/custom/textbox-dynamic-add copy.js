$(document).ready(function () {
  // short test dynamic add start
  var buttonAdd = $("#add-button");
  var buttonRemove = $("#remove-button");
  var className = ".dynamic-field";
  var count = 0;
  var field = "";
  var maxFields = 8;
  $(".shortTestHideSHow").hide();

  function totalFields() {
    return $(className).length;
  }

  function addNewField() {
    count = totalFields() + 1;
    field = $("#dynamic-field-1").clone();
    field.attr("id", "dynamic-field-" + count);
    field.children("label").text("Short Test " + count);
    field.find("input").val("");
    $(className + ":last").after($(field));
  }

  function removeLastField() {
    if (totalFields() > 1) {
      $(className + ":last").remove();
    }
  }

  function enableButtonRemove() {
    if (totalFields() === 2) {
      buttonRemove.removeAttr("disabled");
      buttonRemove.addClass("shadow-sm");
    }
  }

  function disableButtonRemove() {
    if (totalFields() === 1) {
      buttonRemove.attr("disabled", "disabled");
      buttonRemove.removeClass("shadow-sm");
    }
  }

  function disableButtonAdd() {
    if (totalFields() === maxFields) {
      buttonAdd.attr("disabled", "disabled");
      buttonAdd.removeClass("shadow-sm");
    }
  }

  function enableButtonAdd() {
    if (totalFields() === (maxFields - 1)) {
      buttonAdd.removeAttr("disabled");
      buttonAdd.addClass("shadow-sm");
    }
  }

  buttonAdd.click(function () {
    addNewField();
    enableButtonRemove();
    disableButtonAdd();
  });

  buttonRemove.click(function () {
    removeLastField();
    disableButtonRemove();
    enableButtonAdd();
  });
  // short test dynamic add 
  // $("#getShortTest").validate({
  //   rules: {
  //     "field[]": "required"
  //   },
  //   messages: {
  //     "field[]": "Please select short test",
  //   }
  // });

  var rules = new Object();
  var messages = new Object();
  $('input[name^=field]:text').each(function () {
    rules[this.name] = { required: true };
    messages[this.name] = { required: 'This field is required' };
  });

  $("#getShortTest").validate({
    rules: rules,
    messages: messages,
    errorPlacement: function (error, element) {
      error.appendTo("#shortTestError");
    }
  });

  $('#getShortTest').on('submit', function (e) {
    e.preventDefault();
    var form = this;
    var branchCheck = $("#getShortTest").valid();

    var field = $("input[name='field[]']")
      .map(function () { return $(this).val(); }).get();
    var grade = $("select[name='grade[]']")
      .map(function () { return $(this).val(); }).get();

    var testVal = [];
    for (let i = 0; i < field.length; i++) {
      // r[keys[i]] = values[i];
      var r = {};
      r['test_name'] = field[i];
      r['status'] = grade[i];
      testVal.push(r);
    }

    console.log("combine values");
    console.log(testVal);
    if (branchCheck === true) {
      $.ajax({
        url: $(form).attr('action'),
        method: $(form).attr('method'),
        data: new FormData(form),
        processData: false,
        dataType: 'json',
        contentType: false,
        success: function (response) {
          console.log("----------")
          console.log(response)
          if (response.code == 200) {
            $(".shortTestHideSHow").show();
            $('#shortTestAppend').empty();
            var shortTestAppend = "";
            var shortTestTable = "";
            var index = 0;
            shortTestTable += '<table class="table table-striped table-nowrap">' +
              '<thead>' +
              '<tr>' +
              '<th>S.no</th>' +
              '<th>Student Name</th>';
            $.each(testVal, function (key, val) {
              index++;
              shortTestAppend += '<tr>' +
                '<td>' + index + '</td>' +
                '<td class="table-user text-left">' +
                '<label for="test_name">' + val.test_name + '</label>' +
                '</td>' +
                '<td>' +
                '<div class="table-user text-left">' +
                '<label for="status">' + val.status + '</label>' +
                '</div>' +
                '</td>' +
                '</tr>';
              // table add
              shortTestTable += '<th>' + val.test_name + '</th>';
            });
            shortTestTable += '</tr>' +
              '</thead>' +
              '<tbody>';
            var start = 0;
            var indexStart = 0;

            if (response.data.length > 0) {

              response.data.forEach(function (res) {
                start++;
                // short test table div start
                shortTestTable += '<tr>' +
                  '<td>' + start + '</td>' +
                  '<td class="table-user">' +
                  '<img src="' + defaultImg + '" class="mr-2 rounded-circle">' +
                  '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + res.first_name + ' ' + res.last_name + '</a>' +
                  '</td>';
                // $.each(testVal, function (key, val) {
                //   val.test_name
                // });
                // shortTestTable += '<td> <input type="text" name="' + res.student_id + '" class="form-control text-right" style="width:100px;" id="name">' +
                //   '</td>';
                // shortTestTable += '</tr>';
                // short test table div end
                $.each(testVal, function (key, val) {
                  indexStart++;
                  // response.data.forEach(function (res) {
                  shortTestTable += '<td> <input type="text" name="test_name[' + indexStart + '][' + val.test_name + ']" class="form-control text-right" style="width:100px;">' +
                    '</td>';

                  // });

                });
                shortTestTable += '</tr>';
                indexStart =0;

              });

            }

            $("#shortTestAppend").append(shortTestAppend);

            shortTestTable += '</tbody>' +
              '</table>';
            $("#shortTestAppend").append(shortTestTable);


            // var columns = [{ "title": "NAME" }, { "title": "COUNTY" }];
            // var datas = [["John Doe", "Fresno"]];
            // var colDef = [{
            //   "targets": 0,
            //   "width": "15%",
            //   "className": "table-user",
            //   "render": function (data, type, row, meta) {
            //     var first_name = '<input type="hidden" name="attendance[' + meta.row + '][attendance_id]" value="' + row.att_id + '">' +
            //       '<input type="hidden" name="attendance[' + meta.row + '][student_id]" value="' + row.student_id + '">' +
            //       '<input type="hidden" name="attendance[' + meta.row + '][first_name]" value="' + row.first_name + '">' +
            //       '<input type="hidden" name="attendance[' + meta.row + '][last_name]" value="' + row.last_name + '">' +
            //       '<img src="' + defaultImg + '" class="mr-2 rounded-circle">' +
            //       '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
            //     return first_name;
            //   }
            // },
            // {
            //   "targets": 1,
            //   "width": "20%",
            //   "render": function (data, type, row, meta) {
            //     row.att_status
            //     var att_status = '<select class="form-control changeAttendanceSelect" data-style="btn-outline-success" name="attendance[' + meta.row + '][att_status]">' +
            //       '<option value="">Choose</option>' +
            //       '<option value="present" ' + (row.att_status == "present" ? "selected" : "") + '>Present</option>' +
            //       '<option value="absent" ' + (row.att_status == "absent" ? "selected" : "") + '>Absent</option>' +
            //       '<option value="late" ' + (row.att_status == "late" ? "selected" : "") + '>Late</option>' +
            //       '<option value="excused" ' + (row.att_status == "excused" ? "selected" : "") + '>Excused</option>' +
            //       '</select>';



            //     return att_status;
            //   }
            // }];
            // // columnDefs
            // // var dataObject = eval('[{"COLUMNS":' + columns + ',"DATA":' + datas + '}]');
            // var dataObject = eval('[{"COLUMNS":[{ "title": "NAME"}, { "title": "COUNTY"}],"DATA":[["John Doe","Fresno"],["Billy","Fresno"],["Tom","Kern"],["King Smith","Kings"]]}]');
            // var columns = [];
            // $('#example').dataTable({
            //   "data": dataObject[0].DATA,
            //   "columns": dataObject[0].COLUMNS
            // });
          } else {
            toastr.error(data.message);
          }
        }
      });
    }
  });
  // short test end
});