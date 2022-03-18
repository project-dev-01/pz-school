$(function () {
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
                        location.reload();
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

});
