@extends('layouts.admin-layout')
@section('title','Chat')
@section('component_css')
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('public/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/toastr/toastr.min.css') }}">
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">{{ __('messages.chat') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('messages.chat') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <!-- start chat users-->
        <div class="col-xl-3 col-lg-4">
            <div class="card">
                <div class="card-body">
                    @php $url=config('constants.image_url'); @endphp
                    <div class="media mb-3">
                        <img src="{{ Session::get('picture') && config('constants.image_url').'/public/'.config('constants.branch_id').'/users/images/'.Session::get('picture') ? config('constants.image_url').'/public/'.config('constants.branch_id').'/users/images/'.Session::get('picture') : config('constants.image_url').'/public/common-asset/images/users/default.jpg' }}" class="mr-2 rounded-circle" height="42">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 font-15">
                                <a href="javascript: void(0);" class="text-reset">{{$name}}</a>({{$role}})
                            </h5>
                            <p class="mt-1 mb-0 text-muted font-14">
                                <small class="mdi mdi-circle text-success"></small> Online
                            </p>
                        </div>
                        <div>
                            <a href="javascript: void(0);" class="text-reset font-20">
                                <i class="mdi mdi-cog-outline"></i>
                            </a>
                        </div>
                    </div>

                    <!-- start search box -->
                    <form class="search-bar mb-3">
                        <div class="position-relative">
                            <input type="text" id="searchuser" onkeyup="search_user()" class="form-control form-control-light" placeholder="{{ __('messages.people_group') }}">
                            <span class="mdi mdi-magnify"></span>
                        </div>
                    </form>
                    <!-- end search box -->

                    <h6 class="font-13 text-muted text-uppercase">{{ __('messages.group_chat') }}</h6>
                    <div class="p-2">

                        @foreach($group_list as $group)
                        <a href="javascript: void(0);" class="text-reset mb-2 d-block chatusers" onclick="my_function('{{$group['id']}}','{{$group['name']}}','','Group')">
                            <i class="mdi mdi-checkbox-blank-circle-outline mr-1 text-success"></i>
                            <span class="mb-0 mt-1">{{$group['name']}} Group</span>
                        </a>
                        @endforeach
                    </div>

                    <h6 class="font-13 text-muted text-uppercase mb-2">{{ __('messages.teacher_contacts') }}</h6>

                    <!-- users -->
                    <div class="row">
                        <div class="col">
                            <div data-simplebar style="max-height: 200px;">
                            @foreach($teacher_list as $teacher)
                                <a href="javascript:void(0);" class="text-body chatusers" onclick="my_function('{{$teacher['staff_id']}}','{{$teacher['name']}}','{{$teacher['photo']}}','Teacher')">
                                    <div class="media p-2">
                                        <img src="{{ ($teacher['photo'] && $url.'/public/'.config('constants.branch_id').'/users/images/'.$teacher['photo']) ? $url.'/public/'.config('constants.branch_id').'/users/images/'.$teacher['photo'] :  $url.'/public/common-asset/images/users/default.jpg' }}" class="mr-2 rounded-circle" height="42" alt="Maria C" />
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-0 font-14">
                                                <span class="float-right text-muted font-weight-normal font-12"></span>
                                                {{$teacher['name']}}
                                            </h5>
                                            @if($teacher['msgcount']>0) 
                                                <p class="mt-1 mb-0 text-muted font-14">
                                                    <span class="w-25 float-right text-right"><span class="badge badge-soft-success" id="Teacher{{$teacher['staff_id']}}">{{$teacher['msgcount']}}</span></span>
                                                    <!--<span class="w-75">Thanks</span>-->
                                                </p> 
                                            @endif
                                        </div>
                                    </div>
                                </a>
                                @endforeach

                            </div> <!-- end slimscroll-->
                        </div> <!-- End col -->
                    </div>
                    <!-- end users -->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
        <!-- end chat users-->

        <!-- chat area -->
        <div class="col-xl-9 col-lg-8">
            @php $k=0; @endphp @foreach($teacher_list as $teacher)
            @php $k++; @endphp
            @if($k==1)
            <div class="card">
                <div class="card-body py-2 px-3 border-bottom border-light">
                    <div class="media py-1">
                        <img src="{{ ($teacher['photo'] && $url.'/public/'.config('constants.branch_id').'/users/images/'.$teacher['photo']) ? $url.'/public/'.config('constants.branch_id').'/users/images/'.$teacher['photo'] :  $url.'/public/common-asset/images/users/default.jpg' }}" id="toimage" class="mr-2 rounded-circle" height="36" alt="Teacher">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 font-15">
                                <a href="javascript: void(0);" class="text-reset"><span id="toname">{{ $teacher['name'] }}</span></a> (<span id="usertype">Teacher</span>)
                            </h5>
                            <p class="mt-1 mb-0 text-muted font-12">
                                <small class="mdi mdi-circle text-success"></small> Online
                            </p>
                        </div>
                        <div>
                            <form class="search-bar mb-3">
                                <div class="position-relative">
                                    <input type="text" id="searchbar" onkeyup="search_keyword()" class="form-control form-control-light" style="padding-left: 40px;border-radius: 30px;" placeholder="Search keyword..">
                                    <span class="mdi mdi-magnify"></span>
                                </div>
                            </form>

                            <!--<a href="javascript: void(0);" class="text-reset font-19 py-1 px-2 d-inline-block" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Chat">
                                <i class="fe-trash-2"></i>
                            </a>-->
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <ul class="conversation-list" data-simplebar style="max-height:200px; overflow-x: hidden;">
                                <div id="showchat">
                                </div>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mt-2 bg-light p-3 rounded">
                            
                                <input type="hidden" name="chat_fromid" id="chat_fromid" value="{{$tid}}">
                                <input type="hidden" name="chat_fromname" id="chat_fromname" value="{{$name}}">
                                <input type="hidden" name="chat_fromuser" id="chat_fromuser" value="{{$role}}">
                                <input type="hidden" name="chat_toid" id="chat_toid" value="{{$teacher['staff_id']}}">
                                <input type="hidden" name="chat_toname" id="chat_toname" value="{{$teacher['name']}}">
                                <input type="hidden" name="chat_touser" id="chat_touser" value="Teacher">
                                
                                <div class="row">
                                    <div class="col mb-2 mb-sm-0">
                                        <input type="text" name="chat_content" id="chat_content" class="form-control border-0" placeholder="{{ __('messages.enter_your_text') }}" required="">
                                        <div class="invalid-feedback">
                                            Please enter your messsage
                                        </div>
                                        <span id="status"></span>
                                    </div>
                                    <div class="col-sm-auto">
                                        <div class="btn-group">
                                            <input type="file" id="homework_file" name="file" hidden onchange="Filevalidation()">
                                            <a href="javascript: void(0);" class="emoji-btn btn btn-light">&#128512;</a>
                                            <a href="javascript: void(0);" id='buttonid' class="btn btn-light"><i class="fe-paperclip" style="font-size:14px;color: #343a40;"></i></a>
                                            <button type="button" id="chat_save" class="btn btn-success chat-send btn-block"><i class='fe-send'></i></button>
                                            <input type="hidden" name="csrftoken" id="csrftoken" value="{{ csrf_token() }}">
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row-->
                            
                            </div>
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
            @endif
            @endforeach
        </div>
        <!-- end chat area-->

    </div> <!-- end row-->
</div> <!-- container -->
@endsection
@section('scripts')
<script src="{{ asset('public/libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('public/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('public/EmojiPicker/EmojiPicker.js') }}"></script>
<script>
    let imgurl = "{{ url($url.'/public/'.config('constants.branch_id').'/users/images/')}}";
    
    var defaultimg= "{{ url($url.'/public/common-asset/images/users/default.jpg') }}";
    function my_function(toid, toname,toimage, touser) 
    {
        $('#toname').html(toname);
        $('#usertype').html(touser);

        $('#chat_toid').val(toid);
        $('#chat_toname').val(toname);
        $('#chat_touser').val(touser);
        toimg=(toimage && imgurl+toimage)?imgurl+toimage:defaultimg;
        $('#toimage').prop('src', toimg)
        getchatlist();
    }
    document.getElementById('buttonid').addEventListener('click', openDialog);
    function openDialog() {
        document.getElementById('homework_file').click();
    }
    window.addEventListener('focus', startTimer);
    // Get Chat List Start(Set Interval 5 Sec)
    function startTimer() {
        var interval = 5000;
        setInterval(getchatlist, interval);       
    }
// Get Chat List End(Set Interval 5 Sec)
</script>

<script>
    // Save Chat Start
    var tchatUrl = "{{ route('parent.chat.add') }}";
	$('#chat_save').on('click', function(e) {
		e.preventDefault();
		var form = this;
		var chat_fromid = $("#chat_fromid").val();
		var chat_fromname = $("#chat_fromname").val();
		var chat_fromuser = $("#chat_fromuser").val();
		var chat_toid = $("#chat_toid").val();
		var chat_toname = $("#chat_toname").val();
		var chat_touser = $("#chat_touser").val();
		var chat_content = $("#chat_content").val(); 
        var csrftoken = $("#csrftoken").val();

        var formData = new FormData();
        formData.append('_token', csrftoken);
		formData.append('chat_fromid', chat_fromid);
		formData.append('chat_fromname', chat_fromname);
		formData.append('chat_fromuser', chat_fromuser);
		formData.append('chat_toid', chat_toid);
		formData.append('chat_toname', chat_toname);
		formData.append('chat_touser', chat_touser);
		formData.append('chat_content', chat_content);

		// formData.append('file', file);
		formData.append('file', $('input[type=file]')[0].files[0]);
		// Display the key/value pairs
		// for (var pair of formData.entries()) {
		//     console.log(pair[0] + ', ' + pair[1]);
		// }
		// return false;
		//
		if(chat_content!='')
        {
            var token = "{{ Session::get('token') }}";
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
                headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Authorization': 'Bearer ' + token
                },
                url: tchatUrl,
                method: 'POST',
                // data: new FormData(form),
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
			    Accept: 'application/json',    
			    success: function(response) {
                    // alert(response.code);
                    if (response.code == 200) {
                        toastr.success(response.message);
                        $("#chat_content").val("");
                        getchatlist();
                    } else {}
                },
                error: function(response) {
                    if (response.status === 419) {
                        // CSRF token mismatch, handle the error here
                        // You can refresh the page or show an error message
                        alert('419');
                    } else {
                        // Handle other errors
                        alert('in else');
                    }
                }
                
            });
        }
        else
        {
            toastr.error("Please Enter the message"); 
        }
    });
     // Save Chat End


var tchatdelUrl = "{{ route('parent.chat.del') }}";
    function deletechat(id)
        {
        var url = tchatdelUrl;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Exam Term',
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
                    chat_id: id
                }, function (data) {
                    if (data.code == 200) {
                        $("#chat_content").val("");
                        getchatlist();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    }


    
    // Get Chat List function Start
    var chatlistUrl = "{{ route('parent.chat.showlist') }}";

    function getchatlist() {
		var csrftoken = $("#csrftoken").val();
        var form = this;
        var chat_fromid = $("#chat_fromid").val();
        var chat_fromname = $("#chat_fromname").val();
        var chat_fromuser = $("#chat_fromuser").val();
        var chat_toid = $("#chat_toid").val();
        var chat_toname = $("#chat_toname").val();
        var chat_touser = $("#chat_touser").val();       
		var chat_content = $("#chat_content").val();
        
        var formData = new FormData();
        formData.append('_token', csrftoken);
        formData.append('chat_fromid', chat_fromid);
        formData.append('chat_fromname', chat_fromname);
        formData.append('chat_fromuser', chat_fromuser);
        formData.append('chat_toid', chat_toid);
        formData.append('chat_toname', chat_toname);
        formData.append('chat_touser', chat_touser);

        // formData.append('file', file);
        ///formData.append('file', $('input[type=file]')[0].files[0]);
        // Display the key/value pairs
        // for (var pair of formData.entries()) {
        //     console.log(pair[0] + ', ' + pair[1]);
        // }
        // return false;
        //
        var searchbar = $("#searchbar").val();
        if (searchbar == '') {
            var token = "{{ Session::get('token') }}";
			var csrfToken = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Authorization': 'Bearer ' + token
                },
                url: chatlistUrl,
                method: 'post',
                // data: new FormData(form),
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
				Accept: 'application/json',
				
				success: function(response) {
                    
                    if (response.code == 200) {

                        let chatfile = "";
                        let msgread = "";
                        let chatdatearr = [];
                        let chat_li = "";
                        let chatarray = response.data;
                        chatarray.reverse();

                        $.each(chatarray, function(i, item) {
                            chatfile = "";
                            if (item.chat_status == 'Unread') {
                                msgread = '<img src={{ asset("public/images/chat/unread.png") }} style="width:20px" title="' + item.chat_status + '" />';
                            } else {
                                msgread = '<img src={{ asset("public/images/chat/read.png") }} style="width:20px" title="' + item.chat_status + '" />';
                            }
                            if (($.inArray(item.chatdate, chatdatearr)) < 0) {
                                chat_li += ' <li class="clearfix"> <center> ' + item.chatdate + '</center></li>';
                                chatdatearr.push(item.chatdate);
                            }

                            if (item.chat_document != null) {
                                chatfile = '<br><button type="button" onclick=showfile("' + item.chat_document + '") class="btn btn-primary chat-send btn-block"><i class="fe-paperclip"></i></button>';
                            }
                            if (chat_fromid == item.chat_fromid && chat_fromuser == item.chat_fromuser) {
                                chat_li += '<li class="clearfix odd">';
                                chat_li += '<div class="chat-avatar">';
                                //chat_li +=' <img src="'+fromimg+'" class="rounded" alt="'+item.chat_fromname+'" />';
                                chat_li += '<i>' + tConvert(item.chattime) + '</i>';
                                chat_li += msgread;
                                chat_li += '<i class="fe-trash-2" onclick="deletechat(' + item.id + ')"></i>';
                                chat_li += '</div>';
                                chat_li += '<div class="conversation-text">';
                                chat_li += '<div class="ctext-wrap">';
                                chat_li += '<i>' + item.chat_fromname + '</i>';
                                chat_li += '<p>' + item.chat_content + ' ' + chatfile + '</p>';
                                chat_li += '</div>';
                                chat_li += '</div>';
                                chat_li += '<div class="conversation-actions dropdown">';
                                chat_li += '<button class="btn btn-sm btn-link" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical font-16"></i></button>';
                                chat_li += '<div class="dropdown-menu dropdown-menu-right">';
                                chat_li += '<a class="dropdown-item" href="#">Copy Message</a>';
                                chat_li += '<a class="dropdown-item" href="#">Edit</a>';
                                chat_li += '<a class="dropdown-item" href="#">Delete</a>';
                                chat_li += '</div>';
                                chat_li += '</div>';
                                chat_li += '</li>';
                            } else {
                                chat_li += '<li class="clearfix">';
                                chat_li += '<div class="chat-avatar">';
                                // chat_li +=' <img src="'+imgurl+toimg+'" class="rounded" alt="'+item.chat_fromname+'" />';
                                chat_li += '<i>' + tConvert(item.chattime) + '<br> </i>';
                                chat_li += '</div>';
                                chat_li += '<div class="conversation-text">';
                                chat_li += '<div class="ctext-wrap">';
                                chat_li += '<i>' + item.chat_fromname + '</i>';
                                chat_li += '<p>' + item.chat_content + ' ' + chatfile + '</p>';
                                chat_li += '</div>';
                                chat_li += '</div>';
                                chat_li += '<div class="conversation-actions dropdown">';
                                chat_li += '<button class="btn btn-sm btn-link" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical font-16"></i></button>';
                                chat_li += '<div class="dropdown-menu dropdown-menu-right">';
                                chat_li += '<a class="dropdown-item" href="#">Copy Message</a>';
                                chat_li += '<a class="dropdown-item" href="#">Edit</a>';
                                chat_li += '<a class="dropdown-item" href="#">Delete</a>';
                                chat_li += '</div>';
                                chat_li += '</div>';
                                chat_li += '</li>';
                            }
                        });
                        //alert(chatdatearr);
                        $('#showchat').html(chat_li);
                    } else {}
                }
            });
        }
    }
     // Get Chat List function End

    function tConvert(time) {
        // Check correct time format and split into components
        time = time.toString().match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

        if (time.length > 1) { // If time format correct
            time = time.slice(1); // Remove full string match value
            time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
            time[0] = +time[0] % 12 || 12; // Adjust hours
        }
        return time.join(''); // return adjusted time or original string
    }

    function showfile(filename) {
        var fileurl="{{ url($url.'/public/admin-documents/chats/') }}";
        window.open(fileurl+ filename, 'popup', 'width=600,height=600,scrollbars=no,resizable=no');
        return false;
    }  


     // Chat List Search Keywords Start
    function search_keyword() {
        let input = document.getElementById('searchbar').value
        input = input.toLowerCase();
        let x = document.getElementsByClassName('clearfix');

        for (i = 0; i < x.length; i++) {
            if (!x[i].innerHTML.toLowerCase().includes(input)) {
                x[i].style.display = "none";
            } else {
                x[i].style.display = "list-item";
            }
        }
    }
// Chat List Search Keywords End
// Chat Users Search Keywords Start
    function search_user() {
        let input = document.getElementById('searchuser').value
        input = input.toLowerCase();
        let x = document.getElementsByClassName('chatusers');

        for (i = 0; i < x.length; i++) {
            if (!x[i].innerHTML.toLowerCase().includes(input)) {
                x[i].style.display = "none";
            } else {
                x[i].style.display = "list-item";
            }
        }
    }
// Chat Users Search Keywords End
</script>

<script>
// Attach File Validation below 10 MB Start
    Filevalidation = () => {
        const fi = document.getElementById('homework_file');
        // Check if any file is selected.
        if (fi.files.length > 0) {
            for (const i = 0; i <= fi.files.length - 1; i++) {

                const fsize = fi.files.item(i).size;
                const file = Math.round((fsize / 1024));
                // The size of the file.
                if (file >= 10240) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File too Big',
                        text: 'Please select a file less than 10MB.!'
                    })
                }
            }
        }
    }
    // Attach File Validation below 10 MB End
</script>

<script>
        new EmojiPicker({
            trigger: [               
                {
                    selector: '.emoji-btn',
                    insertInto: '#chat_content'
                }
            ],
            closeButton: true,
            //specialButtons: green
        });

    </script>
@endsection