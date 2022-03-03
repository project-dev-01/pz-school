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

  // var rules = new Object();
  // var messages = new Object();
  // $("input[name='field[]']").each(function () {
  //   rules[this.name] = { required: true };
  //   messages[this.name] = { required: 'This field is required' };
  // });

  // $("#getShortTest").validate({
  //   rules: rules,
  //   messages: messages,
  //   // errorPlacement: function (error, element) {
  //   //   error.appendTo("#shortTestError");
  //   // }
  // });
  $("#getShortTest").validate(); //sets up the validator
  $("input[name*='field']").rules("add", "required");


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
      if (field[i] != '' && grade[i] != '') {
        r['test_name'] = field[i];
        r['status'] = grade[i];
        testVal.push(r);
      }
    }

    if (branchCheck === true) {
      // return false;
      $.ajax({
        url: $(form).attr('action'),
        method: $(form).attr('method'),
        data: new FormData(form),
        processData: false,
        dataType: 'json',
        contentType: false,
        success: function (response) {
          if (response.code == 200) {
            // get value short test
            var classID = $("#shortTestClassID").val();
            var sectionID = $("#shortTestSectionID").val();
            var subjectID = $("#shortTestSubjectID").val();
            var classDate = $("#shortTestSelectedDate").val();

            $(".shortTestHideSHow").show();
            $('#shortTestAppend').empty();
            $('#shortTestTableAppend').empty();

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
                  '<td>';
                if (start == 1) {
                  shortTestTable += '<input type="hidden" name="date" value="' + classDate + '">' +
                    '<input type="hidden" name="class_id" value="' + classID + '">' +
                    '<input type="hidden" name="section_id" value="' + sectionID + '">' +
                    '<input type="hidden" name="subject_id" value="' + subjectID + '">';
                }
                shortTestTable += start +
                  '</td>' +
                  '<td class="table-user">' +
                  '<img src="' + defaultImg + '" class="mr-2 rounded-circle">' +
                  '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + res.first_name + ' ' + res.last_name + '</a>' +
                  '</td>';
                // short test table div end
                $.each(testVal, function (key, val) {
                  indexStart++;
                  shortTestTable += '<td>' +
                    '<input type="hidden" name="short_test[' + indexStart + '][student_id]" value="' + res.student_id + '">' +
                    '<input type="hidden" name="short_test[' + indexStart + '][test_name]" value="' + val.test_name + '">' +
                    '<input type="hidden" name="short_test[' + indexStart + '][grade_status]" value="' + val.status + '">' +
                    '<input type="text" name="short_test[' + indexStart + '][test_marks]" value="" class="form-control" style="width:100px;">' +
                    '</td>';
                });
                shortTestTable += '</tr>';
              });

            }

            $("#shortTestAppend").append(shortTestAppend);

            shortTestTable += '</tbody>' +
              '</table>';
            $("#shortTestTableAppend").append(shortTestTable);
          } else {
            toastr.error(data.message);
          }
        }
      });
    }
  });
  // short test end
  $('#addShortTest').on('submit', function (e) {
    e.preventDefault();
    var form = this;

    $.ajax({
      url: $(form).attr('action'),
      method: $(form).attr('method'),
      data: new FormData(form),
      processData: false,
      dataType: 'json',
      contentType: false,
      success: function (response) {
        if (response.code == 200) {
          toastr.success(response.message);
          $('#getShortTest')[0].reset();
          $('#shortTestAppend').empty();
          $('#shortTestTableAppend').empty();
          $(".shortTestHideSHow").hide();

        } else {
          toastr.error(data.message);
        }
      }
    });
  });

  //  add daily report
  $('#addDailyReport').on('submit', function (e) {
    e.preventDefault();
    var form = this;

    $.ajax({
      url: $(form).attr('action'),
      method: $(form).attr('method'),
      data: new FormData(form),
      processData: false,
      dataType: 'json',
      contentType: false,
      success: function (response) {
        if (response.code == 200) {
          toastr.success(response.message);
          $('#addDailyReport')[0].reset();
        } else {
          toastr.error(data.message);
        }
      }
    });
  });

  $('#addDailyReportRemarks').on('submit', function (e) {
    e.preventDefault();
    var form = this;

    $.ajax({
      url: $(form).attr('action'),
      method: $(form).attr('method'),
      data: new FormData(form),
      processData: false,
      dataType: 'json',
      contentType: false,
      success: function (response) {
        console.log('report remakrs')
        console.log(response)
        if (response.code == 200) {
          toastr.success(response.message);
          // $('#addDailyReport')[0].reset();
        } else {
          toastr.error(data.message);
        }
      }
    });
  });


});