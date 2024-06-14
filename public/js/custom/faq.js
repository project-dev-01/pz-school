$(function () {
    function openJSKL() {
        // Get a token from the endpoint
        $.ajax({
            url: "https://jskl.jessesoo4148.workers.dev/token",
            headers: {
                Authorization: "Basic anNrbC1icmlkZ2UtYXNpYTpmYzk0ZTA2ZTg2ZGVjNTJmMDI1OWI1Mzc="
            },
            method: "GET"
        }).done(function(token) {
            // Use the token to fetch content
            $.ajax({
                url: "https://jskl.jessesoo4148.workers.dev/proxy",
                data: {
                    token: token,
                    proxyUrl: "https://jskl.r-cms.jp/download/"
                },
                method: "GET"
            }).done(function(html) {
                // Open a new window
                var newWindow = window.open();
                newWindow.document.open();
                newWindow.document.write(html);
                newWindow.document.close();
            });
        });
    }

    // Bind the click event to the link
    $('#new-question-link').click(function() {
        openJSKL();
    });
    // rules validation
    $("#sendFaqMail").validate({
        rules: {
            subject: "required",
        }
    });

    $('#sendFaqMail').on('submit', function (e) {
        e.preventDefault();

        var Check = $("#sendFaqMail").valid();
        if (Check === true) {

            $('#faq-mail').modal('hide');
            $("#overlay").fadeIn(300);
            var email = $("#email").val();
            var name = $("#name").val();
            var role_name = $("#role_name").val();
            var subject = $("#subject").val();
            var remarks = $("#remarks").val();
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('role_name', role_name);
            formData.append('name', name);
            formData.append('email', email);
            formData.append('remarks', remarks);
            formData.append('subject', subject);
            formData.append('school_name', schoolName);

            var form = this;
            $.ajax({
                url: faqEmail,
                method: $(form).attr('method'),
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        toastr.success(data.message);
                        $("#overlay").fadeOut(300);
                        $('#faq-mail').find('form')[0].reset();
                    } else {
                        toastr.error(data.message);
                        $("#overlay").fadeOut(300);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                    $("#overlay").fadeOut(300);
                }
            });
        }
    });

});