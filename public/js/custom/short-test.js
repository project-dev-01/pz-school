$(document).ready(function () {
  // short test dynamic add start
  var buttonAdd = $("#add-button");
  var buttonRemove = $("#remove-button");
  var className = ".dynamic-field";
  var count = 0;
  var field = "";
  var maxFields = 8;
  // $(".shortTestHideSHow").hide();

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
          // $('#getShortTest')[0].reset();
          // $('#shortTestAppend').empty();
          // $('#shortTestTableAppend').empty();
          // $(".shortTestHideSHow").hide();

        } else {
          toastr.error(response.message);
        }
      }
    });
  });
  // rules validation
  $("#addDailyReport").validate({
    rules: {
      daily_report: "required"
    }
  });
  //  add daily report
  $('#addDailyReport').on('submit', function (e) {
    e.preventDefault();
    var form = this;
    var addDailyReport = $("#addDailyReport").valid();
    if (addDailyReport === true) {
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
            // $('#addDailyReport')[0].reset();
          } else {
            toastr.error(response.message);
          }
        }
      });
    }

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
        if (response.code == 200) {
          toastr.success(response.message);
          // $('#addDailyReport')[0].reset();
        } else {
          toastr.error(response.message);
        }
      }
    });
  });


});