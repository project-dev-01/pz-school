$(function () {

    // change tab
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href") // activated tab

        $(".payment_mode").prop("disabled", false);
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
            // url: feesGetPayModeIdUrl,
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
                    // var amount_details = response.data.amount_details;
                    // var payingAmt = 0;
                    // if (amount_details) {
                    //     payingAmt = amount_details.paying_amount;
                    // }
                    // payingAmt = parseFloat(payingAmt).toFixed(2);
                    // $(".fees_amount_" + payment_mode_id).val(payingAmt);

                    if (getStudentData.length > 0) {
                        $.each(getStudentData, function (key, val) {
                            // if (val.payment_mode_id) {

                            //     var payment_mode_id = val.payment_mode_id;
                            // }
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
                            // var amount = (val.amount ? val.amount : "");
                            var remarks = (val.remarks ? val.remarks : "");
                            var fg_id = (val.fg_id ? val.fg_id : "");
                            // var amount = (val.amount ? val.amount : resAmt);

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
    $(".payment_mode").on('change', function (e) {
        e.preventDefault();
        // clear data
        $('form .initialEmpty').val('');
        $('.currentCheckBox').prop('checked', false);
        // $('.checkbx_' + val.semester).prop('disabled', true);
        $(".payment_clear").hide();
        var payment_mode_id = $(this).val();
        $(".payment_" + payment_mode_id).show();
        var amount = $('ul#apptabs li a.active').parent().data('paid_amount');
        var feesType = $('ul#apptabs li a.active').parent().attr('id');
        var allocation_id = $('ul#apptabs li a.active').parent().data('allocation_id');
        var fees_group_id = $('ul#apptabs li a.active').parent().data('fees_group_id');
        var studentID = $("#studentID").val();
        var academicYear = $("#academicYear").val();
        var formData = new FormData();
        formData.append('token', token);
        formData.append('branch_id', branchID);
        formData.append('payment_mode', payment_mode_id);
        formData.append('fees_type', feesType);
        formData.append('fees_group_id', fees_group_id);
        formData.append('allocation_id', allocation_id);
        formData.append('student_id', studentID);
        formData.append('academic_session_id', academicYear);
        // // yearly
        // if (payment_mode_id == "1") {
        //     payingAmt = amount;
        // }
        // // semester
        // if (payment_mode_id == "2") {
        //     payingAmt = amount / 3;
        // }
        // // monthly
        // if (payment_mode_id == "3") {
        //     payingAmt = amount / 12;
        // }
        // $(".fees_amount_" + payment_mode_id).val(payingAmt.toFixed(2));
        $.ajax({
            url: changePaymentModeUrl,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {
                    var getStudentData = response.data.fees_payment_details;
                    var amount_details = response.data.amount_details;
                    // var semester_count = response.data.amount_details;
                    if (getStudentData.length > 0) {
                        // assign fees amount
                        var i = 0;
                        $.each(getStudentData, function (key, val) {
                            if (val.payment_mode_id) {
                                var date = (val.date ? val.date : "");
                                var payment_status_id = (val.payment_status_id ? val.payment_status_id : "");
                                var amount = (val.amount ? val.amount : "");
                                var fg_id = (val.fg_id ? val.fg_id : "");
                                if (val.payment_mode_id == 1) {
                                    $("#yearDate").val(date);
                                    $("#yearPaySts").val(payment_status_id);
                                    $("#yearAmt").val(amount);
                                    $("#yearFeesGroupDetailsID").val(fg_id);
                                }
                                if (val.payment_mode_id == 2) {
                                    // check default checked
                                    // $('.isChecked_' + val.semester).prop('checked', false);
                                    // $('.checkbx_' + val.semester).prop('disabled', true);
                                    $("#semesterDate" + val.semester).val(date);
                                    $("#semesterPaySts" + val.semester).val(payment_status_id);
                                    $("#semesterPayAmt" + val.semester).val(amount);
                                    $("#semesterFeesGroupDetailsID" + val.semester).val(fg_id);
                                }
                                if (val.payment_mode_id == 3) {
                                    // // check default checked
                                    // $('.isChecked_' + val.semester).prop('checked', false);
                                    // $('.checkbx_' + val.semester).prop('disabled', true);
                                    $("#monthDate" + val.monthly).val(date);
                                    $("#monthPaySts" + val.monthly).val(payment_status_id);
                                    $("#monthPayAmt" + val.monthly).val(amount);
                                    $("#monthFeesGroupDetailsID" + val.monthly).val(fg_id);
                                }
                                // if (val.date) {
                                //     $('.isChecked_' + val.monthly).prop('checked', true);
                                //     $('.checkbx_' + val.monthly).prop('disabled', false);
                                // }
                            }
                        });
                    } else {
                        // if (payment_mode_id == 1) {
                        //     $("#yearDate").val("");
                        //     $("#yearPaySts").val("");
                        //     // $('input[name="fees[1][amount]"]').val("");
                        // }
                        // if (payment_mode_id == 2) {
                        //     for (let i = 1; i <= semester_count; i++) {
                        //         $("#semesterDate" + i).val("");
                        //         $("#semesterPaySts" + i).val("");
                        //         // $('input[name="fees[2][' + i + '][amount]"]').val("");
                        //     }
                        // }
                        // if (payment_mode_id == 3) {
                        //     for (let i = 1; i <= 12; i++) {
                        //         $("#monthDate" + i).val("");
                        //         $("#monthPaySts" + i).val("");
                        //         // $('input[name="fees[3][' + i + '][amount]"]').val("");
                        //     }
                        // }
                        if (amount_details.length > 0) {
                            $.each(amount_details, function (key, val) {
                                var paying_amount = (val.paying_amount ? val.paying_amount : 0);
                                var paymode_id = (val.payment_mode_id ? val.payment_mode_id : 0);
                                var semester = (val.semester ? val.semester : 0);
                                var monthly = (val.monthly ? val.monthly : 0);
                                var payingAmt = parseFloat(paying_amount).toFixed(2);
                                var fg_id = (val.fg_id ? val.fg_id : "");
                                if (paymode_id == 1) {
                                    $('input[name="fees[1][amount]"]').val(parseFloat(payingAmt).toFixed(2));
                                    $("#yearFeesGroupDetailsID").val(fg_id);
                                }
                                if (paymode_id == 2) {
                                    $('input[name="fees[2][' + semester + '][amount]"]').val(parseFloat(payingAmt).toFixed(2));
                                    $("#semesterFeesGroupDetailsID" + semester).val(fg_id);
                                    $('.isChecked_' + semester).prop('checked', false);
                                    $('.checkbx_' + semester).prop('disabled', true);
                                }
                                if (paymode_id == 3) {
                                    $('input[name="fees[3][' + monthly + '][amount]"]').val(parseFloat(payingAmt).toFixed(2));
                                    $("#monthFeesGroupDetailsID" + monthly).val(fg_id);
                                    $('.isChecked_' + semester).prop('checked', false);
                                    $('.checkbx_' + semester).prop('disabled', true);
                                }
                                // var payingAmt = 0;
                                // payingAmt = parseFloat(payingAmt).toFixed(2);
                            });
                        } else {
                            // $('#editFeesForm')[0].reset();
                            $('form .initialEmpty').val('');
                            // $('form .currentCheckBox').prop('checked', false);
                            // $('form :input').val('');
                            // $('.fees_amount_emp').prop('selectedIndex',0);
                        }
                        // $('input[name="fees[1][amount]"]').val(1000);
                        // $('input[name="fees[2][1][amount]"]').val(2000);
                        // $('input[name="fees[2][2][amount]"]').val(3000);
                        // $('input[name="fees[2][3][amount]"]').val(4000);

                        // if no payment amount default amount come
                        // var payingAmt = 0;
                        // if (amount_details.paying_amount) {
                        //     payingAmt = amount_details.paying_amount;
                        // }
                        // payingAmt = parseFloat(payingAmt).toFixed(2);
                        // $(".fees_amount_" + payment_mode_id).val(payingAmt);
                    }
                }
            }
        });

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
            $('.checkbx_' + chkbxID).prop('disabled', true);
        } else {
            $('.checkbx_' + chkbxID).prop('disabled', false);
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
            // url: feesGetPayModeIdUrl,
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
                    // var amount_details = response.data.amount_details;
                    // var payingAmt = 0;
                    // if (amount_details) {
                    //     payingAmt = amount_details.paying_amount;
                    // }
                    // payingAmt = parseFloat(payingAmt).toFixed(2);
                    // $(".fees_amount_" + payment_mode_id).val(payingAmt);

                    if (getStudentData.length > 0) {
                        $.each(getStudentData, function (key, val) {
                            // if (val.payment_mode_id) {

                            //     var payment_mode_id = val.payment_mode_id;
                            // }
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
                            // var amount = (val.amount ? val.amount : "");
                            var remarks = (val.remarks ? val.remarks : "");
                            var fg_id = (val.fg_id ? val.fg_id : "");
                            // var amount = (val.amount ? val.amount : resAmt);

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