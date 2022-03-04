$(function () {
    // like count
    $('#likes-iconhit').on('click', function (e) {
        e.preventDefault();
        var id = $("#hdpkcount_details_id").text();
        console.log(id);
        $.post(likescount, { id: id, token: token }, function (res) {
            if (res.code == 200) {
                $('.inclike').text(res.data[0].likes);
            }
        }, 'json');
    });
    // dislike count
    $('#dislikes-iconhit').on('click', function (e) {
        e.preventDefault();
        var id = $("#hdpkcount_details_id").text();
        $.post(dislikescount, { id: id, token: token }, function (res) {
            if (res.code == 200) {
                $('.incdislike').text(res.data[0].dislikes);
            }
        }, 'json');
    });
    // heart count
    $('#heart-iconhit').on('click', function (e) {
        e.preventDefault();
        var id = $("#hdpkcount_details_id").text();
        $.post(heart, { id: id, token: token }, function (res) {
            if (res.code == 200) {
                $('.incheart').text(res.data[0].favorite);
            }
        }, 'json');
    });

    // replies command insert 
    $('#postreplie').on('click', function (e) {
        e.preventDefault();
        var create_post_id = $("#hdpk_post_id").text();
        var replies_com = $("#repliesinput").val();
        console.log(replies_com);
        $.post(repliesforpost, { token: token, branch_id: branch_id, user_id: user_id, user_name: user_name, create_post_id: create_post_id, replies_com: replies_com }, function (res) {
            if (res.code == 200) {
                toastr.success(res.message);
                console.log(res);
                $("#repliesjsvs").find("#repliesapply").append(
                    '<div class="tt-single-topic">' +
                    '<div class="tt-item-header pt-noborder">' +
                    '<div class="tt-item-info info-top">' +
                    '<div class="tt-avatar-icon">' +
                    '<i class="tt-icon"><img src="' + defaultImg + '" class="mr-2 rounded-circle" height="40" /></i>' +
                    '</div>' +
                    '<div class="tt-avatar-title">' +
                    '<a href="#">' + res.data[1] + '</a>' +
                    '</div>' +
                    '<a href="#" class="tt-info-time">' +
                    '<i class="tt-icon"><svg>' +
                    '<use xlink:href="#icon-time"></use>' +
                    '</svg></i>18 Jan,2022' +
                    '</a>' +
                    '</div>' +
                    '</div>' +
                    '<div class="tt-item-description">' +
                    '' + res.data[3] + '' +
                    '</div>' +
                    '<div class="tt-item-info info-bottom">' +
                    '<a href="#" class="tt-icon-btn">' +
                    '<i class="tt-icon"><svg>' +
                    '<use xlink:href="#icon-like"></use>' +
                    '</svg></i>' +
                    '<span class="tt-text">0</span>' +
                    '</a>' +
                    '<a href="#" class="tt-icon-btn">' +
                    '<i class="tt-icon"><svg>' +
                    '<use xlink:href="#icon-dislike"></use>' +
                    '</svg></i>' +
                    '<span class="tt-text">0</span>' +
                    '</a>' +
                    '<a href="#" class="tt-icon-btn">' +
                    '<i class="tt-icon"><svg>' +
                    '<use xlink:href="#icon-favorite"></use>' +
                    '</svg></i>' +
                    '<span class="tt-text">0</span>' +
                    '</a>' +
                    '<div class="col-separator"></div>' +
                    '<a href="#" class="tt-icon-btn tt-hover-02 tt-small-indent">' +
                    '<i class="tt-icon"><svg>' +
                    '' +
                    '</svg></i>' +
                    '</a>' +
                    '<a href="#" class="tt-icon-btn tt-hover-02 tt-small-indent">' +
                    '<i class="tt-icon"><svg>' +
                    '' +
                    '</svg></i>' +
                    '</a>' +
                    '<a href="#" class="tt-icon-btn tt-hover-02 tt-small-indent">' +
                    '<i class="tt-icon"><svg>' +
                    '' +
                    '</svg></i>' +
                    '</a>' +
                    '</div>' +
                    '</div>' +
                    '</div>'
                );

                $("#repliesinput").empty();
            } else {
                toastr.error(res.message);
            }
        }, 'json');
    });
    // replies like count
    $('.rep-likes-iconhit').on('click', function (e) {
        e.preventDefault();
        var incre_class = $(this).data("id");
        var id = $("#hdpk_replies_count_id").text();
        var create_post_id = $("#hdpk_post_id").text();
        var created_post_replies_id = $("#hdpk_replies_id").text(); 
        var likes=1; 
            console.log('replies only like insert');
            console.log(incre_class);
            $.post(replikescount, { token: token,create_post_id:create_post_id,created_post_replies_id:incre_class,user_id:user_id,user_name:user_name,branch_id:branch_id,likes:likes }, function (res) {
                if (res.code == 200) {
                    console.log(res);
                    $('.repinclikes'+incre_class).text(res.data[0].likes);
                }
            }, 'json');
    });
  
});

// insert 1st like on particular post
$(window).on('load', function () {
    var id = $("#hdpkcount_details_id").text();
    var create_post_id = $("#hdpk_post_id").text();
    console.log('onloaded');
    if (id === '') {
        var views = "1";
        console.log('insert');
        // insert
        $.post(insertviewfirstcount, { token: token, branch_id: branch_id, user_id: user_id, user_name: user_name, create_post_id: create_post_id, views: views }, function (res) {
            if (res.code == 200) {
                $('.incviews').text(res.data[0].views);
                $('#hdpkcount_details_id').text(res.data[0].id);
            }
        }, 'json');
    }
    else {
        console.log('view');
        $.post(viewscount, { id: id, token: token }, function (res) {
            if (res.code == 200) {
                $('.incviews').text(res.data[0].views);
            }
        }, 'json');
    }
});
