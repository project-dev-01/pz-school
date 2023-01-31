$(function () {
    
    // change tab
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href") // activated tab
                                
        $(".payment_mode").prop("disabled", false); 
        $(".payment_clear").hide();
        $(".payment_mode").val('');
        // alert(target);
        
        // console.log('cd', payment_mode_id)
        var amount = $('ul#apptabs li a.active').parent().data('paid_amount');
        var feesType = $('ul#apptabs li a.active').parent().attr('id');
        var allocation_id = $('ul#apptabs li a.active').parent().data('allocation_id');
        var studentID = $("#studentID").val();
        var academicYear = $("#academicYear").val();
        var formData = new FormData();
        formData.append('token', token);
        formData.append('branch_id', branchID);
        // formData.append('payment_mode', payment_mode_id);
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
                    var getStudentData = response.data;
                    if (getStudentData.length > 0) {
                        $.each(getStudentData, function (key, val) {
                            if (val.payment_mode_id) {
                                
                                var payment_mode_id = val.payment_mode_id;
                                $(".payment_mode").prop("disabled", true);  
                                
                                $(".payment_mode").val(val.payment_mode_id);
                                $(".payment_" + payment_mode_id).show();
                                

                                var date = (val.date ? val.date : "");
                                var payment_status_id = (val.payment_status_id ? val.payment_status_id : "");
                                var amount = (val.amount ? val.amount : "");
                                if (val.payment_mode_id == 1) {
                                    $("#yearDate").val(date);
                                    $("#yearPaySts").val(payment_status_id);
                                    $("#yearAmt").val(amount);
                                }
                                if (val.payment_mode_id == 2) {
                                    $("#semesterDate" + val.semester).val(date);
                                    $("#semesterPaySts" + val.semester).val(payment_status_id);
                                    $("#semesterPayAmt" + val.semester).val(amount);
                                }
                                if (val.payment_mode_id == 3) {
                                    $("#monthDate" + val.monthly).val(date);
                                    $("#monthPaySts" + val.monthly).val(payment_status_id);
                                    $("#monthPayAmt" + val.monthly).val(amount);
                                }
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
    });
    $(".payment_mode").on('change', function (e) {
        e.preventDefault();
        $(".payment_clear").hide();
        var payment_mode_id = $(this).val();
        $(".payment_" + payment_mode_id).show();
        console.log('cd', payment_mode_id)
        var amount = $('ul#apptabs li a.active').parent().data('paid_amount');
        var feesType = $('ul#apptabs li a.active').parent().attr('id');
        var allocation_id = $('ul#apptabs li a.active').parent().data('allocation_id');
        var studentID = $("#studentID").val();
        var academicYear = $("#academicYear").val();
        var formData = new FormData();
        formData.append('token', token);
        formData.append('branch_id', branchID);
        formData.append('payment_mode', payment_mode_id);
        formData.append('fees_type', feesType);
        formData.append('allocation_id', allocation_id);
        formData.append('student_id', studentID);
        formData.append('academic_session_id', academicYear);
        var payingAmt = 0;
        // yearly
        if (payment_mode_id == "1") {
            payingAmt = amount;
        }
        // semester
        if (payment_mode_id == "2") {
            payingAmt = amount / 3;
        }
        // monthly
        if (payment_mode_id == "3") {
            payingAmt = amount / 12;
        }
        $(".fees_amount_" + payment_mode_id).val(payingAmt.toFixed(2));
        $.ajax({
            url: changePaymentModeUrl,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {
                    var getStudentData = response.data;
                    if (getStudentData.length > 0) {
                        $.each(getStudentData, function (key, val) {
                            if (val.payment_mode_id) {
                                var date = (val.date ? val.date : "");
                                var payment_status_id = (val.payment_status_id ? val.payment_status_id : "");
                                var amount = (val.amount ? val.amount : "");
                                if (val.payment_mode_id == 1) {
                                    $("#yearDate").val(date);
                                    $("#yearPaySts").val(payment_status_id);
                                    $("#yearAmt").val(amount);
                                }
                                if (val.payment_mode_id == 2) {
                                    $("#semesterDate" + val.semester).val(date);
                                    $("#semesterPaySts" + val.semester).val(payment_status_id);
                                    $("#semesterPayAmt" + val.semester).val(amount);
                                }
                                if (val.payment_mode_id == 3) {
                                    $("#monthDate" + val.monthly).val(date);
                                    $("#monthPaySts" + val.monthly).val(payment_status_id);
                                    $("#monthPayAmt" + val.monthly).val(amount);
                                }
                            }
                        });
                    } else {
                        if (payment_mode_id == 1) {
                            $("#yearDate").val("");
                            $("#yearPaySts").val("");
                        }
                        if (payment_mode_id == 2) {
                            for (let i = 1; i <= 3; i++) {
                                $("#semesterDate" + i).val("");
                                $("#semesterPaySts" + i).val("");
                            }
                        }
                        if (payment_mode_id == 3) {
                            for (let i = 1; i <= 12; i++) {
                                $("#monthDate" + i).val("");
                                $("#monthPaySts" + i).val("");
                            }
                        }
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
        // var paid_amount = $('ul#apptabs li a.active').parent().data('paid_amount');
        // console.log(allocation_id);
        // return false;
        var formData = new FormData(form);
        formData.append('fees_type', feesType);
        formData.append('allocation_id', allocation_id);
        // formData.append('paid_amount', paid_amount);
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (data) {
                console.log("------")
                console.log(data)
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
        
        // console.log('cd', payment_mode_id)
        var amount = $('ul#apptabs li a.active').parent().data('paid_amount');
        var feesType = $('ul#apptabs li a.active').parent().attr('id');
        var allocation_id = $('ul#apptabs li a.active').parent().data('allocation_id');
        var studentID = $("#studentID").val();
        var academicYear = $("#academicYear").val();
        var formData = new FormData();
        formData.append('token', token);
        formData.append('branch_id', branchID);
        // formData.append('payment_mode', payment_mode_id);
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
                    var getStudentData = response.data;
                    if (getStudentData.length > 0) {
                        $.each(getStudentData, function (key, val) {
                            if (val.payment_mode_id) {
                                
                                var payment_mode_id = val.payment_mode_id;
                                
                                $(".payment_mode").prop("disabled", true);  
                                $(".payment_mode").val(val.payment_mode_id);
                                $(".payment_" + payment_mode_id).show();

                                var date = (val.date ? val.date : "");
                                var payment_status_id = (val.payment_status_id ? val.payment_status_id : "");
                                var amount = (val.amount ? val.amount : "");
                                if (val.payment_mode_id == 1) {
                                    $("#yearDate").val(date);
                                    $("#yearPaySts").val(payment_status_id);
                                    $("#yearAmt").val(amount);
                                }
                                if (val.payment_mode_id == 2) {
                                    $("#semesterDate" + val.semester).val(date);
                                    $("#semesterPaySts" + val.semester).val(payment_status_id);
                                    $("#semesterPayAmt" + val.semester).val(amount);
                                }
                                if (val.payment_mode_id == 3) {
                                    $("#monthDate" + val.monthly).val(date);
                                    $("#monthPaySts" + val.monthly).val(payment_status_id);
                                    $("#monthPayAmt" + val.monthly).val(amount);
                                }
                            }
                        });
                    }
                }
            }
        });
    }
    
});