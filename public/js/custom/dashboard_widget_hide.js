$(function () {
    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#attendanceFilter';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    function classAllocation(department_id, Selector, classID) {
        $(Selector).find('select[name="class_id"]').empty();
        $(Selector).find('select[name="class_id"]').append('<option value="">' + select_grade + '</option>');
        $(Selector).find('select[name="section_id"]').empty();
        $(Selector).find('select[name="section_id"]').append('<option value="">' + select_class + '</option>');
        if (department_id) {
            $.post(getGradeByDepartmentUrl,
                {
                    branch_id: branchID,
                    department_id: department_id,
                    teacher_id: ref_user_id
                }, function (res) {
                    if (res.code == 200) {
                        $.each(res.data, function (key, val) {
                            $(Selector).find('select[name="class_id"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                        if (classID != '' || classID != null) {
                            $(Selector).find('select[name="class_id"]').val(classID);
                        }
                    }
                }, 'json');
        }
    }
    // change classroom
    $('#changeClassName').on('change', function () {
        $(".attendanceReport").hide();
        var class_id = $(this).val();
        $("#attendanceFilter").find("#sectionID").empty();
        $("#attendanceFilter").find("#sectionID").append('<option value="">' + select_class + '</option>');

        $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: ref_user_id, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#attendanceFilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    $("#toggle-btn").click(function () {
        $("#toggle-example").collapse('toggle'); // toggle collapse
    });
    var i = 1;
    var i = parseInt(countHideUnhide) + 1;
    $(document).on('click', '.move-up', function () {
        moveWidget($(this), 'up');
    });

    $(document).on('click', '.move-down', function () {
        moveWidget($(this), 'down');
    });

    $(document).on('click', '.remove-widget', function () {
        removeWidget($(this));
    });
    function moveWidget(button, direction) {
        var row = button.closest('tr');
        var currentOrder = parseInt(row.attr('data-order'));

        if (direction === 'up') {
            var prevRow = row.prev('tr');
            if (prevRow.length !== 0) {
                row.insertBefore(prevRow);
                updateOrderValues();
            }
        } else if (direction === 'down') {
            var nextRow = row.next('tr');
            if (nextRow.length !== 0) {
                row.insertAfter(nextRow);
                updateOrderValues();
            }
        }
    }
    function removeWidget(button) {
        var row = button.closest('tr');
        row.remove();
        updateOrderValues();
    }
    function updateOrderValues() {
        $('.widget').each(function (index) {
            $(this).attr('data-order', index + 1);
            $(this).find('[id^="orderNo"]').val(index + 1);
        });
    }

    $("#add").click(function () {
        var temp = '<tr class="widget" id="' + i + '" data-id="' + i + '" data-order="' + i + '">' +
            '<td class="col-md-9">' +
            '<input type="hidden" name="unhide_data[' + i + '][order_no]" id="orderNo' + i + '" value="' + i + '">' +
            '<input type="hidden" name="unhide_data[' + i + '][widget_name]" id="widgetName' + i + '">' +
            '<input type="hidden" name="unhide_data[' + i + '][widget_value]" id="widgetValue' + i + '">' +
            '<input type="hidden" name="unhide_data[' + i + '][visibility]" id="visibility' + i + '">' +
            '<input type="hidden" name="unhide_data[' + i + '][department_id]" id="departmentID' + i + '">' +
            '<input type="hidden" name="unhide_data[' + i + '][class_id]" id="classID' + i + '">' +
            '<input type="hidden" name="unhide_data[' + i + '][section_id]" id="sectionID' + i + '">' +
            '<input type="hidden" name="unhide_data[' + i + '][pattern]" id="patternName' + i + '">' +
            '<button type="button" data-widget="' + i + '" id="WidgetLabelName' + i + '" class="form-control name_list addWidget" style="height: 50px;border-radius: 10px;border: 1px solid #18161652;background-color: transparent;">' + addWidgetH + '</button>' +
            '</td>' +
            '<td class="col-md-3" style="padding:15px;">' +
            '<button type="button" class="fe-arrow-up move-up" style="background-color: transparent;border: 1px solid #18161652;height: 50px;border-radius: 10px;width: 45px;margin-right:10px;"><i class="fe-arrow-up"></i></button>' +
            '<button type="button" class="fe-arrow-down move-down" style="background-color: transparent;border: 1px solid #18161652;height: 50px;border-radius: 10px;width: 45px;margin-right:10px;"><i class="fe-arrow-down"></i></button>' +
            '<button type="button" class="fe-remove remove-widget" style="background-color: transparent;border: 1px solid #18161652;height: 50px;border-radius: 10px;width: 45px;margin-right:10px;"><i class="fe-trash"></i></button>' +
            '</td>' +
            '</tr>';

        $('#dynamic_field').append(temp);
        updateOrderValues();
        i++;
    });

    $(document).on('click', '.addWidget', function () {
        var widgetID = $(this).data('widget');
        console.log("widgetID");
        console.log(widgetID);
        $("#widgetDynamicID").val(widgetID);
        $('#standard-modal').modal('show');
    });
    $(document).on('click', '.addToWidget', function () {
        var widgetname = $(this).data('widgetname');
        var widgetvalue = $(this).data('widgetvalue');
        var visibility = 0; // default zero

        var widgetDynamicID = $("#widgetDynamicID").val();
        $("#widgetName" + widgetDynamicID).val(widgetname);
        $("#widgetValue" + widgetDynamicID).val(widgetvalue);
        $("#visibility" + widgetDynamicID).val(visibility);

        $("#WidgetLabelName" + widgetDynamicID).html(widgetname);
        $('#standard-modal').modal('hide');
    });

    $('#addDynamicFilter').on('submit', function (e) {
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
                console.log(response);
                if (response.code == 200) {
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
            }
        });
    });
    // rules validation
    $("#attendanceFilter").validate({
        rules: {
            att_widget_name: "required"
        }
    });
    $('#attendanceFilter').on('submit', function (e) {
        e.preventDefault();
        var employeeCheck = $("#attendanceFilter").valid();
        if (employeeCheck === true) {
            var widgetDynamicID = $("#widgetDynamicID").val();
            var att_widget_name = $("#att_widget_name").val();
            var department_id = $("#department_id").val();
            var class_id = $("#changeClassName").val();
            var section_id = $("#sectionID").val();
            var pattern = $("#pattern").val();
            var atOrderNo = $("#atOrderNo").val();
            var attwidgetValue = $("#attwidgetValue").val();
            var department_name = $("#department_id option:selected").text();
            var class_name = $("#changeClassName option:selected").text();
            var section_name = $("#sectionID option:selected").text();
            var pattern_name = $("#pattern option:selected").text();
            var visibility = 0; // default zero
            var addAttText = AttendanceReportLabel;
            var combinetext = att_widget_name;
            if (department_name && (department_id != "")) {
                combinetext += "," + department_name;
            }

            if (class_name && (class_id != "")) {
                combinetext += "," + class_name;
            }

            if (section_name && (section_id != "")) {
                combinetext += "," + section_name;
            }

            if (pattern_name && (pattern != "")) {
                combinetext += "," + pattern_name;
            }
            addAttText += '(' + combinetext + ')';
            $("#WidgetLabelName" + widgetDynamicID).html(addAttText);
            // $("#orderNo" + widgetDynamicID).val(atOrderNo);
            $("#widgetName" + widgetDynamicID).val(addAttText);
            $("#widgetValue" + widgetDynamicID).val(attwidgetValue);
            $("#visibility" + widgetDynamicID).val(visibility);

            $("#departmentID" + widgetDynamicID).val(department_id);
            $("#classID" + widgetDynamicID).val(class_id);
            $("#sectionID" + widgetDynamicID).val(section_id);
            $("#patternName" + widgetDynamicID).val(pattern);
            $('#standard-modal').modal('hide');
            $('#attendance-modal').modal('hide');
        }
    });
});