$(function () {
    
    $('.select2-multiple-plus').select2();
    var selectedtopic;
    $("#createpostForum").validate({
        rules: {
            inputTopicTitle: "required",
            inputTopicHeader: "required",
            tpbody: "required",
            category: "required"
        }
    });
    // create post forum
    $("#createpostForum").on('submit', function (e) {
        e.preventDefault();
        console.log('hellosss');
        var cpostCheck = $("#createpostForum").valid();
        if (cpostCheck === true) {
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    // console.log("------")
                    console.log(data)
                    if (data.code == 200) {

                        toastr.success(data.message);
                        $('#createpostForum')[0].reset();
                        location.reload();
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    $("#updatepostForum").validate({
        rules: {
            inputTopicTitle: "required",
            inputTopicHeader: "required",
            tpbody: "required",
            category: "required"
        }
    });
    // update post forum
    $("#updatepostForum").on('submit', function (e) {
        e.preventDefault();
        console.log('hellosss');
        var cpostCheck = $("#updatepostForum").valid();
        if (cpostCheck === true) {
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    // console.log("------")
                    console.log(data)
                    if (data.code == 200) {

                        toastr.success(data.message);
                        $('#updatepostForum')[0].reset();
                        setTimeout(function () {
                            window.location.href = indexPost;
                        }, 1000);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    (function () {
        var ttJsActiveBtn = $('#tt-pageContent .tt-js-active-btn');
        if (ttJsActiveBtn.length) {
            ttJsActiveBtn.on('click', '.tt-button-icon', function (e) {
                selectedtopic = $(this).text();
                $("#topictype").val(selectedtopic);
                return false;
            });
        };
    })();

    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
        $('#inputTopicTags').keyup(function () {
            var query = $(this).val();
            if (query != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: userautocomplete,
                    method: "POST",
                    data: { query: query, token: token },
                    success: function (data) {
                        $('#userlist').fadeIn();
                        $('#userlist').html(data);
                    }
                });
            }
        });

        $(document).on('click', 'li', function () {
            $('#inputTopicTags').val($(this).text());
            $('#userlist').fadeOut();
        });

        $('#search_data').tokenfield({
            autocomplete: {
                source: function (request, response) {
                    console.log('hai');
                    jQuery.post(userautocomplete, {
                        query: request.term, token: token
                    }, function (data) {
                        data = JSON.parse(data);
                        response(data);
                    });
                },
                delay: 100
            }
        });

        $("#selectedusers").on('change', function () {
            var selectedarry = $("#selectedusers").val();
            console.log(selectedarry);
            // var convertstr = selectedarry.toString();
            // console.log(convertstr);
             $("#tags").val(selectedarry);
           
            //console.log(get);
        });

    });

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function () {

        //   $( "#selUser" ).select2({
        //     ajax: { 
        //       url: userautocomplete,
        //       type: "post",
        //       dataType: 'json',
        //       delay: 250,
        //       data: function (params) {
        //         return {
        //           //_token: CSRF_TOKEN,
        //           token:token,
        //           search: params.term // search term
        //         };
        //       },
        //       processResults: function (response) {
        //         return {
        //           results: response
        //         };
        //       },
        //       cache: true
        //     }

        //   });

    });

    // delete form
    $(document).on('click', '#deletePostBtn', function () {
        var id = $(this).data('id');
        var url = deletePost;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Post',
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes, Delete',
            cancelButtonColor: '#d33',
            confirmButtonColor: '#556ee6',
            width: 400,
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                $.post(url, {
                    id: id,
                    token: token,
                }, function (data) {
                    if (data.code == 200) {
                        toastr.success(data.message);
                        setTimeout(function () {
                            window.location.href = indexPost;
                        }, 1000);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
   


});
