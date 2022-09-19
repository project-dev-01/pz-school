$(function () {
    var date = new Date();
    let value = `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`
    $(".date").text(value);
    $("#check_in").on('click', function (e) {
        e.preventDefault();
        var check_in = 1;
        var session = $('#session').val();

        var formData = new FormData();
        formData.append('check_in', check_in);
        formData.append('session', session);
        $.ajax({
            url: punchcard,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (data) {
                if (data.code == 200) {
                    
                    $('#check_in').html(data.data.check_in);
                    $('#check_out').html(data.data.check_out);
                    
                    $('#check_in').prop('disabled', data.data.check_in_status);
                    $('#check_out').prop('disabled', data.data.check_out_status);

                    $('.check_in_time').html(data.data.check_in_time);
                    $('.check_out_time').html(data.data.check_out_time);
                    toastr.success("Checked In Successfully");
                }
            }
        });
    });

    $("#check_out").on('click', function (e) {
        e.preventDefault();
        var check_out = 1;
        var session = $('#session').val();

        var formData = new FormData();
        formData.append('check_out', check_out);
        formData.append('session', session);
        $.ajax({
            url: punchcard,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (data) {
                if (data.code == 200) {
                    
                    $('#check_in').html(data.data.check_in);
                    $('#check_out').html(data.data.check_out);
                    
                    $('#check_in').prop('disabled', data.data.check_in_status);
                    $('#check_out').prop('disabled', data.data.check_out_status);

                    $('.check_in_time').html(data.data.check_in_time);
                    $('.check_out_time').html(data.data.check_out_time);
                    toastr.success("Checked Out Successfully");
                }
            }
        });
    });

    
    // var date = new Date();
    // let value = `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`
    // $(".date").text(value);
    // console.log('sd',date)
    // $("#check_in").on('click', function (e) {
    //     e.preventDefault();
    //     var dt = new Date();
    //     var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
    //     $('.check_in_time').html(time);
    //     $('#check_in').prop('disabled', true);
    //     toastr.success("Checked In Successfully");
    // });

    // $("#check_out").on('click', function (e) {
    //     e.preventDefault();
        
    //     var dt = new Date();
    //     var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
    //     $('.check_out_time').html(time);
    //     $('#check_out').prop('disabled', true);
    //     toastr.success("Checked Out Successfully");
    // });


    // $("#punchCardLogin").validate({
    //     rules: {
    //         email: "required",
    //         password: "required",
    //     }
    // });
    // // add designation
    // $('#punchCardLogin').on('submit', function (e) {
    //     e.preventDefault();
    //     var filterCheck = $("#punchCardLogin").valid();
    //     if (filterCheck === true) {
    //         var form = this;
    //         var otp = $("#otp").val();
    //         if(otp==""){
    //             console.log('opt',otp)
    //             $.ajax({
    //                 url: getOtp,
    //                 method: "Post",
    //                 data: new FormData(form),
    //                 processData: false,
    //                 dataType: 'json',
    //                 contentType: false,
    //                 success: function (data) {
    //                     if (data.code == 200) {
    //                         console.log('otpresponse',data)
    
    //                     }
    //                 }
    //             });
    //         }else {var form = this;
    //             $.ajax({
    //                 url: $(form).attr('action'),
    //                 method: $(form).attr('method'),
    //                 data: new FormData(form),
    //                 processData: false,
    //                 dataType: 'json',
    //                 contentType: false,
    //                 success: function (data) {
    //                     if (data.code == 200) {
    //                         console.log('response',data)
    
    //                     }
    //                 }
    //             });
    //         }
    //         return false;
    //     }
    // });


});