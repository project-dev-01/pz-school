@extends('layouts.admin-layout')
@section('title','Chat')
@section('component_css')
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('public/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/toastr/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/emoji/emoji_keyboard.css') }}">
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
						
					    <img src="{{ Session::get('picture') && config('constants.image_url').'/public/'.config('constants.branch_id').'/users/images/'.Session::get('picture') ? config('constants.image_url').'/public/'.config('constants.branch_id').'/users/images/'.Session::get('picture') : config('constants.image_url').'/public/common-asset/images/users/default.jpg' }}"  class="mr-2 rounded-circle" height="42" >
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
                            <input type="text" id="searchuser" onkeyup="search_user()"  class="form-control form-control-light" placeholder="{{ __('messages.people_group') }}">
                            <span class="mdi mdi-magnify"></span>
                        </div>
                    </form>
                    <!-- end search box -->

                    <h6 class="font-13 text-muted text-uppercase">{{ __('messages.group_chat') }}</h6>
                    <div class="p-2">
                        @foreach($group_list as $group)
                        <a href="javascript: void(0);" class="text-reset mb-2 d-block chatusers " onclick="my_function('{{$group['id']}}','','Group')">
                            <i class="mdi mdi-checkbox-blank-circle-outline mr-1 text-success"></i>
                            <span class="mb-0 mt-1">{{$group['name']}} Group</span>
							<input type="hidden" id="username{{ $group['id'] }}Group" value="{{$group['name']}}">
                        </a>
                        @endforeach
                    </div>

                    <h6 class="font-13 text-muted text-uppercase mb-2">Parent Contacts</h6>

                    <!-- users -->
                    <div class="row">
                        <div class="col">
                            <div data-simplebar style="max-height: 100px;">   
                            <div id="parentlistshow">   
                            </div>                      
                                @foreach($parent_list as $parent)
								
                                @endforeach
                            </div> <!-- end slimscroll-->
                        </div> <!-- End col -->
                    </div>
                    <h6 class="font-13 text-muted text-uppercase mb-2">{{ __('messages.teacher_contacts') }}</h6>

                    <!-- users -->
                    <div class="row">
                        <div class="col">
                            <div data-simplebar style="max-height: 100px;">
                            <div id="teacherlistshow">
                            </div>    
                                @foreach($teacher_list as $teacher)

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
			@php $k=0; @endphp @foreach($parent_list as $parent)  
								@php $k++; @endphp
								@if($k==1)
            <div class="card">
                <div class="card-body py-2 px-3 border-bottom border-light">
                    <div class="media py-1">
                        <img src="{{ $parent['photo'] && $url.'/public/'.config('constants.branch_id').'/users/images/'.$parent['photo'] ? $url.'/public/'.config('constants.branch_id').'/users/images/'.$parent['photo'] : $url.'/public/common-asset/images/users/default.jpg' }}" id="toimage" class="mr-2 rounded-circle" height="36" alt="Brandon Smith">

                        <div class="media-body">
                            <h5 class="mt-0 mb-0 font-15">
                                <a href="javascript: void(0);" class="text-reset"><span id="toname">{{ $parent['name'] }}</span></a> (<span id="usertype">Parent</span>)
                            </h5>
                            <p class="mt-1 mb-0 text-muted font-12">
                                <small class="mdi mdi-circle text-success"></small> Online
                            </p>
                        </div>
                        <div>
							<form class="search-bar mb-3">
								<div class="position-relative">
									<input type="text" id="searchbar" onkeyup="search_keyword()"  class="form-control form-control-light" style="padding-left: 40px;border-radius: 30px;" placeholder="Search keyword..">
									<span class="mdi mdi-magnify"></span>
                        </div>
							</form>
                    </div>
                </div>
                            </div>
                <div class="card-body">
                    <div class="row">
						<div class="col">
							<ul class="conversation-list"  data-simplebar style="max-height:200px; overflow-x: hidden;">
						<div id="showchat">
</div>	
							</ul>
                                </div>
                            </div>
                    <div class="row">
                        <div class="col">
                            <div class="mt-2 bg-light p-3 rounded">
                                
                                    <input type="hidden" name="chat_fromid" id="chat_fromid" value="{{$tid}}">                                    
                                    <input type="hidden" name="chat_fromname" id="chat_fromname"  value="{{$name}}">  
                                    <input type="hidden" name="chat_fromuser" id="chat_fromuser"  value="{{$role}}">
                                    <input type="hidden" name="chat_toid" id="chat_toid" value="{{$parent['id']}}">    
                                    <input type="hidden" name="chat_toname" id="chat_toname" value="{{$parent['name']}}">                                        
                                    <input type="hidden" name="chat_touser" id="chat_touser" value="Parent">    
                                    <input type="hidden" name="branch_id" id="branch_id" value="1">
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
                                                <a href="javascript: void(0);" id='emoji' class="btn btn-light">&#128512;</a>
                                                <a href="javascript: void(0);" id='buttonid' class="btn btn-light"><i class="fe-paperclip" style="font-size:14px;color: #343a40;"></i></a>
                                                <button type="button" id="chat_save" class="btn btn-success chat-send btn-block" onclick="save_chat()"><i class='fe-send'></i></button>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row-->

                            </div>
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
			<script>
				getchatlist();
				</script>
			@endif
			@endforeach
        </div>
        <!-- end chat area-->

    </div> <!-- end row-->
</div> <!-- container -->
@endsection
@section('scripts')
<script src="{{ asset('public/libs/moment/min/moment.min.js') }}"></script>

<script src="{{ asset('public/emoji/emoji_keyboard.js') }}"></script>
<script src="{{ asset('public/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/toastr/toastr.min.js') }}"></script>
<script>
	
    let imgurl="{{ url($url.'/public/'.config('constants.branch_id').'/users/images/')}}";
	
    var defaultimg= "{{ url($url.'/public/common-asset/images/users/default.jpg') }}";
	
	function my_function(toid,toimage,touser)
    {
        var toname= $('#username'+toid+touser).val();
        $('#toname').html(toname);
        $('#usertype').html(touser);
        
        $('#chat_toid').val(toid);
        $('#chat_toname').val(toname);
        $('#chat_touser').val(touser);
        var toimg=(toimage==null || toimage=='' )?imgurl+toimage:defaultimg;
							
	
        $('#toimage').prop('src', toimg)
		getchatlist();
		
	}
    document.getElementById('buttonid').addEventListener('click', openDialog);
	function openDialog() {
		document.getElementById('homework_file').click();
	}
</script>

<script>
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
</script>


<script>
    
    var tchatUrl = "{{ route('teacher.chat.add') }}";
    $('#chat_save').on('click', function (e) {
        e.preventDefault();
		
        
		var form = this;
		var chat_fromid = $("#chat_fromid").val();
		var chat_fromname = $("#chat_fromname").val();
		var chat_fromuser = $("#chat_fromuser").val();
		var chat_toid = $("#chat_toid").val();
		var chat_toname = $("#chat_toname").val();
		var chat_touser = $("#chat_touser").val();
		var chat_content = $("#chat_content").val();
		var branch_id = $("#branch_id").val();
		
		var formData = new FormData();
		formData.append('chat_fromid', chat_fromid);
		formData.append('chat_fromname', chat_fromname);
		formData.append('chat_fromuser', chat_fromuser);
		formData.append('chat_toid', chat_toid);
		formData.append('chat_toname', chat_toname);
		formData.append('chat_touser', chat_touser);
		formData.append('chat_content', chat_content);
		formData.append('branch_id', branch_id);
		
		// formData.append('file', file);
		formData.append('file', $('input[type=file]')[0].files[0]);
		// Display the key/value pairs
		// for (var pair of formData.entries()) {
		//     console.log(pair[0] + ', ' + pair[1]);
		// }
		// return false;
		//
		
		$.ajax({
			url: tchatUrl,
			method:'post',
			// data: new FormData(form),
			data: formData,
			processData: false,
			dataType: 'json',
			contentType: false,
			success: function (response) {
				// alert(response.code);
				if (response.code == 200) {
					
					$("#chat_content").val("");
					getchatlist();
                    } else {                       
				}
			}
		});
        
	});
</script>

<script>
    
    var tchatdelUrl = "{{ route('teacher.chat.del') }}";
    function deletechat(id)
	{
		// alert(1);
        var url = tchatdelUrl;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Chat',
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
    
</script>

<script>
	
	window.addEventListener('focus', startTimer);
	
	// Inactive
	window.addEventListener('blur', stopTimer);
	
	// where X is your every X SEC
	function  startTimer()
	{
		var interval = 1000 * 5;
		setInterval(getchatlist, interval);
		setInterval(getparentlist, interval);
		setInterval(getteacherlist, interval);
	}
	function  stopTimer()
	{
		var interval = 1000 * 60 * 5;
		setInterval(getchatlist, interval);
	}
    var chatlistUrl = "{{ route('teacher.chat.showlist') }}";
    getchatlist();
    function getchatlist()
    {
		// alert(1);
        
		var form = this;
		var chat_fromid = $("#chat_fromid").val();
		var chat_fromname = $("#chat_fromname").val();
		var chat_fromuser = $("#chat_fromuser").val();
		var chat_toid = $("#chat_toid").val();
		var chat_toname = $("#chat_toname").val();
		var chat_touser = $("#chat_touser").val();
		var chat_content = $("#chat_content").val();
		var branch_id = $("#branch_id").val();
		
		var formData = new FormData();
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
		if(searchbar=='')
		{
            $.ajax({
                url: chatlistUrl,
                method:'post',
                // data: new FormData(form),
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    console.log(response);
                    
                    if (response.code == 200) {
                        
                        let chatfile="";
                        let msgread="";
                        let  chatdate=[];
                        let chat_li = "";
                        let chatarray =response.data;
                        chatarray .reverse();
                        
                        $.each( chatarray, function (i, item) { 
                            chatfile="";   
							// msgread= =(item.chat_status=='Unread')?'read.png':'unread.png';
                            if(item.chat_status=='Unread')
                            {
                                msgread='<img src={{ asset("public/images/chat/unread.png") }} style="width:20px" title="'+item.chat_status+'" />';
							}
                            else
                            {
                                msgread='<img src={{ asset("public/images/chat/read.png") }} style="width:20px" title="'+item.chat_status+'" />';
							}                       
                            if(($.inArray(item.chatdate, chatdate))<0)
                            {                            
                                chat_li +=' <li class="clearfix"> <center> '+item.chatdate+'</center></li>'; 
                                chatdate.push(item.chatdate);                        
							}
							
                            if(item.chat_document!=null)
                            {
                                chatfile='<br><button type="button" onclick=showfile("'+item.chat_document+'") class="btn btn-primary chat-send btn-block"><i class="fe-paperclip"></i></button>';
							}
                            if(chat_fromid==item.chat_fromid && chat_fromuser==item.chat_fromuser)
                            {
								chat_li +='<li class="clearfix odd">';
								chat_li +='<div class="chat-avatar">';
								chat_li +='<i>'+tConvert(item.chattime)+'</i>';
								chat_li +=msgread;
								chat_li +='<i class="fe-trash-2" onclick="deletechat('+item.id+')"></i>';
								chat_li +='</div>';
								chat_li +='<div class="conversation-text">';
								chat_li +='<div class="ctext-wrap">';
								chat_li +='<i>'+item.chat_fromname+'</i>';
								chat_li +='<p>'+item.chat_content+' '+chatfile+'</p>';
								chat_li +='</div>';
								chat_li +='</div>';
								chat_li +='<div class="conversation-actions dropdown">';
								chat_li +='<button class="btn btn-sm btn-link" data-toggle="dropdown" aria-expanded="true"><i class="mdi mdi-dots-vertical font-16"></i></button>';
								chat_li +='<div class="dropdown-menu dropdown-menu-right">';
								chat_li +='<a class="dropdown-item" href="#">Copy Message</a>';
								chat_li +='<a class="dropdown-item" href="#">Edit</a>';
								chat_li +='<a class="dropdown-item" href="#">Delete</a>';
								chat_li +='</div>';
								chat_li +='</div>';
								chat_li +='</li>';
							}
                            else
                            {
								chat_li +='<li class="clearfix">';
								chat_li +='<div class="chat-avatar">';
								//chat_li +='<img src="'+imgurl+toimg+'" class="rounded" alt="'+item.chat_fromname+'" />';
								chat_li +='<i>'+tConvert(item.chattime)+'</i>';
								chat_li +='</div>';
								chat_li +='<div class="conversation-text">';
								chat_li +='<div class="ctext-wrap">';
								chat_li +='<i>'+item.chat_fromname+'</i>';
								chat_li +='<p>'+item.chat_content+' '+chatfile+'</p>';
								chat_li +='</div>';
								chat_li +='</div>';
								chat_li +='<div class="conversation-actions dropdown">';
								chat_li +='<button class="btn btn-sm btn-link" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical font-16"></i></button>';
								chat_li +='<div class="dropdown-menu dropdown-menu-right">';
								chat_li +='<a class="dropdown-item" href="#">Copy Message</a>';
								chat_li +='<a class="dropdown-item" href="#">Edit</a>';
								chat_li +='<a class="dropdown-item" href="#">Delete</a>';
								chat_li +='</div>';
								chat_li +='</div>';
								chat_li +='</li>';
							}
                                   
						}); 
						$('#showchat').html(chat_li);    
                        //$('#showchat').append(chat_li);                              
						} 
						else
						{    
							                  
					}
				}
			});
		}
	}
	var parentlisttUrl = "{{ route('teacher.chat.parentlist') }}";
	getparentlist();
	function getparentlist()
    {
		
        
		var form = this;
		var chat_fromid = $("#chat_fromid").val();
		var chat_fromname = $("#chat_fromname").val();
		var chat_fromuser = $("#chat_fromuser").val();
		var branch_id = $("#branch_id").val();
		
		var formData = new FormData();
		formData.append('chat_fromid', chat_fromid);
		formData.append('chat_fromname', chat_fromname);
		formData.append('chat_fromuser', chat_fromuser);
		var searchuser = $("#searchuser").val();
		if(searchuser=='')
		{
		$.ajax({
                url: parentlisttUrl,
                method:'post',
                // data: new FormData(form),
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    console.log(response);
                    
                    if (response.code == 200) {
                        
                        let parent_li = "";
                        let parentarray =response.data;
						parentarray = parentarray.sort((a, b) => {
						if (a.msgcount < b.msgcount) {
							return -1;
						}
						});
						parentarray.reverse();
                        $.each(parentarray, function (i, item) { 
							var photo=(item.photo==null || item.photo=='')?defaultimg:imgurl+item.photo;
							parent_li +=`<a href="javascript:void(0);" class="text-body chatusers" onclick=my_function('`+item.id+`','`+photo+`','Parent')>`;
							parent_li +='<div class="media p-2">';
							parent_li +='<img src="'+photo+'" class="mr-2 rounded-circle" height="42"/>';
                            parent_li += '<div class="media-body">';
                            parent_li += '<h5 class="mt-0 mb-0 font-14"><span class="float-right text-muted font-weight-normal font-12" ></span>'+item.name+'</h5>';
							if(parseInt(item.msgcount)>0) 
                            {
							parent_li += '<p class="mt-1 mb-0 text-muted font-14">';
							parent_li += '<span class="w-25 float-right text-right"><span class="badge badge-soft-success">'+item.msgcount+'</span></span>';
							parent_li += '<!--<span class="w-75">Thanks</span>-->';
							parent_li += '</p>';
							}
							parent_li +='<input type="hidden" id="username'+item.id+'Parent" value="'+item.name+'"></div>';
							parent_li +='</div>';
							parent_li +='</a> ';
                            
                            
						}); 
						//$('#parentlistshow').html(parent_li); 
                        $('#parentlistshow').append(parent_li);                               
						} else {                       
					}
				}
			});
		}
		
	}
	var teacherlisttUrl = "{{ route('teacher.chat.teacherlist') }}";
	getteacherlist();
	function getteacherlist()
    {
		
        
		var form = this;
		var chat_fromid = $("#chat_fromid").val();
		var chat_fromname = $("#chat_fromname").val();
		var chat_fromuser = $("#chat_fromuser").val();
		var branch_id = $("#branch_id").val();
		
		var formData = new FormData();
		formData.append('chat_fromid', chat_fromid);
		formData.append('chat_fromname', chat_fromname);
		formData.append('chat_fromuser', chat_fromuser);
		var searchuser = $("#searchuser").val();
		if(searchuser=='')
		{
		$.ajax({
                url: teacherlisttUrl,
                method:'post',
                // data: new FormData(form),
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    console.log(response);
                    
                    if (response.code == 200) {
                        
                        let teacher_li = "";
                        let teacherarray =response.data;
						teacherarray = teacherarray.sort((a, b) => {
						if (a.msgcount < b.msgcount) {
							return -1;
						}
						});
						teacherarray.reverse();
                        $.each(teacherarray, function (i, item) { 
							var photo=(item.photo==null || item.photo=='' )?defaultimg:imgurl+item.photo;
							teacher_li +=`<a href="javascript:void(0);" class="text-body chatusers" onclick=my_function('`+item.staff_id+`','`+photo+`','Teacher')>`;
							teacher_li +='<div class="media p-2">';
							teacher_li +='<img src="'+photo+'" class="mr-2 rounded-circle" height="42"/>';
                            teacher_li += '<div class="media-body">';
                            teacher_li += '<h5 class="mt-0 mb-0 font-14"><span class="float-right text-muted font-weight-normal font-12" ></span>'+item.name+'</h5>';
							if(parseInt(item.msgcount)>0) 
                            {
							teacher_li += '<p class="mt-1 mb-0 text-muted font-14">';
							teacher_li += '<span class="w-25 float-right text-right"><span class="badge badge-soft-success">'+item.msgcount+'</span></span>';
							teacher_li += '<!--<span class="w-75">Thanks</span>-->';
							teacher_li += '</p>';
							}
							teacher_li +='<input type="hidden" id="username'+item.staff_id+'Teacher" value="'+item.name+'"></div>';
							teacher_li +='</div>';
							teacher_li +='</a> ';
                            
                            
						}); 
						$('#teacherlistshow').html(teacher_li);                               
						} else {                       
					}
				}
			});
		}
		
	}
    function tConvert (time) {
		// Check correct time format and split into components
		time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];
		
		if (time.length > 1) { // If time format correct
			time = time.slice (1);  // Remove full string match value
			time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
			time[0] = +time[0] % 12 || 12; // Adjust hours
		}
		return time.join (''); // return adjusted time or original string
	}
	function showfile(filename)
	{
		window.open('http://localhost/paxsuzen-api-dev/public/admin-documents/chats/'+filename,'popup','width=600,height=600,scrollbars=no,resizable=no'); return false;
	}
	function search_keyword() {
		let input = document.getElementById('searchbar').value
		input=input.toLowerCase();
		let x = document.getElementsByClassName('clearfix');
		
		for (i = 0; i < x.length; i++) { 
			if (!x[i].innerHTML.toLowerCase().includes(input)) {
				x[i].style.display="none";
			}
			else {
				x[i].style.display="list-item";                 
			}
		}
	}
	
</script>

<script>
	const zone = document.getElementById("chat_content");
	var emojiKeyboard = new EmojiKeyboard;
	/* you can edit a few attributes:
		- callback: function called when a user clicks on an emoji, with the emoji and a boolean telling if the window got closed
		- auto_reconstruction: boolean if we should recreate the keyboard when we cannot find it
		- default_placeholder: placeholder text in the search bar
		- resizable: boolean if the window can be resized (left side)
	*/
	emojiKeyboard.callback = (emoji, closed) => {
		console.info(emoji, closed)
		zone.value += emoji.emoji;
		//alert(zone)
	};
	emojiKeyboard.resizable = true;
	emojiKeyboard.default_placeholder = "You are the best";
	emojiKeyboard.instantiate(document.getElementById("emoji"))
</script>
<script type="text/javascript">
	
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-36251023-1']);
	_gaq.push(['_setDomainName', 'jqueryscript.net']);
	_gaq.push(['_trackPageview']);
	
	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
	
	function search_user() {
		let input = document.getElementById('searchuser').value
		input=input.toLowerCase();
		let x = document.getElementsByClassName('chatusers');
		
		for (i = 0; i < x.length; i++) { 
			if (!x[i].innerHTML.toLowerCase().includes(input)) {
				x[i].style.display="none";
			}
			else {
				x[i].style.display="list-item";                 
			}
		}
	}
	Filevalidation();
</script>

@endsection