$(function () {

    var baseURL = "{{ URL::to('/') }}";
    $('#LoginAuth').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        // var Login = "http://localhost/school-management-system/public/api/login";
        console.log("hhjhj");
        var email = $("#email").val();
        var password = $("#password").val();
        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('email', email);
        formData.append('password', password);
        console.log("hhjhj");

        // Display the key/value pairs
        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }
        // return false;

        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            // headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},

            // data:new FormData(form),
            data: {
                email: email,
                password: password,
                _token: '{{csrf_token()}}'
            },
            // data: { "myObj": myObject, "_token": "{{ csrf_token() }}" },
            // data: formData,
            processData: false,
            // dataType: 'json',
            contentType: false,
            beforeSend: function () {
                $(form).find('span.error-text').text('');
            },
            success: function (data) {
                // $('#LoginAuth')[0].reset();
                console.log("******")
                console.log(data)
                // return false;
                // window.location.href = baseURL+"/dashboard";
                // window.location.href = "/dashboard";
                if (data.code == 0) {
                    console.log("inside zero")
                    console.log(data.error)
                    //   $.each(data.error, function(prefix, val){
                    //       $(form).find('span.'+prefix+'_error').text(val[0]);
                    //   });
                } else {
                    console.log("else zero")
                    //   $('#class-table').DataTable().ajax.reload(null, false);
                    //   $('.addClassModal').modal('hide');
                    //   $('.addClassModal').find('form')[0].reset();
                    //   toastr.success(data.msg);
                }
            }, error: function (err) {
                console.log("err" + JSON.stringify(err));
            }
        });
    });

});