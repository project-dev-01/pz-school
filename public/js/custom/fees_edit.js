$(function () {

    // change tab
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href") // activated tab

        $(".payment_mode").prop("disabled", true);
        $(".payment_clear").hide();
        $(".payment_mode").val('');
        // alert(target);
        $('.currentCheckBox').prop('checked', false);
        var amount = $('ul#apptabs li a.active').parent().data('paid_amount');
        var feesType = $('ul#apptabs li a.active').parent().attr('id');
        var allocation_id = $('ul#apptabs li a.active').parent().data('allocation_id');
        var fees_group_id = $('ul#apptabs li a.active').parent().data('fees_group_id');
        var payment_mode_id = $('ul#apptabs li a.active').parent().data('payment_mode_id');
        var studentID = $("#studentID").val();
        var academicYear = $("#academicYear").val();
        var formData = new FormData();
        formData.append('token', token);
        formData.append('branch_id', branchID);
        formData.append('payment_mode', payment_mode_id);
        formData.append('fees_group_id', fees_group_id);
        formData.append('fees_type', feesType);
        formData.append('allocation_id', allocation_id);
        formData.append('student_id', studentID);
        formData.append('academic_session_id', academicYear);
        $.ajax({
            url: activeTabDetails,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {
                    var getStudentData = response.data.fees_payment_details;
                    if (getStudentData.length > 0) {
                        $.each(getStudentData, function (key, val) {
                            $(".payment_mode").prop("disabled", true);
                            $(".payment_mode").val(val.payment_mode_id);
                            $(".payment_mode_onload").val(val.payment_mode_id);
                            $(".payment_" + payment_mode_id).show();

                            var date = (val.date ? val.date : "");
                            var payment_status_id = (val.payment_status_id ? val.payment_status_id : "");
                            var payingAmt = 0;
                            if (val.assign_amount) {
                                payingAmt = parseFloat(val.assign_amount).toFixed(2);
                            } else if (val.amount) {
                                payingAmt = val.amount;
                            } else {
                                payingAmt = parseFloat(0).toFixed(2);
                            }
                            var remarks = (val.remarks ? val.remarks : "");
                            var fg_id = (val.fg_id ? val.fg_id : "");
                            if (val.payment_mode_id == 1) {
                                $("#yearDate").val(date);
                                $("#yearPaySts").val(payment_status_id);
                                $("#yearAmt").val(payingAmt);
                                $("#yearMemo").val(remarks);
                                $("#yearFeesGroupDetailsID").val(fg_id);
                            }
                            if (val.payment_mode_id == 2) {
                                if (val.date) {
                                    $('.isChecked_' + val.semester).prop('checked', true);
                                    $('.checkbx_' + val.semester).prop('disabled', false);
                                } else {
                                    $('.isChecked_' + val.semester).prop('checked', false);
                                    $('.checkbx_' + val.semester).prop('disabled', true);
                                }
                                $("#semesterDate" + val.semester).val(date);
                                $("#semesterPaySts" + val.semester).val(payment_status_id);
                                $("#semesterPayAmt" + val.semester).val(payingAmt);
                                $("#semesterMemo" + val.semester).val(remarks);
                                $("#semesterFeesGroupDetailsID" + val.semester).val(fg_id);
                            }
                            if (val.payment_mode_id == 3) {
                                if (val.date) {
                                    $('.isChecked_' + val.monthly).prop('checked', true);
                                    $('.checkbx_' + val.monthly).prop('disabled', false);
                                } else {
                                    $('.isChecked_' + val.semester).prop('checked', false);
                                    $('.checkbx_' + val.semester).prop('disabled', true);
                                }
                                $("#monthDate" + val.monthly).val(date);
                                $("#monthPaySts" + val.monthly).val(payment_status_id);
                                $("#monthPayAmt" + val.monthly).val(payingAmt);
                                $("#monthMemo" + val.monthly).val(remarks);
                                $("#monthFeesGroupDetailsID" + val.monthly).val(fg_id);
                            }
                        });
                    }
                }
            }
        });
    });
    $(".date-picker").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
    });
    // edit Fees Form
    $('#editFeesForm').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        var feesType = $('ul#apptabs li a.active').parent().attr('id');
        var allocation_id = $('ul#apptabs li a.active').parent().data('allocation_id');
        var fees_group_id = $('ul#apptabs li a.active').parent().data('fees_group_id');
        // var paid_amount = $('ul#apptabs li a.active').parent().data('paid_amount');
        // return false;
        var formData = new FormData(form);
        formData.append('fees_type', feesType);
        formData.append('allocation_id', allocation_id);
        formData.append('fees_group_id', fees_group_id);
        // formData.append('paid_amount', paid_amount);
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (data) {
                if (data.code == 200) {
                    toastr.success(data.message);
                    location.reload();
                } else {
                    toastr.error(data.message);
                }
            }
        });
    });
    // script for all checkbox checked / unchecked
    $("#selectAllSemester").on("change", function (ev) {
        var $chcks = $(".semester-checked-area input[type='checkbox']");

        if ($(this).is(':checked')) {
            $chcks.prop('checked', true).trigger('change');
        } else {
            $chcks.prop('checked', false).trigger('change');
        }
    });
    $("#selectAllMonth").on("change", function (ev) {
        var $chcks = $(".month-checked-area input[type='checkbox']");

        if ($(this).is(':checked')) {
            $chcks.prop('checked', true).trigger('change');
        } else {
            $chcks.prop('checked', false).trigger('change');
        }
    });
    $(document).on('change', '.currentCheckBox', function () {
        var chkbxID = $(this).attr('id');
        if ($(this).prop('checked') == false) {
            $('.checkbx_' + chkbxID).prop('disabled', true);
        } else {
            $('.checkbx_' + chkbxID).prop('disabled', false);
        }

    });

    getSelectedTabText();
    function getSelectedTabText() {
        $(".payment_clear").hide();
        $(".payment_mode").val('');
        // alert(target);
        $('.currentCheckBox').prop('checked', false);
        var amount = $('ul#apptabs li a.active').parent().data('paid_amount');
        var feesType = $('ul#apptabs li a.active').parent().attr('id');
        var allocation_id = $('ul#apptabs li a.active').parent().data('allocation_id');
        var fees_group_id = $('ul#apptabs li a.active').parent().data('fees_group_id');
        var payment_mode_id = $('ul#apptabs li a.active').parent().data('payment_mode_id');

        var studentID = $("#studentID").val();
        var academicYear = $("#academicYear").val();

        var formData = new FormData();
        formData.append('token', token);
        formData.append('branch_id', branchID);
        formData.append('payment_mode', payment_mode_id);
        formData.append('fees_group_id', fees_group_id);
        formData.append('fees_type', feesType);
        formData.append('allocation_id', allocation_id);
        formData.append('student_id', studentID);
        formData.append('academic_session_id', academicYear);
        $.ajax({
            url: activeTabDetails,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                console.log("response")
                console.log(response)
                console.log(payment_mode_id)
                if (response.code == 200) {
                    var getStudentData = response.data.fees_payment_details;
                    if (getStudentData.length > 0) {
                        $.each(getStudentData, function (key, val) {
                            $(".payment_mode").prop("disabled", true);
                            $(".payment_mode").val(val.payment_mode_id);
                            $(".payment_mode_onload").val(val.payment_mode_id);
                            $(".payment_" + payment_mode_id).show();

                            var date = (val.date ? val.date : "");
                            var payment_status_id = (val.payment_status_id ? val.payment_status_id : "");
                            var payingAmt = 0;
                            if (val.assign_amount) {
                                payingAmt = parseFloat(val.assign_amount).toFixed(2);
                            } else if (val.amount) {
                                payingAmt = val.amount;
                            } else {
                                payingAmt = parseFloat(0).toFixed(2);
                            }
                            var remarks = (val.remarks ? val.remarks : "");
                            var fg_id = (val.fg_id ? val.fg_id : "");

                            if (val.payment_mode_id == 1) {
                                $("#yearDate").val(date);
                                $("#yearPaySts").val(payment_status_id);
                                $("#yearAmt").val(payingAmt);
                                $("#yearMemo").val(remarks);
                                $("#yearFeesGroupDetailsID").val(fg_id);
                            }
                            if (val.payment_mode_id == 2) {
                                if (val.date) {
                                    $('.isChecked_' + val.semester).prop('checked', true);
                                    $('.checkbx_' + val.semester).prop('disabled', false);
                                } else {
                                    $('.isChecked_' + val.semester).prop('checked', false);
                                    $('.checkbx_' + val.semester).prop('disabled', true);
                                }
                                $("#semesterDate" + val.semester).val(date);
                                $("#semesterPaySts" + val.semester).val(payment_status_id);
                                $("#semesterPayAmt" + val.semester).val(payingAmt);
                                $("#semesterMemo" + val.semester).val(remarks);
                                $("#semesterFeesGroupDetailsID" + val.semester).val(fg_id);
                            }
                            if (val.payment_mode_id == 3) {
                                if (val.date) {
                                    $('.isChecked_' + val.monthly).prop('checked', true);
                                    $('.checkbx_' + val.monthly).prop('disabled', false);
                                } else {
                                    $('.isChecked_' + val.semester).prop('checked', false);
                                    $('.checkbx_' + val.semester).prop('disabled', true);
                                }
                                $("#monthDate" + val.monthly).val(date);
                                $("#monthPaySts" + val.monthly).val(payment_status_id);
                                $("#monthPayAmt" + val.monthly).val(payingAmt);
                                $("#monthMemo" + val.monthly).val(remarks);
                                $("#monthFeesGroupDetailsID" + val.monthly).val(fg_id);
                            }
                        });
                    }
                }
            }
        });
    }

});