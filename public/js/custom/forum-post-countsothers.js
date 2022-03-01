$(function () { 
    $('#likes-iconhit').on('click', function (e) {
        e.preventDefault();
        var id = $("#hdpkcount_details_id").text();
        $.post(likescount, {id:id, token: token }, function (res) {
            if (res.code == 200) {
                $('.inclike').text(res.data[0].likes);                                   
            }
        }, 'json');
    });
    $('#dislikes-iconhit').on('click', function (e) {
        e.preventDefault(); 
        var id = $("#hdpkcount_details_id").text();     
        $.post(dislikescount, {id:id, token: token }, function (res) {
            if (res.code == 200) {
                $('.incdislike').text(res.data[0].dislikes);
            }
        }, 'json');
    });
    $('#heart-iconhit').on('click', function (e) {
        e.preventDefault();
        var id = $("#hdpkcount_details_id").text();      
        $.post(heart, {id:id, token: token }, function (res) {
            if (res.code == 200) {                
                $('.incheart').text(res.data[0].favorite);
            }
        }, 'json');
    });

    $(window).on('load', function() {
        var id = $("#hdpkcount_details_id").text();
        var create_post_id = $("#hdpk_post_id").text(); 
    
        if ($('#hdpkcount_details_id[document_type]').val() != '')
        {
            var views="1";
            console.log('hai');
            // insert
            $.post(insertviewfirstcount, {token:token,branch_id:branch_id,user_id:user_id,user_name:user_name,create_post_id:create_post_id,views:views }, function (res) {
                if(res.code == 200) {
                    $('.incviews').text(res.data[0].views);
                    console.log(res);                           
                }
            }, 'json');
        }
        else{
            console.log('else');
        
            $.post(viewscount, {id:id, token: token }, function (res) {
                if (res.code == 200) {
                    $('.incviews').text(res.data[0].views);
                    console.log(res);                            
                }
            }, 'json');
        }
    });
});
