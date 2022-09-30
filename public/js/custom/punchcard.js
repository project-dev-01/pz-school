$(function () {
    var date = new Date();
    let value = `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`
    $(".date").text(value);

    var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    var dayName = days[date.getDay()];
    
    $(".day").text(dayName);
    $("#check_in").on('click', function (e) {
        e.preventDefault();

        
        var late = $('#check_in').val();
        if(late=="Late Check In") {

            $('.check_in_time').addClass("red");
        }

        // return false;
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


});