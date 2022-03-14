$(function () {
    // like count
    $('#likes-iconhit').on('click', function (e) {
        e.preventDefault();
        var created_post_id = $("#hdpk_post_id").text();
        var id = $("#hdpkcount_details_id").text();
        console.log(created_post_id);
        var likes = 1;
        $.post(likescount, { token: token, created_post_id: created_post_id, user_id: user_id, user_name: user_name, branch_id: branch_id, likes: likes}, function (res) {
     //   $.post(likescount, { id: id, token: token }, function (res) {

            if (res.code == 200) {
                $('.inclike').text(res.data[0].likes);
            }
        }, 'json');
    });
    // dislike count
    $('#dislikes-iconhit').on('click', function (e) {
        e.preventDefault();
        var created_post_id = $("#hdpk_post_id").text();
        var id = $("#hdpkcount_details_id").text();
        dislikes =1;
        $.post(dislikescount, { token: token, created_post_id: created_post_id, user_id: user_id, user_name: user_name, branch_id: branch_id, dislikes: dislikes }, function (res) {
        //$.post(dislikescount, { id: id, token: token }, function (res) {
            if (res.code == 200) {
                $('.incdislike').text(res.data[0].dislikes);
            }
        }, 'json');
    });
    // heart count
    $('#heart-iconhit').on('click', function (e) {
        e.preventDefault();
        var created_post_id = $("#hdpk_post_id").text();
        var id = $("#hdpkcount_details_id").text();
        favorite=1;
        $.post(heart, { token: token, created_post_id: created_post_id, user_id: user_id, user_name: user_name, branch_id: branch_id, favorite: favorite }, function (res) {
        //$.post(heart, { id: id, token: token }, function (res) {
            if (res.code == 200) {
                $('.incheart').text(res.data[0].favorite);
            }
        }, 'json');
    });

    // replies command insert 
    $('#postreplie').on('submit', function (e) {
        e.preventDefault();
        var create_post_id = $("#hdpk_post_id").text();
        var replies_com = $("#repliesinput").val();
      //  var desc = CKEDITOR.instances['repliesinput'].getData();
      //  var desca = CKEDITOR.instances.repliesinput.getData();
      var ckval= myEditor.getData();   
        console.log(ckval);
        $.post(repliesforpost, { token: token, branch_id: branch_id, user_id: user_id, user_name: user_name, create_post_id: create_post_id, replies_com: replies_com }, function (res) {
            if (res.code == 200) {
                toastr.success(res.message);
                console.log(res);
                $("#repliesinput").val('');
                let _this = this;
                $("#repliesjsvs").find("#repliesapply").append(
                    '<div class="tt-item">' +
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
                    '<a class="tt-icon-btn" onclick="getlikes(' + res.data[4] + ')">' +
                    '<i class="tt-icon"><svg>' +
                    '<use xlink:href="#icon-like"></use>' +
                    '</svg></i>' +
                    '<span class="tt-text repinclikes' + res.data[4] + '">0</span>' +
                    '</a>' +
                    '<a class="tt-icon-btn" onclick="getdislikes(' + res.data[4] + ')">' +
                    '<i class="tt-icon"><svg>' +
                    '<use xlink:href="#icon-dislike"></use>' +
                    '</svg></i>' +
                    '<span class="tt-text repincdislikes' + res.data[4] + '">0</span>' +
                    '</a>' +
                    '<a class="tt-icon-btn" onclick="getfav(' + res.data[4] + ')">' +
                    '<i class="tt-icon"><svg>' +
                    '<use xlink:href="#icon-favorite"></use>' +
                    '</svg></i>' +
                    '<span class="tt-text repincfav' + res.data[4] + '">0</span>' +
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
                    '</div>' +
                    '</div>'
                );

               
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
        var created_post_id = $("#hdpk_post_id").text();
        var created_post_replies_id = $("#hdpk_replies_id").text();
        var likes = 1;
        console.log('replies jquer');
        console.log(incre_class);
        $.post(replikescount, { token: token, created_post_id: created_post_id, created_post_replies_id: incre_class, user_id: user_id, user_name: user_name, branch_id: branch_id, likes: likes }, function (res) {
            if (res.code == 200) {
                console.log(res);
                $('.repinclikes' + incre_class).text(res.data[0].likes);
            }
        }, 'json');
    });
    // replies dislike count
    $('.rep-dislikes-iconhit').on('click', function (e) {
        e.preventDefault();
        var incre_class = $(this).data("id");
        var id = $("#hdpk_replies_count_id").text();
        var created_post_id = $("#hdpk_post_id").text();
        var created_post_replies_id = $("#hdpk_replies_id").text();
        var dislikes = 1;
        console.log('replies only like insert');
        console.log(incre_class);
        $.post(repdislikescount, { token: token, created_post_id: created_post_id, created_post_replies_id: incre_class, user_id: user_id, user_name: user_name, branch_id: branch_id, dislikes: dislikes }, function (res) {
            if (res.code == 200) {
                console.log(res);
                $('.repincdislikes' + incre_class).text(res.data[0].dislikes);
            }
        }, 'json');
    });

    // replies fav count
    $('.rep-favorite-iconhit').on('click', function (e) {
        e.preventDefault();
        var incre_class = $(this).data("id");
        var id = $("#hdpk_replies_count_id").text();
        var created_post_id = $("#hdpk_post_id").text();
        var created_post_replies_id = $("#hdpk_replies_id").text();
        var favorits = 1;
        console.log(created_post_id);
        // console.log(incre_class);
        $.post(repheartcount, { token: token, created_post_id: created_post_id, created_post_replies_id: incre_class, user_id: user_id, user_name: user_name, branch_id: branch_id, favorits: favorits }, function (res) {
            if (res.code == 200) {
                console.log(res);
                $('.repincfav' + incre_class).text(res.data[0].favorits);
            }
        }, 'json');
    });
    $( ".target" ).change(function() {
        alert( "Handler for .change() called." );
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
        console.log(user_id);
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
function getlikes(e) {
    //debugger;   
    //var incre_class = $(this).data("id");
    var incre_class = e;
    var id = $("#hdpk_replies_count_id").text();
    var created_post_id = $("#hdpk_post_id").text();
    var created_post_replies_id = $("#hdpk_replies_id").text();
    var likes = 1;
    console.log('replies jquer');
    console.log(incre_class);
    $.post(replikescount, { token: token, created_post_id: created_post_id, created_post_replies_id: incre_class, user_id: user_id, user_name: user_name, branch_id: branch_id, likes: likes }, function (res) {
        if (res.code == 200) {
            console.log(res);
            $('.repinclikes' + incre_class).text(res.data[0].likes);
        }
    }, 'json');
}
function getdislikes(e) {
    var incre_class = e;
    var id = $("#hdpk_replies_count_id").text();
    var created_post_id = $("#hdpk_post_id").text();
    var created_post_replies_id = $("#hdpk_replies_id").text();
    var dislikes = 1;
    console.log('replies only like insert');
    console.log(incre_class);
    $.post(repdislikescount, { token: token, created_post_id: created_post_id, created_post_replies_id: incre_class, user_id: user_id, user_name: user_name, branch_id: branch_id, dislikes: dislikes }, function (res) {
        if (res.code == 200) {
            console.log(res);
            $('.repincdislikes' + incre_class).text(res.data[0].dislikes);
        }
    }, 'json');
}
function getfav(e) {
    var incre_class = e;
    var id = $("#hdpk_replies_count_id").text();
    var created_post_id = $("#hdpk_post_id").text();
    var created_post_replies_id = $("#hdpk_replies_id").text();
    var favorits = 1;
    console.log(created_post_id);
    // console.log(incre_class);
    $.post(repheartcount, { token: token, created_post_id: created_post_id, created_post_replies_id: incre_class, user_id: user_id, user_name: user_name, branch_id: branch_id, favorits: favorits }, function (res) {
        if (res.code == 200) {
            console.log(res);
            $('.repincfav' + incre_class).text(res.data[0].favorits);
        }
    }, 'json');
}
$(document).ready(function(){
    $("#listfilter").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#usnames").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
});
