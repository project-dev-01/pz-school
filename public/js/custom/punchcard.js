$(function () {
    // $("#class_id").on('change', function (e) {
    //     e.preventDefault();
    //     var class_id = $(this).val();

    //     $("#section_id").empty();
    //     $("#section_id").append('<option value="">Select Class Name</option>');
    //     $.post(sectionByClass, { class_id: class_id }, function (res) {
    //         if (res.code == 200) {
    //             $.each(res.data, function (key, val) {
    //                 $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
    //             });
    //         }
    //     }, 'json');
    // });

    // $("#getOtp").validate({
    //     rules: {
    //         email: "required",
    //         password: "required",
    //     }
    // });
    // // add designation
    // $('#getOtp').on('submit', function (e) {
    //     e.preventDefault();
    //     var filterCheck = $("#getOtp").valid();
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